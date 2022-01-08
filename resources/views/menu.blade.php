@extends('layout.gallerylayout')

@section('content')

	<?php 

		$baseUrl = App::make('url')->to('/');
		
	?>
	<div class="scrollable">
		<div class="row  text-center container-menu" id="menu">
			
				<div class="menu">
					<a href="{{ url('gallery') }}">
						GALERIE
					</a>
				</div>
				<div class="menu">
					<a href="{{ url('cgu') }}">CGU</a>	
				</div>
					
				<div class="menu">
					{{-- <a href="{{ url('offer') }}">OFFRES</a> --}}
					
					<a href="{{ url('offres')}}">OFFRES</a>
				</div>
				<div class="deconnect">
					{{-- <a href="{{ url('offer') }}">OFFRES</a> --}}
					<a href="{{ url('/logout')}}">SE DECONNECTER</a>
				</div>
				
		</div>
	</div>

@stop