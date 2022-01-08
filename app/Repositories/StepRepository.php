<?php 

namespace App\Repositories;

use App\Model\Step;
use DB;

class StepRepository implements StepInterface
{   
    /**
    * Undocumented variable
    *
    * @var [User]
    */
    protected $step;

    /**
     * Permet initialisation du Model Historic
     * au moment de l'instanciation
     *
     * @param Historic $model
     */
    public function __construct(Step $step)
    {
        $this->step = $step;
    }

    
    
    /**
     * @param mixed $categorieId
     * 
     * @return [Step]
     */
    public function getEtapes($categorieId)
    {
    
        $steps = $this->step::select('*')
                            ->join('categorie_step', 'categorie_step.step_id', '=', 'steps.id')
                            ->where('categorie_step.categorie_id', '=', $categorieId)
                            ->orderBy('categorie_step.ordre')
                            ->get();
        
        return $steps;
    }

    /**
     * @param mixed $categorieId
     * 
     * @return [Steps]
     */
    public function getTotalSteps($categorieId)
    { 
    
        $totalSteps =  DB::table('categorie_step')
                            ->where('categorie_step.categorie_id', '=', $categorieId)
                            ->count('categorie_step.ordre');

        return $totalSteps;
    }


    /**
     * @param mixed $stepCandidat
     * @param mixed $categorieId
     * 
     * @return [Step]
     */
    public function getOrdre($stepCandidat, $categorieId)
    {
        return DB::table('categorie_step')
                        ->where([
                            ['step_id', '=', $stepCandidat],
                            ['categorie_id', '=', $categorieId]
                        ])
                        ->first();
    }

    /**
     * @param mixed $categorieId
     * 
     * @return [CategorieStep] $ordres
     */
    public function getOrdres($categorieId)
    {
        //Récupération de l'ordre sur la page étape
		return DB::table('categorie_step')
                    ->join('steps', 'categorie_step.step_id', '=', 'steps.id')
                    ->where('categorie_step.categorie_id', '=', $categorieId)
                    ->orderBy('categorie_step.ordre');

    }
    
}

