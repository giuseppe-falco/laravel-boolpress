@extends('layouts.app')

@section('content')
<table class="table">
    <thead>
      <tr>
        <th scope="col">Titolo</th>
        <th scope="col">Slug</th>
        <th scope="col">Azioni</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
        <tr>
            <td>{{$article->title}}</td>
            <td>{{$article->slug}}</td>
            <td>
                <a href="{{route('admin.posts.show', $article->slug)}}">View</a>
                {{-- <a href="{{route('posts.delete')}}">Delete</a> --}}
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>    
@endsection