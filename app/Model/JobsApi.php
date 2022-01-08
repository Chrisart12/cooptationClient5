<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

// class Jobs extends Model
class JobsApi
{
    public $id;
    public $date_start;
    public $title;
    public $location;
    public $departementId;
    public $vacancyURL;

    /**
     * @param mixed $id
     * @param mixed $date_start
     * @param mixed $title
     * @param mixed $location
     * @param mixed $departementId
     * @param mixed $vacancyURL
     */
    public function __construct($id, $date_start, $title, $location, $departementId, $vacancyURL)
    {
        $this->id = $id;
        $this->date_start = $date_start;
        $this->title = $title;
        $this->location = $location;
        $this->departementId = $departementId;
        $this->vacancyURL = $vacancyURL;
    }

}

