@extends('layouts.app')

@section('content')
<div>
  <button>
    <a href="{{route('admin.posts.create')}}">Crea un nuovo post</a>
  </button>
</div>
<table class="table">
    <thead>
      <tr>
        <th scope="col">Titolo</th>
        <th scope="col">Slug</th>
        <th scope="col">Content</th>
        <th scope="col">Azioni</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($articles as $article)
        <tr>
            <td>{{$article->title}}</td>
            <td>{{$article->slug}}</td>
            <td>{{$article->content}}</td>
            <td>
              <a href="{{route('admin.posts.show', $article->slug)}}">View</a>
              <a href="{{route('admin.posts.edit', $article->slug)}}">Edit</a>

              <form action="{{route("admin.posts.destroy", $article->slug)}}" method="POST">
                @csrf
                @method("DELETE")
                
                <input type="submit" value="Elimina">
            </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>    
@endsection