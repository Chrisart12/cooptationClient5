<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    
    protected $fillable = ["id", "story", "picture_path", "bg_position_x", "bg_position_y", 
                            "is_active", "is_done",  "is_demo",  "user_id", "created_at", "updated_at"];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'story' => 'string',
        'picture_path' => 'string',
        'bg_position_x' => 'string',
        'bg_position_y' => 'string',
        'is_active' => 'integer',
        'is_done' => 'integer',
        'is_demo' => 'integer',
        'user_id' => 'integer',
    ];

    /**
     * Get the user that owns the story.
     */
    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    //A revoir
    // public function likes()
    // {
    //     return $this->hasMany("App\Model\Like", 'story_id');
    // }
    // -----------------

    /**
     * The likes that belong to the story.
     */
    public function likes()
    {
        return $this->belongsToMany("App\Model\Story", "likes", "story_id", "user_id");
    }
}
