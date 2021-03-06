@extends('layouts.app')

@section('title', 'Cooptants')
@section('page_title', 'TOP 30')

@section('content')
<div class="container">
    <div class="jobs-btn">
        <div class="buton">
            <a href="javascript:history.back()">
                <button class="btn-back"><img src="{{ asset('images/icons/left9.png') }}">
                    {{ Lang::get('lang.back') }}
                </button>
            </a>
        </div>
    </div>
    <div class="container">
        <div class="top30-container">
            @foreach ($stories as $storie)
                <div class="gallery-container-image" > 
                        <a class="lien-image" href="{{ url('/gallery/' . $storie->userId) }}">
                            <div class="gallery-image" 
                                style="background-image: url({{ asset('resources/pictures/' . $storie->picture_path) }});
                                        background-position-x: {{ $storie->bg_position_x }}%;
                                        background-position-y: {{ $storie->bg_position_y }}%;
                                ">
                                <div class="gallery-name">
                                    {{ strtoupper($storie->lastname) }} {{ strtoupper($storie->firstname) }}
                                </div>
                                <div class="zoom"><img src="{{ asset('images/icons/add.png') }}" alt="add"/></div> 
                                <div class="gallery-like-image" 
                                            style="background-image: url({{ asset('images/icons/like_3.png') }})">
                                    <div class="gallery-like">{{ $storie->nbrOfLike }}</div>
                                </div>     
                            </div>
                        </a>
                </div>
            @endforeach  
        </div>
    </div>
    
</div>
@endsection
