<?php 

namespace App\Repositories;


interface StorieInterface
{
    public function createImage($request, $id);

    public function imageResize($picture, $pictureName, $id);

    public function getAllById($storyId, $userId);

    public function getById($id);

    public function finalize($request);

    public function getAll($id, $search = null);

    public function getActive($user_id);

    public function getAllAdminPart($queryRegion = null, $queryByResponsible = null);

    public function getByTop30();
    
}