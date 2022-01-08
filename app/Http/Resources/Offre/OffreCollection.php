<?php

namespace App\Http\Resources\Offre;

use Illuminate\Http\Resources\Json\Resource;

class OffreCollection extends Resource
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
                "lieu" => $this->lieu,
                "reference" => $this->reference,
                "poste" => $this->poste,
                "description" => $this->description
            ];
        
    }
}
