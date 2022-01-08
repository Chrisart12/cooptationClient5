<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function categorie()
    {
        return $this->belongsTo('App\Model\Categorie');
    }
}
