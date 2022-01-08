<?php

namespace App\Repositories;

use DB;
use App\Model\Account;

/**
 * [Description AccountRepository]
 */
class AccountRepository implements AccountInterface
{
    /**
     * @var [type]
     */
    protected $account;

	/**
	 * @param Account $account
	 */
	public function __construct(Account $account)
	{
		$this->account = $account;
    }

    
    /**
     * @param mixed $user_id
     * @param mixed $candidat_id
     * @param mixed $job_id
     * @param mixed $step_id
     * 
     * @return [type]
     */
    public function create($user_id, $candidat_id, $job_id, $step_id)
    {
        $account = new $this->account;

        $account->user_id = $user_id;
        $account->candidat_id =  $candidat_id;
        $account->job_id =  $job_id;
        $account->step_id = $step_id;

        $account->save();

        return $account;
    }

    //Ce code représente le l'étape courante, je vais le remplacer par le step id de step_id de la table jobs ou de la table candidats

    /**
     * @param mixed $candidat_id
     * @param mixed $categorieId
     * 
     * @return [Account] $step
     */
    public function getCurrentStep($candidat_id, $categorieId)
    {
        $step = $this->account::select('accounts.step_id', 'categorie_step.ordre')
                                ->join('categorie_step', 'accounts.step_id', '=', 'categorie_step.step_id')
                                ->where([
                                    ['accounts.candidat_id', '=', $candidat_id],
                                    ['categorie_step.categorie_id', '=', $categorieId],
                                ])
                                ->first();

        return $step;
    }



}