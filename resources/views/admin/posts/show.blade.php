@extends('layouts.admin')

@section('content')
    <h1> {{$post->title}}</h1>
    <p>{{$post->content}}</p>
    <img width="300" src="{{asset('storage/' . $post->cover_image)}}" alt="">
    @if ($post->tags && count($post->tags) > 0 )
        @foreach($post->tags as $tag)
            <span>{{$tag->name}}</span>
        @endforeach
    @endif
@endsection