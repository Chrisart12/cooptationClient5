<?php 

namespace App\Repositories;

use DB;
use Image;
use Config;
use File;
use DateTime;
use App\Model\Story;
use App\Model\User;
use App\Model\Like;
use App\Exceptions\CustomException;

class StorieRepository implements StorieInterface
{
    /**
     * @var [Story]
     */
    protected $story;

    /**
     * @param Story $story
     */
    public function __construct(Story $story)
    {
        $this->story = $story;
    }

    /**
     * @param mixed $user_id
     * 
     * @return [Story] $story
     */
    public function getActive($user_id)
    {
        
        $story = $this->story::select('stories.is_active')
                            ->where('stories.user_id', '=', $user_id)
                            ->get();

        return $story;
    }

     /**
     * @param mixed $picture
     * @param mixed $id
     * 
     * @return [Story] $filename
     */
    public function createImage($request, $id)
    {
        
        $picture = $request->file('image');
    
        $filename = $request->image->getClientOriginalName();

        // Je recherche extension du fichier
        $picture_extension = strrchr($filename, '.' );
        
        // On renomme l'image en le concatenant avec l'id, un timestamp
        // et on ajoute l'extension
        $date = new DateTime();
    
        $pictureName = "picture_user_" . $id . '_' . $date->getTimestamp() . $picture_extension;
    
        // On insère l'image dans le repertoire public
        // Emplacement de l'image en taille réelle
        $path = 'resources/pictures/';

        //On oriente l'image convenablement
        $img = Image::make($picture->getRealPath())->orientate();

        $file_path  = $path . $pictureName;
    
        //On efface l'image qui a été enregistrée précédement
        if( File::isDirectory($path)) {
            // Permet d'effacer toutes les occurences enregistrées avant.
            array_map('unlink', glob($path . "picture_user_" . $id . "*"));
            
        } 

        // On enregistre l'image dans le repertoire public
        $img->save($file_path);
        

        $this->imageResize($picture, $pictureName, $id);

        //On enregistre l'image en base de données en faisant un update
        $storie = $this->story::where('stories.user_id', '=', $id)->first();
        if( $storie != null) {
            $storie->picture_path = $pictureName;
            $storie->is_done =  1;
            $storie->is_demo =  1;
            $storie->user_id = $id;
        
            $storie->update();
        }
        
        return response()->json([
            'picture' => $pictureName,
        ]);

    }


    /**
     * Permet de créer une mignature de l'image
     * @param mixed $picture
     * @param mixed $filename
     * 
     * @return void
     */
    public function imageResize($picture, $pictureName, $id)
    {
        
        // Emplacement de l'image en taille réduite
        $path = 'resources/pictures_min/';

        //Si le repertoire existe, on efface tout ce qu'il y a dans le repertoire
        if( File::isDirectory($path)) {
            // Permet d'effacer toutes les occurences enregistrées avant.
            array_map('unlink', glob($path . "picture_user_" . $id . "*"));
            
        } 

        //On oriente l'image convenablement
        $imgMin = Image::make($picture->getRealPath())->orientate()
                        ->resize(null, 400, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                        
        $imgMin->save($path . $pictureName);
    }

    /**
     * @param mixed $request
     * 
     * @return [Story] $storie 
     */
    public function finalize($request)
    {
        // On récupère l'id de l'utilisateur
        $userId = $request->userId;

         // On récupère la storie concernée
        $storie = Story::where('stories.user_id', '=', $userId)->first();
         // On récupère tous les champs renseignés.
        if( $storie != null) {
            $storie->story =  $request->story;
            $storie->bg_position_y = $request->bg_position_y;
            $storie->bg_position_x = $request->bg_position_x;
            $storie->is_active =  1;
            
            $storie->update();
    
            return "isActive";
        } else {
            return "isNotActive";
        }
    }


    /**
     * @param mixed $storyId
     * @param mixed $userId
     * 
     * @return [Story] $everyProfileData
     */
    public function getAllById($storyId, $userId)
    {
        $story = $this->story::select('stories.id', 'stories.story', 'stories.picture_path',
                                        'stories.bg_position_x', 'stories.bg_position_y',
                                        'stories.user_id', 'users.lastname', 'users.firstname',
            DB::raw('count(likes.user_id) as userlikes'))
            ->leftJoin('likes', function($join)  use ($userId)//Permet de poser la condition where sur $id
            {
                $join->on('stories.id', '=','likes.story_id')
                ->where('likes.user_id', '=', $userId);
            })
            ->join('users', 'users.id', '=', 'stories.user_id')
            ->groupBy('stories.id', 'stories.user_id', 'stories.picture_path', 'stories.bg_position_x',
                        'stories.bg_position_y', 'users.lastname', 'users.firstname')
            ->where('stories.id', '=', $storyId)
            ->get();

            // $previousStoryId =  Story::where('id', '<', $story[0]->id)->max('id');
            $previousStoryId = $this->story::where([
                                            ['id', '<', $story[0]->id],
                                            ['stories.is_demo', '=', 1],
                                            ['stories.is_done', '=', 1],
                                            ['stories.is_active', '=', 1] 
                                        ])->max('id');

                                    
            // $nextStoryId     =  Story::where('id', '>', $story[0]->id)->min('id');
            $nextStoryId     = $this->story::where([
                                            ['id', '>', $story[0]->id],
                                            ['stories.is_demo', '=', 1],
                                            ['stories.is_done', '=', 1],
                                            ['stories.is_active', '=', 1] 
                                        ])->min('id');

            $everyProfileData = [
                                    "story" =>  $story,
                                    "previousStoryId" => $previousStoryId,
                                    "nextStoryId" => $nextStoryId
                            ];

            return $everyProfileData; 
    }

    /**
     * Undocumented function
     *
     * @param [Story] $id
     * @return [Story] $story 
     */
    public function getById($id)
    {
    
        $story = $this->story::select('stories.story', 'stories.picture_path', 'stories.bg_position_x',
                                    'stories.bg_position_y', 'users.firstname', 'users.lastname',
                                    'regions.label as region_label', 'responsibles.label as responsible_label',
                                    'stories.id', DB::raw('COUNT(likes.story_id) as nbrOfLikes'))
                            
                            ->join('users', 'stories.user_id', '=', 'users.id')
                            ->join('regions', 'users.region_id', '=', 'regions.id')
                            ->join('responsibles', 'users.region_id', '=', 'responsibles.id')
                            ->leftJoin('likes', 'stories.id', '=', 'likes.story_id')
                            ->where('stories.user_id', $id)
                            ->groupBy('stories.id')
                            ->first();
        if($story) {

            return $story;
        } else {
            
            throw new CustomException;
        }
        
    }

    
    /**
     * @param mixed $id
     * 
     * @return [Story] $stories
     */
    public function getAll($id, $search = null)
    {
        
        $stories = $this->story::select('stories.id', 'stories.story', 'stories.picture_path', 'stories.bg_position_x',  
                        'stories.bg_position_y','stories.user_id', 'stories.is_active', 'u.lastname', 
                        'u.firstname', DB::raw('count(l.user_id) as userlikes'))

                        ->leftJoin('likes as l', function($join) use ($id)//Permet de poser la condition where sur $id
                        {
                            $join->on('stories.id', '=','l.story_id')
                            ->where('l.user_id', '=', $id);
                        })
                        ->join('users as u', 'u.id', '=', 'stories.user_id')
                        
                        // Recherche par search
                        ->where([
                                ["stories.story", 'like', "%$search%"],
                                ['stories.is_demo', '=', 1],
                                ['stories.is_done', '=', 1],
                                ['stories.is_active', '=', 1] 
                            ])
                        ->orWhere([
                                ["u.lastname", 'like', "%$search%"],
                                ['stories.is_demo', '=', 1],
                                ['stories.is_done', '=', 1],
                                ['stories.is_active', '=', 1]
                            ])
                        ->orWhere([
                                    ["u.firstname", 'like', "%$search%"],
                                    ['stories.is_demo', '=', 1],
                                    ['stories.is_done', '=', 1],
                                    ['stories.is_active', '=', 1]
                                
                            ])
                        ->groupBy('stories.id', 'stories.story', 'stories.picture_path', 'stories.bg_position_x',  
                                    'stories.bg_position_y','stories.user_id', 'stories.is_active', 'u.lastname', 
                                    'u.firstname')
                        ->orderBy('stories.updated_at', 'DESC')
                        ->paginate(10);

        return  $stories;
    }


    /**
     * @param null $queryRegion
     * @param null $queryByResponsible
     * 
     * @return [type]
     */
    public function getAllAdminPart($queryRegion = null, $queryByResponsible = null)
    {
        //On limite le nombre de résultat par page
        $pagination = Config::get('custom.pagination');

        $stories = $this->story::select('users.id as userId','stories.picture_path', 'stories.bg_position_x', 
                                    'stories.bg_position_y', 'users.firstname', 'users.lastname',
                                    'stories.id', DB::raw('COUNT(likes.story_id) as nbrOfLike'))
                                ->join('users', 'stories.user_id', '=', 'users.id')
                                ->rightJoin('regions', 'users.region_id', '=', 'regions.id')
                                ->rightJoin('responsibles', 'users.responsible_id', '=', 'responsibles.id')
                                ->leftJoin('likes', 'stories.id', '=', 'likes.story_id')
                                ->where([
                                        ['stories.is_demo', '=', 1],
                                        ['stories.is_active', '=', 1],
                                        ['stories.is_done', '=', 1],
                                        ['regions.id', 'like', "%$queryRegion%"],
                                        ['responsibles.id', 'like', "%$queryByResponsible%"],
                                    ])
                            
                                ->groupBy('stories.id')
                                ->orderBy('nbrOfLike', 'desc')
                                ->paginate($pagination);
        
                        // dd($stories);
        return $stories;
    }


    /**
     * Retourne les trente premières
     * résultats par nombre de likes
     * 
     * @return [Story] $stories
     */
    public function getByTop30()
    {
        
        $stories = Story::select('users.id as userId','stories.picture_path', 'stories.bg_position_x', 
                                    'stories.bg_position_y', 'users.firstname', 'users.lastname',
                                    'stories.id', DB::raw('COUNT(likes.story_id) as nbrOfLike'))
                        ->where([
                                ['stories.is_demo', '=', 1],
                                ['stories.is_active', '=', 1],
                                ['stories.is_done', '=', 1] 
                            ])
                        ->join('users', 'stories.user_id', '=', 'users.id')
                        ->join('regions', 'users.region_id', '=', 'regions.id')
                        ->join('responsibles', 'users.responsible_id', '=', 'responsibles.id')
                        ->leftJoin('likes', 'stories.id', '=', 'likes.story_id')
                        ->groupBy('stories.id')
                        ->orderBy('nbrOfLike', 'desc')
                        ->paginate(30);

        if($stories) {

                return $stories;
            } else {
                
                throw new CustomException;
            }

    }
}