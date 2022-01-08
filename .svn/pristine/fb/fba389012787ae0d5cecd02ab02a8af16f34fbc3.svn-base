<?php

namespace App\Repositories;

use DB;
use Auth;
use Config;
use App\Model\Candidat;


/**
 * [Description CandidatRepository]
 */
class CandidatRepository implements CandidatInterface
{
    /**
     * @var [type]
     */
    protected $candidat;

	/**
	 * @param Candidat $candidat
	 */
	public function __construct(Candidat $candidat)
	{
		$this->candidat = $candidat;
    }
    
    /**
     * @param mixed $job_id
     * @param mixed $request
     * 
     * @return [type]
     */
    public function create($job_id, $request)
    {
        $candidat = new $this->candidat;

        $candidat->user_id = $request->input('userId');
        $candidat->job_id = $job_id;
        $candidat->step_id = 1;
        $candidat->firstname = $request->input('firstname');
        $candidat->lastname = $request->input('lastname');
        $candidat->email = $request->input('email');
        
        $candidat->save();

        return $candidat;
    }


    /**
    * @param mixed $id
    * 
    * @return [Candidat] $coopters
    */
    public function getCooptersByCooptantId($id)
    {
        try {
            //On limite le nombre de résultat par page
            $pagination = Config::get('custom.pagination');
            //On recherche les candidats présentés par le cooptant
            $coopters = Candidat::select('candidats.id','candidats.firstname','candidats.lastname', 
                                        'jobs.title','accounts.score')
                                ->join('accounts', 'candidats.id', '=', 'accounts.candidat_id')
                                ->join('jobs', 'candidats.job_id', '=', 'jobs.id')
                                ->where('accounts.user_id', $id)
                                ->orderBy('lastname')
                                ->paginate($pagination);

            return  $coopters;

        } catch (\Exception $exception) {

            throw new CustomException;
        }
        
    }

    /**
     * @param mixed $id
     * 
     * @return [Candidat] $candidat
     */
    public function getCandidat($candidatId)
    {
        // 'accounts.step_id' j'ai mis 'candidats.step_id' à la place.
        $candidat = Candidat::select('candidats.id as candidat_id', 
                                    'candidats.firstname as candidat_firstname', 
                                    'candidats.lastname as candidat_lastname', 
                                    'candidats.email', 'candidats.created_at', 'jobs.title', 
                                    'jobs.location', 'jobs.reference', 'jobs.url', 
                                    'users.id as user_id',
                                    'users.firstname as user_firstname', 
                                    'users.lastname as user_lastname', 'categories.label', 
                                    'categories.id as categorie_id', 'accounts.step_id', 
                                    'accounts.score', 'accounts.is_done', 'steps.note')
                                ->join('jobs', 'candidats.job_id', '=', 'jobs.id')
                                ->join('users', 'jobs.user_id', '=', 'users.id')
                                ->join('categories', 'jobs.categorie_id', '=', 'categories.id')
                                ->join('accounts', 'candidats.id', '=', 'accounts.candidat_id')
                                ->join('steps', 'accounts.step_id', '=', 'steps.id')
                                ->where('candidats.id', '=', $candidatId)
                                ->first();
        

        return $candidat;
    }


    /**
     * @return [Job] $cooptations
     */
    public function getAll()
    {
        
        //On limite le nombre de résultat par page
        $pagination = Config::get('custom.pagination');

        $cooptations = Candidat::select('*')
                                ->join('jobs', 'jobs.id', '=', 'candidats.job_id')
                                ->orderBy('candidats.created_at', 'desc')
                                ->paginate($pagination);

        return  $cooptations;
    }


    // /**
    //  * @param mixed $candidat_id
    //  * 
    //  * @return [Candidat]
    //  */
    // public function getCurrentStep($candidat_id, $categorieId)
    // {
    //     // Permet de savoir l'étape courrante
    //     return $this->candidat::select('*')
    //                             ->join('categorie_step', 'categorie_step.step_id', '=', 'candidats.step_id')
    //                             ->where([
    //                                 ['candidats.id', $candidat_id],
    //                                 ['categorie_step.categorie_id', $categorieId],
    //                             ])
    //                             ->first();
    // }


}