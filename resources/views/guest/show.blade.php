@extends('layouts.app')
@section('css_custom')
<link rel="stylesheet" href="{{ asset('css/guest/welcome.css') }}">
@endsection


@section('content')
    <div class="container container_show">
        <h1>{{ $post->title }}</h1>
        <img src="{{ asset('storage/'. $post->img_path) }}" alt="">
        <p>{{ $post->body }}</p>
    </div>
@endsection
