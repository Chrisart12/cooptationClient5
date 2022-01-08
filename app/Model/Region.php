<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['label', 'created_at', 'updated_at'];


	/**
     * Get the users for the region.
     */
	public function users()
	{
		return $this->hasMany('App\Model\User');
	}

}


