<?php

namespace App\Repositories;

use DB;
use Mail;
use Config;
use App\Model\User;
use Illuminate\Support\Str;
use App\Mail\VerifyTokenEmailPassword;


/**
 * [Description UserRepository]
 */
class UserRepository implements UserInterface
{
    /**
     * @var [type]
     */
    protected $user;

	/**
	 * @param User $user
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
    }

    /**
     * @param mixed $request
     * 
     * @return [type]
     */
    public function getUserById($user_id)
    {
        return $this->user::select('*')
                            ->where('id', '=', $user_id)
                            ->first();

    }



    /**
     * Permet de vérifier le mail de l'utilisateur
     * de lui envoyer un token de réinitialisation de mot de passe
     * en faisant appel à la fonction sendEmailToPasswordResset
     * Retoune true en cas de success et false en cas d'échec
     * @param [User] $userToken
     * @param [User] $userEmail
     * @return void
     */
    public function passwordResset($userToken, $userEmail)
    {

        $user = $this->user::select('*')
                        ->where('users.token', '=', $userToken)
                        ->where('users.email', '=', $userEmail)
                        ->first();
                

        /*
        | On vérifie si les données envoyées correspondent
        | à nos enregistrement. En cas d'échec, on revoie no
        | En cas de success, on continue le traitement :
        | - On crée un token qu'on enregistre dans la base de
        | données 
         */
        if($user){

            $verifyEmailToken = Str::random(40);
            $user->verify_email_token = $verifyEmailToken;
            $user->update();
        
            $this->sendEmailToPasswordResset($userEmail, $verifyEmailToken);
    
            return  true;

        } else {
            
            return  false;
        }
    }

    /**
     * Permet d'envoyer un mail à l'utilisateur
     *
     * @param [User] $userEmail
     * @param [User] $verifyEmailToken
     * @return void
     */
    public function sendEmailToPasswordResset($userEmail, $verifyEmailToken)
    {
        //On crée une instance de VerifyTokenEmailPassword.
        // on lui passe l'email de l'utilisateur ainsi que le token créé
        $verifyTokenEmailPassword = new VerifyTokenEmailPassword($userEmail, $verifyEmailToken);

        //on envoie le mail à l'utilisateur
        Mail::to($userEmail)
                ->send($verifyTokenEmailPassword);
    }

    /**
     * Undocumented function
     *
     * @param [User] $email
     * @param [User] $verifyToken
     * @param [User] $password
     * @return void
     */
    public function emailVerify($email, $verifyToken, $password)
    {

        //On vérifie l'exactitude du verify_email_token et du mail envoyés
        $user = $this->user::select('*')
                    ->where('users.email', '=', $email)
                    ->where('users.verify_email_token', '=', $verifyToken)
                    ->first();
    
        //Si les informations sont justes on continue le traitement
        // sinon on envoie false au programme
        if($user) {

            $user->password = $password;
            $user->update();

            return true;

        } else {

            return false;
        }
    }


    /**
     * @return [type]
     */
    public function getCooptants()
    {
        //On limite le nombre de résultat par page
        $pagination = Config::get('custom.pagination');

        $cooptants = $this->user::select( DB::raw('COUNT(users.id) as nbre_candidats, 
                                            SUM(accounts.score) as users_score'),
                                            'users.id','users.lastname', 'users.firstname')
                            ->join('accounts', 'users.id', '=', 'accounts.user_id')
                            ->groupBy('users.id')
                            ->orderBy('lastname')
                            ->paginate($pagination);

        return $cooptants;
    }

}