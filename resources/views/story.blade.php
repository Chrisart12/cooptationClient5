@extends('layouts.app')

@section('title', 'Cooptants')
@section('page_title', 'COLABORATEUR')

@section('content')
<div class="container">
    <div class="jobs-btn">
        <div class="buton">
            <a href="javascript:history.back()"><button class="btn-back"><img src="{{ asset('images/icons/left9.png') }}">RETOUR</button></a>
        </div>
    </div>
    <div class="story-container">
        <div class="story-container-image" >         
            <div class="story-image" 
                style="background-image: url({{ asset('resources/pictures/' . $story->picture_path) }});
                        background-position-x: {{ $story->bg_position_x }}%;
                        background-position-y: {{ $story->bg_position_y }}%;
                    ">
                <div class="story-name">{{ strtoupper($story->lastname) }} {{ strtoupper($story->firstname) }}</div>
                <div class="story-like-image"  style="background-image: url({{ asset('images/icons/like.png') }})">
                    <div class="story-like"> {{ $story->nbrOfLikes }}</div>
                </div>    
            </div>
            <div class="story-infos">
                <div class="story-region">Region : {{ $story->region_label }}</div>
                <div class="story-responsible">Responsable : {{ $story->responsible_label }}</div>
                <div class="story-story">{{ $story->story }}</div>      
            </div>
            
        </div>
    </div>
</div>
@endsection
