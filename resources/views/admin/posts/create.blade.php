@extends('layouts.admin')

@section('content')

    <div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <h1 class="text-center">CREATE POST</h1>
    <div class="row bg-white">
        <div class="col-12">

            <form action="{{route('admin.posts.store')}}" enctype="multipart/form-data" method="POST" class="p-4">
                @csrf
                  <div class="mb-3">
                    <label for="title" class="form-label">Titolo</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required maxlength="150" minlength="3">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">* Minimo 3 caratteri massimo 150 caratteri</div>
                 </div>
                  <div class="mb-3">
                    <label for="content" class="form-label">Contenuto</label>
                    <textarea class="form-control" id="content" name="content"></textarea>
                  </div>
                  
                  <div class="mb-3">
                    <label for="category_id" class="form-label">Seleziona categoria di framework:</label>
                    <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror"> 
                      <option value="">Framework</option>
                      @foreach ($categories as $category)
                          <option value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="mb-3">
                    <label for="link_git" class="form-label">Link Github:</label>
                    <input type="text" class="form-control" id="link_git" name="link_git" required>
                  </div>

                  <div class="mb-3">
                    <label for="lvl_diff" class="form-label">Livello</label>
                   <select name="lvl_diff" id="lvl_diff" aria-describedby="levelHelp" required>
                    @for($ix=1; $ix <= $lvl_diff_max; $ix++)
                      <option value="{{$ix}}">{{$ix}}</option>
                    @endfor
                   </select>
                   <div id="levelHelp" class="form-text">Scala di diffcoltà da 1(facile) a {{$lvl_diff_max}}(molto difficile)</div>
                  </div>

                  <div class="mb-3">
                    <img id="uploadPreview" width="100" src="https://via.placeholder.com/300x200">
                    <label for="cover_image" class="form-label">Immagine</label>
                    <input type="file" name="cover_image" id="cover_image" class="form-control  @error('cover_image') is-invalid @enderror" >
                    @error('cover_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  {{-- <div class="mb-3">
                    <label for="tags" class="form-label">Tags</label>
                    <select multiple class="form-select" name="tags[]" id="tags" >
                      <option value="">Select tag</option>
                      @forelse ($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                      @empty
                        <option value="">No tag</option>
                      @endforelse
                    </select>
                  </div>  --}}

                  <div class="mb-3">
                    <label for="tags" class="form-label">Tags</label>
                    <select multiple class="form-select" name="tags[]" id="tags">
                        @forelse ($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                        @empty
                            <option value="">No tag</option>
                        @endforelse

                    </select>

                  </div>

                  <button type="submit" class="btn btn-success">Submit</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
            </form>
            
        </div>
    </div>
    <script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">
      bkLib.onDomLoaded(nicEditors.allTextAreas);
    </script>
@endsection