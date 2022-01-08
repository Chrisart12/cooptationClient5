<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use DateTime;
use App\Model\Job;
use App\Model\Step;
use App\Model\User;
use App\Model\Account;
use App\Model\Candidat;
use App\Model\Historic;
use App\Model\Categorie;
use App\Model\CategorieStep;
use Illuminate\Http\Request; 
use App\Mail\MessageToCandidat;
use App\Mail\MessageToCooptant;
use App\Repositories\JobInterface;
use App\Exceptions\CustomException;
use App\Repositories\StepInterface;
use App\Repositories\UserInterface;
use Illuminate\Support\Facades\Mail;
use App\Repositories\AccountInterface;
use Illuminate\Support\Facades\Config;
use App\Repositories\CandidatInterface;
use App\Repositories\HistoricInterface;
use App\Http\Requests\CooptationRequest;


class CooptationController extends Controller
{
    
    protected $candidatInterface;
    protected $jobInterface;
    protected $accountInterface;
    protected $userInterface;
    protected $stepInterface;
    protected $historicInterface;

    /**
     * Ce controlleur nécessite une authentification
     *
     * @return void
     */
    public function __construct(CandidatInterface $candidatInterface,
                                JobInterface $jobInterface, AccountInterface $accountInterface, UserInterface $userInterface,
                                StepInterface $stepInterface, HistoricInterface $historicInterface)
    {
        $this->middleware('auth')->except('coopter');
        $this->candidatInterface = $candidatInterface;
        $this->jobInterface = $jobInterface;
        $this->accountInterface = $accountInterface;
        $this->userInterface = $userInterface;
        $this->stepInterface = $stepInterface;
        $this->historicInterface = $historicInterface;
    }
    
    /**
     * Retourne tous les candidats de la base de données
     *
     * @return [CandidatInterface] $candidatInterface
     */
    public function index()
    {
        
        $cooptations = $this->candidatInterface->getAll();

        return view('cooptation', compact('cooptations'));

    }

    /**
     * Fonction qui permet d'enregistrer la candidature et d'envoyer
     * un email au canditat avec un lien pour postuler.
     *
     * @param Request $request
     * @return void
     */
    public function coopter(CooptationRequest $request)
    {
    
        //On utilise une transaction pour mettre à jour les tables
        DB::beginTransaction();

        try {
                //On enregistre les informations dans la table jobs
                $job = $this->jobInterface->create($request);

                //On enregistre les informations dans la table candidats
                $candidat = $this->candidatInterface->create($job->id, $request);

                //On enregistre les informations dans la table accounts
                $account = $this->accountInterface->create($request->input('userId'), $candidat->id, $job->id, 1);

                //On recherche les informations sur l'utilisateur qui a envoyé le candidat
                $user = $this->userInterface->getUserById($request->input('userId'));
                
                //On envoie un mail au candidat
                $this->sendMailToCandidat($candidat, $user, $job);

                //On envoie un mail au cooptant
                $this->sendMailToCooptant($candidat, $user, $job);

                DB::commit();

            } catch (\Throwable $th) {

                DB::rollback();
            }
        
            return response()->json([
                'cooptation' => $request->input('location'),
            ]);

    }

    /**
     * @param mixed $candidat
     * @param mixed $user
     * @param mixed $job
     * 
     * @return [type]
     */
    private function sendMailToCandidat($candidat, $user, $job)
    {
        $candidatLastname = $candidat->lastname;
        $candidatFirstname = $candidat->firstname;
        $jobTitle = $job->title;
        $userFirstname = $user->firstname; 
        $userLastname = $user->lastname;
        $jobUrl = $job->url;
        //On crée une instance de MessageToCandidat
        $messageToCandidat = new MessageToCandidat($candidatLastname, $candidatFirstname, $jobTitle, $userFirstname, $userLastname, $jobUrl);

        //On envoie un message au candidat.
        Mail::to($candidat->email)
            ->send($messageToCandidat);
    }

    /**
     * @param mixed $candidat
     * @param mixed $user
     * @param mixed $job
     * 
     * @return [type]
     */
    private function sendMailToCooptant($candidat, $user, $job)
    {
        $candidatLastname = $candidat->lastname;
        $candidatFirstname = $candidat->firstname;
        $jobTitle = $job->title;
        $userFirstname = $user->firstname; 
        $userLastname = $user->lastname;

        //On crée une instance de MessageToCooptant.
        $messageToCooptant = new MessageToCooptant($candidatLastname, $candidatFirstname, $jobTitle, $userFirstname, $userLastname);  
        
        // On envoie une confirmation au cooptant.
        Mail::to($user->email)
            ->send($messageToCooptant);
    }

    /**
     * Retourne tous les cooptants
     * avec chacun le nombre de candidats proposé, 
     * ainsi que chacun leur point
     *
     * @return [UserInterface] $cooptants
     */
    public function cooptants()
    {
        
        $cooptants = $this->userInterface->getCooptants();

        return view('cooptants', compact('cooptants'));
    }

    /**
     * Undocumented function
     *
     * @param [User] $id
     * @return [UserInterface] $userInterface
     */
    public function cooptant($id)
    {
  
        $id = (int)$id;
        
        // On vérifie d'abord si l'id existe en base de données.
        $user = $this->userInterface->getUserById($id);
    
        if($user){
        
            $cooptant = $this->userInterface->getUserById($id);
            
            $coopters = $this->candidatInterface->getCooptersByCooptantId($id);
    
            return view('cooptant', compact('coopters', 'cooptant'));

        } else {

            throw new CustomException;
        }
    
    }

    /**
     * @param mixed $id
     * 
     * @return [CandidatInterface] $candidatInterface
     */
    public function candidat($candidatId)
    {

        $candidatId = (int)$candidatId;

        if($candidatId) {

            $candidat = $this->candidatInterface->getCandidat($candidatId);

            // return  $candidat;
            // Recherche des étapes en fonction de la catégorie
            //On récupére la catégorie de la précédente requête
            $categorieId = $candidat->categorie_id;
        
            // permet de connaître toute les étapes de la catégorie
            $etapes = $this->stepInterface->getEtapes($categorieId);
        
            //Recherche de l'étape du candidat dans la table accounts
            // en prenant en compte la catégorie
            // On retient l'id du candidat
            $candidat_id = $candidat->candidat_id;
            
            // Je change la ligne suivante pour connaître l'étape courante en faisant la recherche dans la table candidat
            $currentStep = $this->accountInterface->getCurrentStep($candidat_id, $categorieId);
            // $currentStep = $this->candidatInterface->getCurrentStep($candidat_id, $categorieId);
    
            // permet de connaître le nombre total de steps
            $totalSteps = $this->stepInterface->getTotalSteps($categorieId);
        
            $historicStepCandidats = $this->historicInterface->getHistoricStepCandidats($candidat_id);
        
        }
                                                        // 'step',
        return view('candidat', compact('candidat', 'etapes',  'currentStep', 'totalSteps', 'historicStepCandidats'));
    }

	/**
	 * @param CooptationRequest $request
	 * 
	 * @return [candidatInterface] $candidatInterface
     * 
     * @return redirect CooptationController@candidat
	 */
	public function etapes(CooptationRequest $request)
    {
        
        $candidatId = $request->input('id');
        $categorieId = $request->input('categorie_id');

        //Cette fonction permet de rechercher le candidat par son $id
        // il est utilisée aussi bien pour function candidat($candidatId) get
        // et pour function etapes(CooptationRequest $request) post
        $candidat = $this->candidatInterface->getCandidat($candidatId);
        
        //On recherche l'ordre selon la catégorie et le step_id
        //On retient le step_id
        $stepCandidat =  $candidat->step_id;
        
        $ordre = $this->stepInterface->getOrdre($stepCandidat, $categorieId);
        
        // Sélection de toutes les étapes du candidat dans la table historics 
        $historicStepCandidats = $this->historicInterface->getHistoricStepCandidats($candidatId);

        //Récupération des données du candidat					
        $score = $candidat->score;
        $stepNote = $candidat->note;

        //Récupération des données du cooptant
        $userId = $candidat->user_id;
        
        //Récupération des données de l'admin qui est connecté	                                   
        $adminId = Auth::id();
        $adminFirstname = Auth::user()->firstname;
        $adminLastname = Auth::user()->lastname;
    
        //MISE A JOUR DES DONNEES DANS LA TABLE ACCOUNT
        //Récupération du nombre total d'étapes dans la catégorie
        //On compte le nombre total d'étapes selon la catégorie
        $totalSteps = $this->stepInterface->getTotalSteps($categorieId);
        
        //Récupération de l'ordre sur la page étape
        $ordres = $this->stepInterface->getOrdres($categorieId);
        

        $this->historicInterface->createEtapes($userId, $candidatId, $stepCandidat, $adminId, $totalSteps, 
                                                $adminLastname, $adminFirstname, $ordre, $ordres, $score, $stepNote);
        
        // On fait une redirection pour actualiser la page en passant l'action
        // du controller  candidat en deuxième argument l'id du candidat
		return redirect()->action('CooptationController@candidat', ['id'=> $candidatId]);
    }
}
