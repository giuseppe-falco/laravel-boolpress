@extends('layouts.app')

@section('content')
    <h1>{{$article->title}}</h1>
    <p>{{$article->slug}}</p>
@endsection