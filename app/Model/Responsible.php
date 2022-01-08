<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Responsible extends Model
{
    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['label'];


	/**
     * Get the users for the responsible.
     */
	public function users()
	{
		return $this->hasMany('App\Model\User');
	}
}
