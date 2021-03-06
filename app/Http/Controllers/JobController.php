<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\XMLToJsonController;
use App\Http\Requests;

class JobController extends Controller
{

    /**
     * Ce controlleur nécessite une authentification
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
    * Retourne la listes des offres
    * convertXmlToJson
    */
    public function showjobs()
    {
        // On fait appel à la methode showJobs de la class 
        // JobApiController qui retourne la liste de offres et le nombres d'offres
        $jobApiController = new JobApiController();
        $jobsData = $jobApiController->showJobs();

        // On extrait le nombre d'offres
        $nberOfJobs = $jobsData['nuberOfJobs'];
        // On extrait un tableaux des offres
        $jobs = $jobsData['jobs'];
        
        return view("jobs", compact("jobs"));

    }

    /**
     * Retourne la listes des offres quand on passe l'url dans la fonction
     * convertXmlToJson
     */
     public function showJob($jobId)
     {
        // On fait appel à la methode showJob de la class 
        // JobApiController qui retourne une offre à partir de son id($vacancy_id)
        $jobApiController = new JobApiController();
        $jobData = $jobApiController->showJob($jobId);

        // On récupère lepremier élément du tableau
        $job = $jobData[0];
        
        return view("/job", compact("job"));
        
    }
}
