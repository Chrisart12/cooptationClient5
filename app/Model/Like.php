<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'story_id', 'created_at', 'updated_at'];

    /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
    protected $casts = [
    'id' => 'integer',
    'user_id' => 'integer',
    'story_id' => 'integer'
    ];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function story()
    {
        return $this->belongsTo('App\Model\Story');
    }
}
