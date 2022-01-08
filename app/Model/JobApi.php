<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

// class Job extends Model
//Le model ne retourne pas de api quand il extends Model
/**
 * [Description JobApi]
 */
class JobApi 
{
    public $id;
    public $date_start;
    public $title;
    public $location;
    public $description;
    public $departments;
    public $vacancyURL;

    /**
     * @param mixed $id
     * @param mixed $date_start
     * @param mixed $title
     * @param mixed $location
     * @param mixed $description
     * @param mixed $departments
     * @param mixed $vacancyURL
     */
    public function __construct($id, $date_start, $title, $location, $description, $departments, $vacancyURL)
    {
        $this->id = $id;
        $this->date_start = $date_start;
        $this->title = $title;
        $this->location = $location;
        $this->description = $description;
        $this->departments= $departments;
        $this->vacancyURL = $vacancyURL;

    }
}
