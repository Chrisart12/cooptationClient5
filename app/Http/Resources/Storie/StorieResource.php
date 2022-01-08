<?php

namespace App\Http\Resources\Storie;

use Illuminate\Http\Resources\Json\Resource;

class StorieResource extends Resource
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
            //'id' => $this->id,
            "story" => $this->story,
            "picture_path" => "http://localhost/cooptationAPI/public/storage/images/" . $this->picture_path,
            "user_id" => $this->user_id,
            'user' => User::collection($this->user),
        ];
    }
}
