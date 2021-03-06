<?php

namespace App\Model;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'job', 'institution', 'role', 'departement', 
        'region_id', 'responsable_id', 'email', 'token', 'verify_email_token', 
        'password', 'last_connection', 'remember_token', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * On ajoute ce mutateur qui permet de crypter  
     *  le mot de passe avant son enregistrment en base de données
     */
    /**
     * @param mixed $password
     * 
     * @return [type]
     */
    public function setPasswordAttribute($password)
    {   
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Get the region that owns the user.
     */
    public function region()
    {
        return $this->belongsTo('App\Model\Region');
    }

    /**
     * Get the region that owns the responsible.
     */
    public function responsible()
    {
        return $this->belongsTo('App\Model\Responsible');
    }

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Model\Role');
    }

    //---------- Définition des rôles-----------
	/**
	 * @param mixed $roles
	 * 
	 * @return [type]
	 */
	public function hasAnyRole($roles)
	{
		if (is_array($roles)) {
			foreach ($roles as $role) {
				if ($this->hasRole($role)) {
					return true;
				}
			}
		} else {
			if ($this->hasRole($roles)) {
				return true;
			}
		}
		return false;
	}

	/**
	 * @param mixed $role
	 * 
	 * @return [type]
	 */
	public function hasRole($role) 
	{
		if ($this->roles()->where('slug', $role)->first()) {
			return true;
		}
		return false;
	}

    /**
     * Get the story record associated with the user.
     */
    public function story()
    {
        return $this->hasOne('App\Model\Story');
    }

    // A revoir 
    /**
     */
    // public function likes()
    // {
    //     return $this->hasMany("App\Model\Like", 'user_id');
    // }
      //-----------------

    /**
     * The likes that belong to the user.
     */
    public function likes()
    {
        return $this->belongsToMany("App\Model\Story", "likes", "user_id", "story_id");
    }
}
