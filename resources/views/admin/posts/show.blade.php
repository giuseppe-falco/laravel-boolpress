@extends('layouts.app')

@section('content')
<style>
    h1:first-of-type{
        color:red;
    }

    img{
        width: 200px;
    }
</style>
<h1>Privato</h1>

<h2>titolo</h2>
<h1>{{$article->title}}</h1>
<img src="{{asset('storage/'.$article->image)}}" alt="">
<p>slug</p>
<p>{{$article->slug}}</p>
<h3>contentuto</h3>
<p>{{$article->content}}</p>

<h4>Tag</h4>
<ul>
    @foreach ($tags as $tag)
        <li>{{$tag->name}}</li>
    @endforeach
</ul>

@endsection