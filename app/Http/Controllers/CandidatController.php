<?php

namespace App\Http\Controllers;

use App\Model\Candidat;
use App\Model\Offre;
use Illuminate\Http\Request;
use App\Http\Resources\Candidat\CandidatCollection;
use App\Http\Resources\Candidat\CandidatResource;
use App\Http\Requests\CandidatRequest;

class CandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CandidatCollection::collection(Candidat::all());
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
    public function storeCandidat(CandidatRequest $request) 
    {
        // On crée une instance de Candidat
            $candidat = new Candidat;
        
            $candidat->firstname = $request->firstname;
            $candidat->lastname = $request->lastname;
            $candidat->offre_id = $request->offre_id;
            //On récupère les données de l'offre à travers son id
            $offre = Offre::findOrFail($request->offre_id);
            $candidat->poste = $offre->poste;
            $candidat->reference =  $offre->reference;
            $candidat->save();

            return "Tout s'est bien passé.";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Moodel\Candidat  $candidat
     * @return \Illuminate\Http\Response
     */
    public function show(Candidat $candidat)
    {
        return new CandidatResource($candidat);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Moodel\Candidat  $candidat
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidat $candidat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Moodel\Candidat  $candidat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidat $candidat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Moodel\Candidat  $candidat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidat $candidat)
    {
        //
    }
}
