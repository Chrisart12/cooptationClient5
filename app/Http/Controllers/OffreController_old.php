<?php

namespace App\Http\Controllers;

use App\Http\Resources\Offre\OffreCollection;
use App\Http\Resources\Offre\OffreResource;
use App\Model\Offre;
use Illuminate\Http\Request;

class OffreController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OffreCollection::collection(Offre::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function show(Offre $offre)
    {
        return new OffreResource($offre);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function edit(Offre $offre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offre $offre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offre $offre)
    {
        //
    }

     /**
     * Filtrage des offres.
     *
     * @param  string  $request
     * @return \Illuminate\Http\Response
     */
    public function search($query)
    {
     // $query = $request->input('storie');
//return $query;
        if($query != null) {
            $offres = Offre::where('offres.lieu', 'like', "%$query%")
            ->orWhere('offres.reference', 'like', "%$query%")
            ->orWhere('offres.poste', 'like', "%$query%")
            ->orWhere('offres.description', 'like', "%$query%")
            //->orWhere('categories.label', 'like', "%$query%")
            //->join('categories', 'categories.id', '=', 'offres.categorie_id')
            ->get();

        return $offres;
            }
     
    }
}
