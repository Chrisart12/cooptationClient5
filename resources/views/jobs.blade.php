@extends('layouts.app')

@section('title', 'Jobs')
@section('page_title', 'OFFRES')

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
            <div class="jobs-list_label">
                <div>TITRE DU POSTE</div>
                <div>MAGASINS</div>
            </div>
            <div>
                @if (count($jobs) <= 0 )
                    <h1 class="text-center">Aucune offre n'est disponible</h1>
                @else
                    @foreach($jobs as $job)
                    <a class="jobs-list_link" href="{{ url('job/' . $job->id) }}">
                        <div class="jobs-list">
                            <div class="jobs-title-location">{{ $job->title }}</div>
                            <div class="jobs-title-location">{{ $job->location }}</div>
                        </div>
                    </a>
                    <br>
                    @endforeach
                @endif
            </div>	
		</div>
    </div>
</div>
@endsection
