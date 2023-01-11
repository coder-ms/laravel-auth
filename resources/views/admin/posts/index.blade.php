@extends('layouts.app')

@section('content')

    <div class="containerx">

        @foreach ($posts as $post)
            <div class="cardx">
                <div class="cardDescriptionx"> 
                    <p>Nome Repo: {{$post->title}}</p>
                    <p>Modello: {{$post->slug}}</p>
                    <p>Difficoltà: {{$post->lvl_diff}}/10</p>
                    <p>Descrizione: <br>{{ Str::limit($post->content, 50)}}</p>
                    <p>Framework Usato: {{$post->content}}</p>
                    <p>Link GitHub: <a href="{{$post->link_git}}">Link</a></p>
                </div>
            </div>
        
        @endforeach
    </div>
@endsection