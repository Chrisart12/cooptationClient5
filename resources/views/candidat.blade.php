@extends('layouts.app')

@section('title', 'Candidat')
@section('page_title', "$candidat->candidat_lastname $candidat->candidat_firstname")

@section('content')
<div class="container">
    <div class="row">
        <div class="jobs-container" >
            <div class="jobs-btn">
                <div class="buton">
                    <a href="javascript:history.back()">
                        <button class="btn-back"><img src="{{ asset('images/icons/left9.png') }}" />
                            {{ Lang::get('lang.back') }}
                        </button>
                    </a>
                </div>
                <div class="buton">
                    <a href="{{ route('cooptants') }}"><button class="btn-back">{{ Lang::get('lang.coopting') }}</button></a>
                </div>
            </div>
            <div class="candidat-detail_flex">
                <div>
                    <div class="candidat-label text-center">CANDIDAT</div>
                    <br>
                    <div class="candidat-job-info">
                        <p class="cooptants"><span class="candidat-job-info_detail">Candidat :</span> {{ strtoupper($candidat->candidat_lastname) . 
                                ' ' . ucfirst($candidat->candidat_firstname) }} </p>
                        <p class="cooptants"><span class="candidat-job-info_detail">Email :</span> {{ $candidat->email }} </p>
                        <p class="cooptants"><span class="candidat-job-info_detail">Titre :</span> {{ $candidat->title }} </p>
                        <p class="cooptants"><span class="candidat-job-info_detail">Lieu de travail :</span> {{ $candidat->location }} </p>
                        <p class="cooptants"><span class="candidat-job-info_detail">Référence :</span> {{ $candidat->reference }} </p>
                        <p class="cooptants"><span class="candidat-job-info_detail">Lien : </span><a href="{{ $candidat->url }}" target="_blank">
                            {{ substr($candidat->url, 0, 29) }}...</a></p>
                        <p class="cooptants"><span class="candidat-job-info_detail">Catégorie :</span> {{ $candidat->label }} </p>
                        <p class="cooptants"><span class="candidat-job-info_detail">Date de candidature :</span> {{ formatShortDateTime($candidat->created_at) }} </p>
                        <p class="cooptants"><span class="candidat-job-info_detail">Cooptant :</span> {{ strtoupper($candidat->user_lastname) . 
                            ' ' . ucfirst($candidat->user_firstname) }} </p>
                    </div>
                    <br>
                </div>
        
                <div class="canditate-validate-and-date_flex">
                    <div>
                        
                        <div class="candidat-label text-center">ETAPES</div>
                        <br>
                        @if($candidat->is_done == 1)
                                
                            @foreach($etapes as $etape)
                                    <div class="candidat-container-etape">
                                        <div class="candidat-container-etape-hidden">
                                            <img src="{{ asset('images/icons/this.png') }}" />
                                        </div>
                                        <button type="submit" class="text-center boutons btn-end-etape fin-etape" 
                                            disabled="disabled" >
                                            {{ $etape->label }}
                                        </button>
                                    </div>
                            @endforeach
                            
                        @else
                        
                            @foreach($etapes as $etape)
                                <form method="POST" action="{{ route('etapes') }}" 
                                    data-remote data-remote-success-message="L'étape{{ $candidat->label }} est passée.">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="categorie_id" id="categorie_id" 
                                            value="{{ $candidat->categorie_id }}">
                                    <input type="hidden" name="id" id="firstRdv" value="{{ $candidat->candidat_id }}">
                                        {{-- J'ai changé cette partie en recherchant l'étape courante dans la table candidat currentStep --}}
                                    {{-- @if($etape->step_id != $step->step_id) --}}
                                    @if($etape->step_id != $currentStep->step_id)

                                        {{-- @if($etape->ordre < $step->ordre) --}}
                                        @if($etape->ordre < $currentStep->ordre)
                                            <div class="candidat-container-etape">
                                                <div class="candidat-container-etape-hidden">
                                                    <img src="{{ asset('images/icons/this.png') }}" />
                                                </div>
                                                <button type="submit" 
                                                    class="fin-etape text-center boutons btn-end-etape color-etape" 
                                                    data-background-color="#69f0ae" data-tex-color="blue" disabled="disabled">
                                                        {{ $etape->label }}
                                                </button>
                                            </div>
                                        @else
                                            <div class="candidat-container-etape">
                                                <div class="candidat-container-etape-hidden">
                                                    <img src="{{ asset('images/icons/this.png') }}" />
                                                </div>
                                                <button type="submit" class="etapes text-center boutons btn-etape-disabled" 
                                                data-background-color="#69f0ae" data-tex-color="blue" disabled="disabled" >
                                                    {{ $etape->label }}
                                                </button>
                                            </div>
                                        @endif
                                    @else
                                        <div class="candidat-container-etape">
                                            <div><img src="{{ asset('images/icons/this.png') }}" /></div>
                                            <button type="submit"  class="etapes text-center btn-etape boutons">
                                                {{ $etape->label }}
                                            </button>
                                        </div>
                                    @endif
                                </form> 
                            @endforeach
                        @endif
                    </div>
                    <div>
                        <div class="candidat-label text-center">DATES</div>
                        <br>

                        @foreach($historicStepCandidats as $historicStepCandidat)
                            <div class="canditat-date-validation">
                                <p class="text-center">
                                    {{ formateDateTime($historicStepCandidat->created_at) }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
		</div>
    </div>
</div>
@endsection
