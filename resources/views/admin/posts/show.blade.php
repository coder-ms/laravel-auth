@extends('layouts.admin')

@section('content')
    <h1>{{$post->title}}</h1>
    <div class="containerx">
        <div class="cardShow">
            <div class="cardImageShow">
                <img src="{{asset('storage/' . $post->cover_image)}}" alt="">
            </div>
              <div class="cardDescriptionShow">
                <p>{{$post->content}}</p>
                <p>Link GitHub: {{$post->link_git}}</p>
                <p>Livello difficoltà: {{$post->lvl_diff}} / 10</p>
                @if ($post->category)
                    <p>Category: {{$post->category->name}}</p>
                @endif
                <p>Tags: </p>
                @if ($post->tags && count($post->tags) > 0 )
                    <ul>
                        @foreach($post->tags as $tag)
                            <li>{{$tag->name}}</li>
                        @endforeach
                    </ul>
                @endif
                <a href="{{route('admin.posts.index', $post->slug)}}" class="btn btn-primary">INDIETRO</a>
                <a href="{{route('admin.posts.edit', $post->slug)}}" class="btn btn-secondary">MODIFICA</a>
                <form action="{{route('admin.posts.destroy', $post->slug)}}" method="POST" class=" d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">ELIMINA</button>
                </form>
              </div>
        </div>
    </div>

@endsection


