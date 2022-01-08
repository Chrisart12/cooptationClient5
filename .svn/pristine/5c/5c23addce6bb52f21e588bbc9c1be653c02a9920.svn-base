<?php

namespace App\Repositories;

use DB;
use App\Model\Like;

/**
 * [Description CandidatRepository]
 */
class LikeRepository implements LikeInterface
{
    /**
     * @var [Like]
     */
    protected $like;

	
	/**
	 * @param Like $like
	 */
	public function __construct(Like $like)
	{
		$this->like = $like;
    }

    /**
     * Permet d'enregistrer le user_id et la story_id
     * @param mixed $userId
     * @param mixed $storyId
     * 
     * @return void
     */
    public function create($userId, $storyId)
    {
        $this->like->user_id = $userId;
        $this->like->story_id = $storyId;

        $this->like->save();
    }

    /**
     * @param mixed $story_id
     * @param mixed $user_id
     * 
     * @return void
     */
    public function delete($story_id, $user_id)
    {
        //On recherche l'id du like à effacer
        $likeId =  $this->like::select('likes.id')
                                ->where("likes.user_id", "=", $user_id)
                                ->where("likes.story_id", "=", $story_id)
                                ->first();
        $id = $likeId->id; 
        
        //On efface le like
        $this->like::where('id', $id)->delete();

        return true;

        // DB::delete('delete from likes where id = ?', [$id]);
    
    }

    /**
     * @param mixed $id
     * 
     * @return [Like] $likes
     */
    public function getById($id)
    {
        // $likes = $this->like::select('likes.id', 'likes.user_id', 'likes.story_id', 'stories.story', 
        //                             'stories.picture_path', 'stories.bg_position_x', 'stories.bg_position_y', 
        //                             'users.lastname', 'users.firstname')
        //                         ->where([
        //                             ['likes.user_id', '=', $id],
        //                             ['stories.is_demo', '=', 1],
        //                             ['stories.is_done', '=', 1],
        //                             ['stories.is_active', '=', 1],
        //                         ])
        //                         ->join('stories', 'stories.id', '=', 'likes.story_id')
        //                         ->join('users', 'users.id', '=', 'stories.user_id')
        //                         ->orderBy('stories.updated_at', 'DESC')
        //                         ->get();
        // return $likes;


        $likes = $this->like::select('stories.id', 'stories.story', 'stories.picture_path', 'stories.bg_position_x',  
                                        'stories.bg_position_y','stories.user_id', 'stories.is_active', 'users.lastname', 
                                        'users.firstname', DB::raw('count(likes.user_id) as userlikes'))
                                ->leftJoin('stories', function($join) use ($id)//Permet de poser la condition where sur $id
                                {
                                    $join->on('stories.id', '=','likes.story_id')
                                    ->where('likes.user_id', '=', $id);
                                })
                                ->where([
                                    ['likes.user_id', '=', $id],
                                    ['stories.is_demo', '=', 1],
                                    ['stories.is_done', '=', 1],
                                    ['stories.is_active', '=', 1],
                                ])
                                // ->join('stories', 'stories.id', '=', 'likes.story_id')
                                ->join('users', 'users.id', '=', 'stories.user_id')
                                ->groupBy('stories.id')
                                ->orderBy('likes.updated_at', 'DESC')
                                ->paginate(10);
                            // ->get();
                    return $likes;

    }


    

}