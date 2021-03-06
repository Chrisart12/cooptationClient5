@extends('layouts.app')

@section('title', 'Cooptation')
@section('page_title', 'COOPTATION')

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
                {{-- <thead class="cooptation_label"> --}}
                    <tr>
                        <th class="col-lg-3 col-sm-3 col-xs-3 cooptation_th">CANDIDATS</th>
                        <th class="col-lg-3 col-sm-3 col-xs-3 cooptation_th">TITRE DU POSTE</th>
                        <th class="col-lg-3 col-sm-3 col-xs-3 cooptation_th">DATE DE CANDIDATURE</th>
                        <th class="col-lg-3 col-sm-3 col-xs-3 cooptation_th"></th>
                    </tr>
                {{-- </thead> --}}
        
                @foreach($cooptations as $cooptation)
                {{-- <tbody class="cooptation_list"> --}}
                    <tr>
                        <td class="col-lg-3 col-sm-3 col-xs-3 cooptation_td cooptation_td_black">
                            {{ strtoupper($cooptation->lastname) . ' ' . ucfirst($cooptation->firstname) }}
                        </td>	
                        <td class="col-lg-3 col-sm-3 col-xs-3 cooptation_td">{{ $cooptation->title }}</td>	
                        <td class="col-lg-3 col-sm-3 col-xs-3 cooptation_td">
                            {{ formateDateTime($cooptation->created_at) }}
                        </td>	
                        <td class="col-lg-3 col-sm-3 col-xs-3 cooptation_td">
                            <a href="{{'cooptant/candidat' . '/' . $cooptation->id }}">
                                <button class="col-md-offset-4 btn-detail">DETAIL</button>
                            </a>
                        </td>
                    </tr>
                {{-- </tbody>	 --}}
                @endforeach
            </table>
            
		</div>
    </div>
    <div class="row text-center">
        <p>{{ $cooptations->links() }}</p>
    </div>
</div>
@endsection
