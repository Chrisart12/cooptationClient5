<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "roles";

	protected $fillable = [
			'label', 'slug'
    ];
    
    /**
     * The users that belong to the role.
    */
    public function users()
    {
        return $this->belongsToMany('App\Model\User');
    }
}
