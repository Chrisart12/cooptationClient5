<?php 

namespace App\Repositories;


interface StepInterface
{
    public function getEtapes($categorieId);
    public function getTotalSteps($categorieId);
    public function getOrdre($stepCandidat, $categorieId);
    public function getOrdres($categorieId);
    
}