@extends('layouts.app')

@section('content')

    <div class="containerx">

        @foreach ($posts as $post)
            <div class="card">
                <div class="cardDescription"> 
                    <p>Nome Repo: {{$post->title}}</p>
                    <p>Modello: {{$post->slug}}</p>
                    <p>Descrizione: <br>{{ Str::limit($post->content)}}</p>
                   
                </div>
            </div>
        
        @endforeach
    </div>
@endsection