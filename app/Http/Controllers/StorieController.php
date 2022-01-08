<?php

namespace App\Http\Controllers;

use DB;
use Auth; 
use Image;
use DateTime;
use App\Model\Like;
use App\Model\User;
use App\Model\Story;
use Illuminate\Http\Request;
use App\Http\Requests\StorieRequest;
use App\Http\Requests\ShowImageRequest; 
use App\Http\Requests\AllStoriesRequest; 
use Illuminate\Support\Facades\Storage;
use App\Repositories\StorieInterface;
use App\Repositories\UserInterface;
use App\Http\Resources\Storie\StorieResource;
use App\Http\Resources\Storie\StorieCollection;


class StorieController extends Controller
{
    /**
     * @var [StorieInterface]
     */
    protected $storyInterface;

    /**
     * @param StorieInterface $story
     */
    public function __construct(StorieInterface $storyInterface, UserInterface $userInterface)
    {
        $this->storyInterface = $storyInterface;
        $this->userInterface = $userInterface;
    }

    /**
     * On enregistre l'image dans le code et dans la base de données
     * On renvoie l'image à l'utilisateur après l'avoir travaillée
     * avec la librairie Intervention Image
     * @param Request $request
     * @param [Story] $id
     * @return Response $filename
     */
    public function showImage(ShowImageRequest $request, $id) 
    {
        //On vérifie s'il y a un id et on caste l'id en entier
        $id = (int)$id;

        if($request->hasFile('image') && $id) {

            $filename = $this->storyInterface->createImage($request, $id);

            return $filename;
        }
    }

    /**
     * Update the specified resource in storage.
     * Validation de la story et on retounre isActive
     * @param  \Illuminate\Http\Request  $requests
     * @param  \App\Model\Storie  $storie
     * @return \Illuminate\Http\Response
     */
    public function validateStories(StorieRequest $request)
    {
        $result = $this->storyInterface->finalize($request);

        return $result;
    }

    
    /**
     * Permet de savoir si l'utilisateur a activé sa storie ou pas.
     *
     * @return \Illuminate\Http\Response
     */
    public function isActive($user_id)
    {
        $user_id = (int)$user_id;

        if($user_id){

            $story = $this->storyInterface->getActive($user_id);

            return $story;
        }
        
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allStories(AllStoriesRequest $request)
    {  
        // return $request->search;
        $search = $request->search;
    
        $id = $request->userId;
        
        $id = (int)$id;

        // On recherche l'utilisateur
        $user = $this->userInterface->getUserById($id);

        // Si l'utilisateur existe, on continue.
        if($user) {

            $stories = $this->storyInterface->getAll($id, $search);

            return $stories;
        }

    }


    // // public function allStories($id)
    // public function suggestions(Request $request)
    // {  
    //     $search = $request->search;
    
    //     $id = $request->userId;
        
    //     $id = (int)$id;

    //     if($id) {

    //         $stories = $this->story->getAll($id, $search);

    //         return $stories;
    //     }
    // }

    /**
     * Display a listing of the resource by search
     *
     * @return \Illuminate\Http\Response
     */
    // public function gallerySearch(StorieRequest $request, $id)
    // { 
    //     $id = (int)$id;

    //     if($id){

    //         $stories = $this->story->getBySearch($request, $id);

    //         return $stories;
    //     }

    // }

    /**
     * Display the specified resource.
     * Montre le détail de chaque utilisateur et recherche si cet
     * utilisateur est liké par l'utilisateur connecté.
     * @param  \App\Model\Storie  $storie
     * @return \Illuminate\Http\Response
     */
    public function show($storyId, $userId)
    {  
        //On recherche un utilisateur par son id($storyId) et on recherche
        //si cet utilisteur a été liké par le profil connecté($userId)
        if($storyId && $userId)
        {
    
            $everyProfileData = $this->storyInterface->getAllById($storyId, $userId);

            return $everyProfileData; 
        }                             
    }


    /**
     * Affiche le profil de l'utilisateur
     *
     * @param  \Illuminate\Http\Request  $requests
     * @param  \App\Model\Storie  $storie
     * @return \Illuminate\Http\Response
     */
    public function userProfil($id)
    {
        $id = (int)$id;
        if($id) {
            $story = $this->storyInterface->getById($id);

            return $story;  
        }
                    
    }


}
