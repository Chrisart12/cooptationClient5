<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public function jobs()
    {
        return $this->hasMany("App\Model\Job", 'categorie_id');
    }

    public function steps()
    {
        return $this->belongsTomany(Step::class);
    }
}
