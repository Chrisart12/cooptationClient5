<?php

namespace App\Http\Resources\Like;

use Illuminate\Http\Resources\Json\Resource;

class LikeCollection extends Resource
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
            'user_id' => $this->user_id,
            'story_id' => $this->story_id
        ];
    }
}
