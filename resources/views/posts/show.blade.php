@extends('layouts.app') <!-- we match the show page with the app.blade -->
@section('title') Show @endsection <!-- we fill the empty sapce by the right title of the page.blade -->
@section('content')
            <div class="card mt-3">
                <div class="card-header">
                    Article {{$post->CodeArticle}}
                </div>
                <div class="card-body">
                    <h3>Nom Article : {{$post->NomArticle}}</h3>
                    <p>Code Article : {{$post->CodeArticle}} </p>
                </div> 
                <div class="card-body">
                    <h3>Quantité : {{$post->quantite}}</h3>
                    <p>Prix Unitaire HT : {{$post->puht}}</p>
                    <p>Créé à : {{$post->created_at}}</p>
                    <p>Mise à jour à : {{$post->updated_at}}</p>
                </div>
            </div>
@endsection
       