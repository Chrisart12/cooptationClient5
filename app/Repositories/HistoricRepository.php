<?php 

namespace App\Repositories;

use DB;
use Illuminate\Support\Facades\Config;
use App\Model\Historic;

class HistoricRepository implements HistoricInterface
{   
    /**
    * Undocumented variable
    *
    * @var [User]
    */
    protected $historic;

    /**
     * Permet initialisation du Model Historic
     * au moment de l'instanciation
     *
     * @param Historic $model
     */
    public function __construct(Historic $historic)
    {
        $this->historic = $historic;
    }

    
    /**
     * Retourne toute l'historique
     * 
     * @return [Historic] $historics
     */
    public function getAll()
    {
        //On limite le nombre de résultat par page
        $pagination = Config::get('custom.pagination');

        $historics = $this->historic::select("admin_lastname", "admin_firstname", "users.firstname as user_firstname",
                                        "users.lastname as user_lastname", "candidats.firstname as candidat_firstname",
                                        "candidats.lastname as candidat_lastname", "steps.label", "historics.created_at")
                                ->join("users", "historics.user_id", "=", "users.id" )
                                ->join("candidats", "historics.candidat_id", "=", "candidats.id" )
                                ->join("steps", "historics.step_id", "=", "steps.id" )
                                ->paginate($pagination);
        
        if($historics) {

            return  $historics;
        } else {
            
            throw new CustomException;
        }
    }

    /**
     * @param mixed $candidat_id
     * 
     * @return [Historic] $historicStepCandidats
     */
    public function getHistoricStepCandidats($candidat_id)
    {
        $historicStepCandidats = $this->historic::select('historics.step_id', 'historics.created_at', 'steps.label')
                                                ->join('steps', 'historics.step_id', '=', 'steps.id')
                                                ->where('historics.candidat_id', '=', $candidat_id)
                                                ->orderBy('historics.created_at')
                                                ->get();
        
        return $historicStepCandidats; 
    }


    /**
     * @param mixed $userId
     * @param mixed $candidatId
     * @param mixed $stepCandidat
     * @param mixed $adminId
     * @param mixed $totalSteps
     * @param mixed $adminLastname
     * @param mixed $adminFirstname
     * @param mixed $ordre
     * @param mixed $ordres
     * @param mixed $score
     * @param mixed $stepNote
     * 
     * @return [Historic]
     */
    public function createEtapes($userId, $candidatId, $stepCandidat, $adminId, $totalSteps, 
                                    $adminLastname, $adminFirstname, $ordre, $ordres, $score, $stepNote)
    {
        //Création de l'étape en utilisant une transaction pour cette opération
        DB::beginTransaction();
        
		//On vérifie si toutes les requêtes se sont bien passées
		try {

                //Insertion des données dans la table historics après la mise à jour
                // On crée une instance de la classe Historic
                $historic = new Historic;
                
				$historic->user_id = $userId;
				$historic->candidat_id = $candidatId;
                $historic->step_id = $stepCandidat;
                $historic->admin_id = $adminId;
                $historic->admin_lastname = $adminLastname;
                $historic->admin_firstname = $adminFirstname;
				
				$historic->save();

                    // On compare le numéro de l'ordre et le total des étapes
                    // Si l'ordre est inférieur au total du step, on rentre dans la condition
                    // Sinon on passe accounts.is_done à 1 et c'est la fin des étapes
					if($ordre->ordre < $totalSteps) {
                        $nextStep = $ordre->ordre + 1;
                        
                        //$step est l'étape suivante
                        $step = $ordres->where('categorie_step.ordre', '=', $nextStep)->first();

                        //On recherche l'id de l'étape suivante
                        // Cet id va remplacer dans la table account l'id précédent
                        //Le score va être incrémenté de la note de l'étape validée
                        $nextStepId = $step->step_id;
                        // return $nextStepId;

                        //On vérifie s'il y a une étape suivante
                        // Si oui, on fait un update du score et de l'id de l'étape suivante
						if($step != null){
							$account = DB::table('accounts')
                                            ->where('candidat_id', '=', $candidatId)
                                            ->update([
                                                    'score' => $score + $stepNote,
                                                    'step_id' => $nextStepId
                                                ]);
						}

					} else if($ordre->ordre == $totalSteps) {
							$account = DB::table('accounts')
                                            ->where('candidat_id', '=', $candidatId)
                                            ->update([
                                                'score' => $score + $stepNote,
                                                'is_done' => 1
                                                ]);
						}

			} catch (ValidationException $e) {

					DB::rollback();
			}

		DB::commit();
        
    }



}

