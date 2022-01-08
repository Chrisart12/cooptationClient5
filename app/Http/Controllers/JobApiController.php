<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\XMLToJsonController;
use App\Http\Requests;
use App\Model\JobsApi;
use App\Model\JobApi;

class JobApiController extends Controller
{
    
    /**
     * On fait un filtre pour éviter des éléments vides dans le tableau
     * On fait également un filtre en fonction de la clé (ici Vacancy)
    */
    /**
     * @param mixed $offer
     * @param mixed $element
     * 
     * @return [type]
     */
    public function filteroffer($offer, $element)
    {
        // return $json[$element];
        return array_filter($offer[$element]);
    }

    /**
    * Retourne la listes des offers quand on passe l"url dans la fonction
    * convertXmlToJson
    */
    /**
     * @return [type]
     */
    public function showJobs()
    {
        // On récupère l"url des jobs
        $jobsUrl = Config::get("custom.jobs_url");
        
        // On utilise la methode static convertXmlToJson de la classe $XmlConvertController
        // pour convertir les données.
        $offerBeforeFilter = XMLToJsonController::convertXmlToJson($jobsUrl);

        //On fait appel à la fonction filteroffer pour éliminer les éléments vides
        $offerAfterFilter = $this->filteroffer($offerBeforeFilter, "Vacancy");

        //On crée un tableaux et on y inserre les éléments
        $jobs = [];
        $offerLangues = "";

        foreach($offerAfterFilter as $offers) {
            $attributes = array_filter(($offers["@attributes"]));

            $LesVersions = array_filter(($offers["Versions"]["Version"]));
            $departments = array_filter(($offers["Departments"]));
            // dd($offers);
            $offerLangues = $LesVersions["@attributes"];

            //On vérifie si la langue est en français
            if($offerLangues["language"] == "fr") {
                
                if(array_key_exists("id", $attributes) && array_key_exists("date_start", $attributes)
                        && array_key_exists("Title", $LesVersions) && array_key_exists("Location", $LesVersions) 
                        && array_key_exists("Departments", $offers) && array_key_exists("Department", $departments) 
                        && array_key_exists("@attributes", $departments["Department"])
                        && array_key_exists("id", $departments["Department"]["@attributes"])
                        && array_key_exists("VacancyURL", $departments["Department"])
                    ){
                    array_push($jobs, new JobsApi($attributes["id"], $attributes["date_start"], 
                    $LesVersions["Title"], $LesVersions["Location"], $departments["Department"]["@attributes"]["id"], 
                    $departments["Department"]["VacancyURL"]));
                }   

            }
        }

            $nuberOfJobs = count($jobs);
    
            return ["nuberOfJobs" =>$nuberOfJobs, "jobs" => $jobs];
    }


    /**
     * Retourne la listes des offers quand on passe l"url dans la fonction
     * convertXmlToJson
     */
    /**
     * @param mixed $vacancy_id
     * 
     * @return [type]
     */
    public function showJob($vacancy_id)
    {
        // On récupère l"url du job et on y ajoute le $vacancy_id
        $jobUrl = Config::get("custom.job_url");
    
        //On vérifie si $vacancy_id existe
        if ($vacancy_id) {

            $jobUrlById =  $jobUrl . $vacancy_id . ".xml";

            // On utilise la methode static convertXmlToJson de la classe $XmlConvertController
            // pour convertir les données.
            $offer = XMLToJsonController::convertXmlToJson($jobUrlById);

            $attributes = array_filter(($offer["@attributes"]));
            $LesVersions = array_filter(($offer["Versions"]["Version"]));
            $departments = array_filter(($offer["Departments"]));

            $job = [];

            if(array_key_exists("id", $attributes) && array_key_exists("date_start", $attributes) 
                    && array_key_exists("Title", $LesVersions) && array_key_exists("Location", $LesVersions) 
                    && array_key_exists("Departments", $offer) && array_key_exists("Department", $departments) 
                    && array_key_exists("@attributes", $departments["Department"]) && array_key_exists("Description", $LesVersions)
                    && array_key_exists("id", $departments["Department"]["@attributes"])
                    && array_key_exists("VacancyURL", $departments["Department"])
                ){
                    array_push($job, new JobApi($attributes["id"], $attributes["date_start"], 
                    $LesVersions["Title"], $LesVersions["Location"], $LesVersions["Description"], 
                    $departments["Department"]["@attributes"]["id"], $departments["Department"]["VacancyURL"])
                    );
            }  else {
                return "Cet poste n'existe pas";
            }  

            return $job;

        }
        
    }

}
