<?php

namespace App\Repositories;

/**
 * [Description AccountInterface]
 */
interface AccountInterface 
{
    public function create($user_id, $candidat_id, $job_id, $step_id);
    public function getCurrentStep($candidat_id, $categorieId);

}
