@extends('layouts.app')

@section('title', 'Job')
@section('page_title', 'OFFRE')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-1 col-md-10 jobs-container" >
            <div class="jobs-btn">
                <div class="buton">
                    <a href="javascript:history.back()"><button class="btn-back"><img src="{{ asset('images/icons/left9.png') }}">RETOUR</button></a>
                </div>
                <div class="buton">
                    <a href="{{ route('cooptants') }}"><button class="btn-back">COOPTANTS</button></a>
                </div>
            </div>
            <div class="row">
                <h2 class="text-title">{{ $job->title }}</h2>
                <div class="col-md-8 job-description" > {!! $job->description !!}</div>
                <div class="col-md-4 job-info">
                    <div class="job-info_label_margin-bottom">
                        <div class="job-info_label_bold">Numéro de réference : </div>
                        <div>{{ $job->id }}</div>
                    </div> 
                    <div class="job-info_label_margin-bottom">
                        <div class="job-info_label_bold">Date de début souhaitée : </div>
                        <div>{{ formatShortDateTime($job->date_start) }} </div>
                        
                    </div>
                    <div class="job-info_label_margin-bottom">
                        <div class="job-info_label_bold">Lieu de travail : </div>
                        <div>{{ $job->location}}</div>
                    </div>
                </div>
                
            </div>
            <div>

            </div>	
		</div>
    </div>
</div>
@endsection
