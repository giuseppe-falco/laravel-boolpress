@extends('layouts.app')

@section('content')
    <h1>PUBBLICO</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Titolo</th>
                <th scope="col">Slug</th>
                <th scope="col">Content</th>
                <th scope="col">Azioni</th>
                <th scope="col">Autore</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
            <tr>
                <td>{{$article->title}}</td>
                <td>{{$article->slug}}</td>
                <td>{{$article->content}}</td>
                <td>
                    <a href="{{route('posts.show', $article->slug)}}">View</a>
                    {{-- <a href="{{route('posts.delete')}}">Delete</a> --}}
                </td>
                <td>{{$article->user->name}}</td>
            </tr>
            @endforeach
        </tbody>
  </table>    
@endsection