@extends('layouts.app')

@section('title', 'Cooptation')
@section('page_title', 'HISTORIQUE')

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
                    <th class="col-lg-2 col-sm-2 col-xs-2 cooptation_th">CANDIDATS</th>
                    <th class="col-lg-2 col-sm-2 col-xs-2 cooptation_th">COOPTANTS</th>
                    <th class="col-lg-2 col-sm-2 col-xs-2 cooptation_th">ETAPES</th>
                    <th class="col-lg-2 col-sm-2 col-xs-2 cooptation_th">ADMINISTRATEURS</th>
                    <th class="col-lg-2 col-sm-2 col-xs-2 cooptation_th">DATE DE VALIDATION</th>
                </tr>
        
                @foreach($historics as $historic)
                    <tr>
                        <td class="col-lg-2 col-sm-2 col-xs-2 cooptation_td cooptation_td_black">
                            {{ strtoupper($historic->candidat_lastname) . ' ' . ucfirst($historic->candidat_firstname) }}
                        </td>	
                        <td class="col-lg-2 col-sm-2 col-xs-2 cooptation_td cooptation_td_black">
                            {{ strtoupper($historic->user_lastname) . ' ' . ucfirst($historic->user_firstname) }}
                        </td>	
                        <td class="col-lg-2 col-sm-2 col-xs-2 cooptation_td">{{ $historic->label }}</td>
                        <td class="col-lg-2 col-sm-2 col-xs-2 cooptation_td cooptation_td_black">
                            {{ strtoupper($historic->admin_lastname) . ' ' . ucfirst($historic->admin_firstname) }}
                        </td>	
                        <td class="col-lg-2 col-sm-2 col-xs-2 cooptation_td">
                            {{ formateDateTime($historic->created_at) }} 
                        </td>	
                        {{-- <td class="col-lg-3 col-sm-3 col-xs-3 cooptation_td">
                            <a href="{{'cooptant/candidat' . '/' . $cooptation->id }}">
                                <button class="col-md-offset-4 btn-detail">DETAIL</button>
                            </a>
                        </td> --}}
                    </tr>
                @endforeach
            </table>
            
		</div>
    </div>
    <div class="row text-center">
        <p>{{ $historics->links() }}</p>
    </div>
</div>
@endsection
