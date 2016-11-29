@extends('layouts.app')
@section('style')
<link href="{{ asset('css/home.css') }}" rel="stylesheet" type="text/css" >
@endsection
@section('script')
<!--<script type="text/javascript" src="{{ asset('js/game.js') }}"></script>-->
<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
@endsection

@section('content')
@include('partials.nav')
<div class="main">
    <div class="main-container">
        <div class="title ostrich"> BISAME </div>
        <div class="button-wrapper">
            @if (Auth::guest())
            <span>
                <a class='btn btn-default play-button active-button ostrich' href="/login">Connexion</a>
            </span>

            <span>
                <a class='btn btn-default play-button active-button ostrich' href="/register">Inscription</a>
            </span>
            @else
            @if(!$game_available)
            <h3 class="info-message">Commencez par l'entraînement (quatre phrases) pour débloquer le jeu et commencer à gagner des points :
            </h3>
            <br>
            @else
            <h3 class="info-message">Bravo, vous avez débloqué la phase de production d'annotations ! A vous de jouer !
            </h3>
            <br>
            @endif
            <div class="button-wrapper">
                <span>
                    <a class='btn btn-default play-button active-button ostrich' id="play-button-1" href="/home/training">S'entrainer</a>
                </span> 
                @if($game_available)
                <span>
                    <a class='btn btn-default play-button active-button ostrich' id="play-button-2" href="/home/start">Produire des annotations !</a>
                </span>
                @else
                <span>
                    <a class='btn btn-default play-button b-disabled ostrich' id="play-button-2" disabled>Produire des annotations !</a>
                </span>
                @endif
            </div>
            @endif

        </div>
        <div class="info-wrapper">
            <h3 class="info-message">
                <br> L'<b class="ostrich">alsacien</b> fait partie de la grande majorité des "langues peu dotées" au sens des technologies du langage.</br>  
                <br> Aucun des outils des nouvelles technologies de la langue - par exemple : correction orthographique, aide à la traduction, extraction d'information - qui contribuent à faire exister les langues sur Internet n'est développé pour l'alsacien.</br> 
                <br> La raison ? Il existe très peu de données "annotées", c'est-à-dire enrichies d'informations linguistiques, à partir desquelles développer de tels outils.
                C'est pourquoi nous faisons appel à vous : locuteurs de l'alsacien, passionnés ou non de grammaire, désireux dans tous les cas de contribuer au déploiement de votre langue, participez grâce à <b><span class="ostrich"> BISAME</span> </b> à la création d'un corpus de l'alsacien annoté en catégories grammaticales !</br> 
                <br> Pour tout complément d'information sur ce projet de recherche réalisé dans le cadre d'un doctorat en Traitement Automatique des Langues à la Sorbonne en collaboration avec l'équipe du projet RESTAURE du LiLPa de Strasbourg, 
                <a style="color:#AC1E44;" href="mailto:alice.millour@abtela.eu?Subject=[Bisame]Contact" style="color:black" target="_top">Me contacter par mail</a>
                . </br> Ce projet étant en cours d'amélioration n'hésitez pas à me transmettre vos remarques ou suggestions !<br>
                <br> Alice 
                <br>
                <a style="color:#AC1E44;" href="https://www.francebleu.fr/emissions/l-alsace-vue-par-le-net-en-alsacien/elsass/l-alsace-vue-par-le-net-en-alsacien-57"
                   target="_blank"> <br> <b> Lien vers la chronique de Pierre Nuss (France Bleu Elsass)</b></a> 
                <span>
                    <img style="margin:1%" height="42" width="42" src="/images/fbe.png"/>  

                </span>
            </h3>
        </div>
    </div>
    <div class="main-footer">
        <div class="footer-container" id="scoreboard">
            @include('partials.scoreboard')
        </div> 
    </div> 
</div>
@endsection
