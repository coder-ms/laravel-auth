@extends('layouts.app')

@section('content')
    <ul>
        @foreach ($posts as $post)
            <li>{{$post->title}}</li>
        @endforeach
    </ul>
@endsection