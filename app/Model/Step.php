<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    public function categories()
    {
        return $this->belongsToMany(Categorie::class);
    }
}
