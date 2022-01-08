<?php

namespace App\Http\Resources\Offre;

use Illuminate\Http\Resources\Json\Resource;

class OffreResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            "lieu" => $this->lieu,
            "reference" => $this->reference,
            "poste" => $this->poste,
            "description" => $this->description
        ];
    }
}
