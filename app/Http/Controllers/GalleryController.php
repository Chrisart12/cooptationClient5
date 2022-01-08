<?php

namespace App\Http\Controllers;

use Auth;
use Exception;
use Illuminate\Http\Request;
use App\Exceptions\CustomException;
use App\Repositories\RegionInterface;
use App\Repositories\ResponsibleInterface;
use App\Repositories\StorieInterface;
use App\Http\Requests\GalleryRequest; 

use App\Model\User;
use App\Model\Story;

class GalleryController extends Controller
{
    /**
    * Undocumented variable
    *
    * @var [GalleryInterface]
    */
    protected $regionInterface;
    protected $responsibleInterface;
    protected $storieInterface;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RegionInterface $regionInterface, ResponsibleInterface $responsibleInterface,
                                StorieInterface $storieInterface)
    {
        // $this->middleware('auth');
        $this->regionInterface = $regionInterface;
        $this->responsibleInterface = $responsibleInterface;
        $this->storieInterface = $storieInterface;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GalleryRequest $request)
    {

        $queryRegion = $request->input('region');
        $queryByResponsible =  $request->input('responsible');
        // dd($queryByResponsible);
        $stories = $this->storieInterface->getAllAdminPart($queryRegion, $queryByResponsible);

        
        // dd(Story::find(1)->story);
        

        $regions = $this->regionInterface->getByRegion();
        $responsibles = $this->responsibleInterface->getByResponsible();
        
        return view('gallery', compact('regions', 'responsibles', 'stories'));
    
    }

    /**
     * 
     * Retourne une story
     *
     * @param [type] $id
     * @return void
     */
    public function show(int $id)
    {
        if($id) {

            $story =  $this->storieInterface->getById($id);
            
            return view('story', compact('story'));
        }
            
    }

    /**
     * Retourne les 30 premières stories
     * ayant plus de likes
     *
     * @return void
     */
    public function top30()
    {
        $stories = $this->storieInterface->getByTop30();
        
        return view('top30', compact('stories'));
    }
}
