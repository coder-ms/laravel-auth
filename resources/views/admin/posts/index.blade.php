@extends('layouts.admin')

@section('content')
    <h1 class="text-center">I MIEI PROGETTI</h1>

    <div class="text-end">
        <a class="btn btn-success" href="{{route('admin.posts.create')}}">Crea nuovo post</a>
    </div>
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
                    <th scope="col">Framework</th>
                    <th scope="col">Livello</th>
                    <th scope="col">Contenuto</th>
                    <th scope="col">ID</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Github</th>
                    <th scope="col">Modifica</th>
                    <th scope="col">Cancella</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                @if( ($post->user_id == $ActUserId) || $isUserAdmin )
                    <tr>
                        <th scope="row">{{$post->id}}</th>
                        <td><a class="text-decoration-none" href="{{route('admin.posts.show', $post->slug)}}" title="View Post">{{$post->title}}</a></td>
                        <td>
                            @if ($post->category_id)
                                @foreach ($categories as $category)
                                    @if( $category->id == $post->category_id)   
                                        <p>{{$category->name}}</p>
                                    @endif
                                @endforeach
                            @else
                                <p>{{'Senza categoria'}}</p>
                            @endif

                            {{--
                                {{$post->category ? $post->category->name : 'Senza categoria'}}

                                LAVORA SU INDEX ID MA SE LE POSIZIONI NON SONO CONSECUTIVE VA IN ERRORE
                                <p>{{$categories[(($post->category_id) - 1)]->name}}</p>
                            --}}
                           
                        </td>
                        <td>{{$post->lvl_diff}} / {{$lvl_diff_max}}</td>
                        <td>{{Str::limit($post->content,100)}}</td>
                        <td>{{$post->user_id}} / {{$ActUserId}}</td>
                        <td>{{$post->tags && count($post->tags) > 0 ? count($post->tags) : 0 }}</td>
                        <td><a class="text-decoration-none" href="{{($post->link_git)}}">{{$post->link_git}}</a></td>
                        <td><a class="link-secondary" href="{{route('admin.posts.edit', $post->slug)}}"><i class="fa-solid fa-pen"></i></a></td>
                        <td>
                            <form action="{{route('admin.posts.destroy', $post->slug)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button btn btn-danger ms-3" data-item-title="{{$post->title}}"><i class="fa-solid fa-trash-can"></i></button>
                                
                            </form>    
                        </td>                        
                    </tr>
                @endif
                @endforeach
            </tbody>
        </table>

    </div>
    {{ $posts->links('vendor.pagination.bootstrap-5') }}
    @include('partials.admin.modal-delete')
@endsection