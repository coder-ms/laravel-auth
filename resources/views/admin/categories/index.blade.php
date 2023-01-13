@extends('layouts.admin')

@section('content')
    <h1 class="text-center">Categories</h1>
    <a class="btn btn-success" href="{{route('admin.categories.create')}}">Crea nuova Categoria</a>
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
                    <th scope="col">Name</th>
                    <th scope="col">Posts</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{$category->id}}</th>
                        <td><a class="text-decoration-none" href="{{route('admin.categories.show', $category->slug)}}" title="View Post">{{$category->name}}</a></td>
                        <td>{{count($category->posts)}}</td>
                        <td><a class="link-secondary" href="{{route('admin.categories.edit', $category->slug)}}"><i class="fa-solid fa-pen"></i></a></td>
                        <td>
                            <form action="{{route('admin.categories.destroy', $category->slug)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button btn btn-danger ms-3" data-item-title="{{$category->name}}"><i class="fa-solid fa-trash-can"></i></button>
                                
                            </form>    
                        </td>                        
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    @include('partials.admin.modal-delete')
@endsection