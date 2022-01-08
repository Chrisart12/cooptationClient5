<?php 

namespace App\Repositories;

/**
 * [Description HistoricInterface]
 */
interface HistoricInterface 
{
    public function getAll();
    public function getHistoricStepCandidats($candidat_id);
    public function createEtapes($userId, $candidatId, $stepCandidat, $adminId, $totalSteps, 
                                    $adminLastname, $adminFirstname, $ordre, $ordres, $score, $stepNote);
    
}

