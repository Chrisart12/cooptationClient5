@extends('layouts.app')

@section('title', 'Cooptants')
@section('page_title', 'COOPTANTS')

@section('content')
<div class="container">
    <div class="row">
        <div class="jobs-container" >
            <div class="jobs-btn">
                <div class="buton">
                    <a href="javascript:history.back()"><button class="btn-back"><img src="{{ asset('images/icons/left9.png') }}">RETOUR</button></a>
                </div>
                <div class="buton">
                    <a href="{{ route('cooptation') }}"><button class="btn-back">CANDIDATS</button></a>
                </div>
            </div>
            <table class="cooptation_info_table">
                    <tr>
                        <th class="col-lg-3 col-sm-3 col-xs-3 cooptation_th">COLLABORATEURS</th>
                        <th class="col-lg-3 col-sm-3 col-xs-3 cooptation_th">NOMBRE DE CANDIDATS</th>
                        <th class="col-lg-3 col-sm-3 col-xs-3 cooptation_th">TOTAL DES POINTS</th>
                        <th class="col-lg-3 col-sm-3 col-xs-3 cooptation_th"></th>
                    </tr>
            
                @foreach( $cooptants as  $cooptant)
                    <tr>
                        <td class="col-lg-3 col-sm-3 col-xs-3 cooptation_td cooptation_td_black">
                            {{ strtoupper($cooptant->lastname) . ' ' . ucfirst($cooptant->firstname) }} 
                        </td>	
                        <td class="col-lg-3 col-sm-3 col-xs-3 cooptation_td">{{ $cooptant->nbre_candidats }}</td>	
                        <td class="col-lg-3 col-sm-3 col-xs-3 cooptation_td">{{  $cooptant->users_score }} </td>	
                        <td class="col-lg-3 col-sm-3 col-xs-3 cooptation_td">
                            <a href="{{'cooptant' . '/' . $cooptant->id }}">
                                <button class="col-md-offset-4 btn-detail">DETAIL</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
		</div>
    </div>
    <div class="row text-center">
        <p>{{  $cooptants->links() }}</p>
    </div>
</div>
@endsection
