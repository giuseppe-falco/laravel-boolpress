@extends('layouts.app')


@section('content')

    <div class="container">
        <h1>crea nuovo post</h1>
        <form action="{{route('admin.posts.store')}}" enctype="multipart/form-data" method="POST" enctype="multipart/form-data">

            @csrf
            @method("POST")
        
            <div class="form-group">
              <label for="title">Titolo</label>
              <input type="text" class="form-control" name="title" id="title" placeholder="Inserisci il titolo del post">
            </div>

            <div class="form-group">
              <label for="slug">Slug</label>
              <input type="text" class="form-control" name="slug" id="slug" placeholder="Inserisci lo slug">
            </div>

            <div class="form-group">
                <label for="slug">Image</label>
                <input type="file" class="form-control" name="image" id="image" placeholder="Inserisci immagine" accept="image/x-png, image/gif, image/jpeg">
            </div>

            <div class="form-group">
              <label for="content">Contenuto</label>
              <textarea class="form-control" name="content" id="content" placeholder="Inserisci il contenuto del post"></textarea>
            </div>


            @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
            @endif

            <div class="tags">
                <h2>Scegli dei tag</h2>
                <div class="form-check">
                    @foreach($tags as $tag)
                        <span>
                        <input id="tag-{{$tag->id}}" name="tags[]" value="{{$tag->id}}" type="checkbox">
                        <label for="tag-{{$tag->id}}">{{$tag->name}}</label>
                        </span>
                    @endforeach
                </div>
            </div>
        
            <button type="submit" class="btn btn-primary btn-success">Crea</button>

            <a href={{route("admin.posts.index")}} class="btn btn-primary"><i class="fas fa-long-arrow-alt-left"></i> Indietro</a>
            
        </form>
    </div>
    
@endsection