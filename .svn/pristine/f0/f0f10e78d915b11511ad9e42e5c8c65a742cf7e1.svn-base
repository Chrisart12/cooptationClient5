<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    protected $fillable = ["id", "lieu", "reference", "categorie_id", "poste", "description", "user_id"];

    public function categorie()
    {
        return $this->belongsTo('App\Model\Categorie');
    }

    public function candidats()
    {
        return $this->hasMany('App\Model\Candidat', 'offre_id');
    }

}
