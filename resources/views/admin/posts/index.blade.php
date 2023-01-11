@extends('layouts.admin')

@section('content')

    <div class="containerx">

        @foreach ($posts as $post)
            <div class="cardx">
                <div class="cardDescriptionx"> 
                    <p>Nome Repo: {{$post->title}}</p>
                    <p>Modello: {{$post->slug}}</p>
                    <p>Difficoltà: {{$post->lvl_diff}}/10</p>
                    <p>Descrizione: <br>{{ $post->content}} {{--</p> Str::limit($post->content, 80)--}}</p>
                    <p>Framework Usato: {{$post->content}}</p>
                    <a href="{{$post->link_git}}" class="btn btn-primary">Link Github</a>
                </div>
            </div>
        
        @endforeach
    </div>
@endsection