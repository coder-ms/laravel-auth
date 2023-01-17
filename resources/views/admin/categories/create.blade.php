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
    <h1 class="text-center">CREATE CATEGORY</h1>
    <div class="row bg-white">
        <div class="col-12">

            <form action="{{route('admin.categories.store')}}" enctype="multipart/form-data" method="POST" class="p-4">
                @csrf
                  <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="name" name="name" required maxlength="50" minlength="3">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">* Minimo 3 caratteri massimo 50 caratteri</div>
                  </div>

                  <button type="submit" class="btn btn-success">Submit</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
            </form>
            
        </div>
    </div>

@endsection