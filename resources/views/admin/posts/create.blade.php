@extends('layouts.admin')

@section('content')

    {{-- <div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div> --}}
    <h1 class="text-center">CREATE POST</h1>
    <div class="row bg-white">
        <div class="col-12">

            <form action="{{route('admin.posts.store')}}" method="POST" class="p-4">
                @csrf
                  <div class="mb-3">
                    <label for="title" class="form-label">Titolo</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="content" class="form-label">Contenuto</label>
                    <textarea class="form-control" id="content" name="content"></textarea>
                  </div>
                  
                  <div class="mb-3">
                    <label for="framework" class="form-label">Tipologia di framework:</label>
                    <input type="text" class="form-control" id="framework" name="framework" required>
                  </div>

                  <div class="mb-3">
                    <label for="link_git" class="form-label">Link Github:</label>
                    <input type="text" class="form-control" id="link_git" name="link_git" required>
                  </div>

                  <div class="mb-3">
                    <label for="lvl_diff" class="form-label">Livello di Difficoltà:</label>
                    <input type="text" class="form-control" id="lvl_diff" name="lvl_diff" aria-describedby="levelHelp" required>
                    <div id="levelHelp" class="form-text">Scala di diifcoltà da 1(facile) a 10(molto difficile)</div>
                  </div>
                    <!--
                    <div class="mb-3">
                        <label for="image" class="form-label">Url Immagine</label>
                        <input type="text" class="form-control" id="image" name="image" required>
                    </div>
                    -->
                  <button type="submit" class="btn btn-success">Submit</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
            </form>
            
        </div>
    </div>

@endsection