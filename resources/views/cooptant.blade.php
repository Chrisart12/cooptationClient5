@extends('layouts.app')

@section('title', 'Cooptant')
@section('page_title', "$cooptant->lastname $cooptant->firstname")

@section('content')
<div class="container">
    <div class="row">
        <div class="jobs-container" >
            <div class="jobs-btn">
                <div class="buton">
                    <a href="javascript:history.back()"><button class="btn-back"><img src="{{ asset('images/icons/left9.png') }}">RETOUR</button></a>
                </div>
                <div class="buton">
                    <a href="{{ route('cooptants') }}"><button class="btn-back">COOPTANTS</button></a>
                </div>
            </div>
            <table class="cooptation_info_table">
                    <tr>
                        <th class="col-lg-3 col-sm-3 col-xs-3 cooptation_th">CANDIDATS</th>
                        <th class="col-lg-3 col-sm-3 col-xs-3 cooptation_th">REFERENCE</th>
                        <th class="col-lg-3 col-sm-3 col-xs-3 cooptation_th">POINTS</th>
                        <th class="col-lg-3 col-sm-3 col-xs-3 cooptation_th"></th>
                    </tr>
        
                @foreach($coopters as $coopter)
                        <tr>
                            <td class="col-lg-3 col-sm-3 col-xs-3 cooptation_td cooptation_td_black">
                                {{ strtoupper($coopter->lastname) . ' ' . $coopter->firstname }} 
                            </td>	
                            <td class="col-lg-3 col-sm-3 col-xs-3 cooptation_td">{{ $coopter->title }}</td>	
                            <td class="col-lg-3 col-sm-3 col-xs-3 cooptation_td">{{ $coopter->score}} </td>	
                            <td class="col-lg-3 col-sm-3 col-xs-3 cooptation_td"> 
                                <a href="{{'candidat' . '/' . $coopter->id }}">
                                    <button class="col-md-offset-4 btn-detail">ETAPE</button>
                                </a>
                            </td>
                        </tr>
                @endforeach
            </table>
		</div>
    </div>
    <div class="row text-center">
        <p>{{ $coopters->links() }}</p>
    </div>
</div>
@endsection
