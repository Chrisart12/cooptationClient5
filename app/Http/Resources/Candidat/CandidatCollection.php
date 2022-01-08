<?php

namespace App\Http\Resources\Candidat;

use Illuminate\Http\Resources\Json\Resource;

class CandidatCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            "firstname" => $this->firstname,
            "lastname" => $this->lastname,
            "poste" => $this->poste,
            "reference" => $this->reference,
            "offre_id" => $this->offre_id,
        ];
    
    }
}
