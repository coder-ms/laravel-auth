@extends('layouts.admin')

@section('content')
    <h1 class="text-center">I MIEI PROGETTI</h1>
    <a class="btn btn-success" href="{{route('admin.posts.create')}}">Crea nuovo Post</a>
    @if(session()->has('message'))
    <div class="alert alert-success mb3 mt-3">
        {{session()->get('message')}}
    </div>
    @endif
    <div class="containerx">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Contenuto</th>
                    <th scope="col">Modifica</th>
                    <th scope="col">Cancella</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{$post->id}}</th>
                        <td><a class="text-decoration-none" href="{{route('admin.posts.show', $post->slug)}}" title="View Post">{{$post->title}}</a></td>
                        <td>{{Str::limit($post->content, 100)}}</td>
                        <td><a class="link-secondary" href="{{route('admin.posts.edit', $post->slug)}}"><i class="fa-solid fa-pen"></i></a></td>
                        <td>
                            <form action="{{route('admin.posts.destroy', $post->slug)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button btn btn-danger ms-3" data-item-title="{{$post->title}}"><i class="fa-solid fa-trash-can"></i></button>
                                
                            </form>    
                        </td>                        
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    @include('partials.admin.modal-delete')
@endsection