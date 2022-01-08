<?php

namespace App\Http\Controllers;


use App\Model\Like;
use Illuminate\Http\Request;
use App\Http\Requests\LikeRequest;
use App\Repositories\LikeInterface;
use App\Http\Resources\Like\LikeResource;
use App\Http\Resources\Like\LikeCollection;

class LikeController extends Controller
{
    
    /**
     * @var [Like]
     */
    protected $likeInterface;

    /**
     * @param LikeInterface $likeInterface
     */
    public function __construct(LikeInterface $likeInterface)
    {
        $this->likeInterface = $likeInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LikeCollection::collection(Like::all());
    }

    /**
     * Permet de liker un utilisateur
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function storeLike(LikeRequest $request)
    {
        
        // On récupère les données envoyées
        $userId = $request->user_id;
        $storyId = $request->story_id;

        // On fait appel à la methode create
        // du LikeRepository pour l'enregistrement
        $this->likeInterface->create($userId, $storyId);
    }

    /**
     * Tous les profils likés par un utilisateur
     * Display the specified resource.
     *
     * @param  \App\Model\Like  $like
     * @return \Illuminate\Http\Response
     * @return [Like] $like
     */ 
    public function allProfilLikes($id)
    {
        $likes = $this->likeInterface->getById($id);

        return $likes;
    }

    /**
     * Permet de disliker un utilisateur
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Like  $like
     * @return \Illuminate\Http\Response
     *  @return void
     */
    public function deleteLike($story_id, $user_id)
    {
        // On vérifie les données envoyées par l'utilisateur
        // On caste les valeurs en entier
        $story_id = (int) $story_id;
        $user_id = (int) $user_id;

        $this->likeInterface->delete($story_id, $user_id);

    }
}
