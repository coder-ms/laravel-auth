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
    <h1 class="text-center">EDIT POST {{$post->title}}</h1>
    <div class="row bg-white">
        <div class="col-12">
            <form action="{{route('admin.posts.update', $post->slug)}}" method="POST" class="p-4" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                  <div class="mb-3">
                    <label for="title" class="form-label">Titolo</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title', $post->title)}}">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="content" class="form-label">Contenuto</label>
                    <textarea class="form-control" id="content" name="content">"{{old('content', $post->content)}}</textarea>
                  </div>

                  <div class="mb-3">
                    <label for="category_id" class="form-label">Seleziona categoria di framework:</label>
                    <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                      <option value="">Select category</option>
                      @foreach ($categories as $category)
                          <option value="{{$category->id}}" {{ $category->id == old('category_id', $post->category_id) ? 'selected' : '' }}>{{$category->name}}</option>
                      @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="mb-3">
                    <label for="link_git" class="form-label">Link Github:</label>
                    <input type="text" class="form-control" id="link_git" name="link_git" value="{{old('link_git', $post->link_git)}}" required>
                  </div>

                   <div class="mb-3">
                    <label for="lvl_diff" class="form-label">Livello di Difficoltà:</label>
                    <select name="lvl_diff" id="lvl_diff" aria-describedby="levelHelp" required>
                      @for($ix=1; $ix <= $lvl_diff_max; $ix++)
                        <option value="{{$ix}}" {{old('lvl_diff', $post->lvl_diff == $ix ? 'selected' : '')}}>{{$ix}}</option>
                      @endfor
                    </select>
                   <div id="levelHelp" class="form-text">Scala di diffcoltà da 1(facile) a {{$lvl_diff_max}}(molto difficile)</div>
                  </div>

                  <div class="d-flex">
                    <div class="media me-4">
                        <img class="shadow" width="150" src="{{asset('storage/' . $post->cover_image)}}" alt="{{$post->title}}">
                    </div>
                    <div class="mb-3">
                        <label for="cover_image" class="form-label">Replace post image</label>
                        <input type="file" name="cover_image" id="cover_image" class="form-control  @error('cover_image') is-invalid @enderror" >
                        @error('cover_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>

                  {{-- <div class="mb-3">
                    <label for="tags" class="form-label">Tags</label>
                    <select multiple class="form-select" name="tags[]" id="tags" >
                      <option value="">Select tag</option>
                      @forelse ($tags as $tag)
                          @if($errors->any() )
                            <option value="{{$tag->id}}" {{in_array($tag->id, old('tags[]')) ? 'selected' : ''}}>{{$tag->name}}</option>
                          @else
                            <option value="{{$tag->id}}" {{$post->tags->contains($tag->id) ? 'selected' : ''}}>{{$tag->name}}</option>
                          @endif
                      @empty
                        <option value="">No tag</option>
                      @endforelse
                    </select>
                  </div>  --}}

                  <div class="mb-3">
                    @foreach ($tags as $tag)
                    <div class="form-check form-check-inline">

                        @if (old("tags"))
                            <input type="checkbox" class="form-check-input" id="{{$tag->slug}}" name="tags[]" value="{{$tag->id}}" {{in_array( $tag->id, old("tags", []) ) ? 'checked' : ''}}>
                        @else
                            <input type="checkbox" class="form-check-input" id="{{$tag->slug}}" name="tags[]" value="{{$tag->id}}" {{$post->tags->contains($tag) ? 'checked' : ''}}>
                        @endif
                        <label class="form-check-label" for="{{$tag->slug}}">{{$tag->name}}</label>
                    </div>
                    @endforeach
                    @error('tags')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <button type="submit" class="btn btn-success">Submit</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
            </form>
        </div>
    </div>

@endsection