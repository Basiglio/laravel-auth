@extends('layouts.app')
@section('css_custom')
<link rel="stylesheet" href="{{ asset('css/guest/welcome.css') }}">
@endsection
@section('content')
            <div class="container">
                <h1>IL BLOGGONE </h1>
                <h4>Benvenuto:
                    <span>
                        @if (Auth::user() == true)
                            {{ Auth::user()->name }}
                        @else
                            Ospite
                            <br> <h6>registrati per avere accesso a contenuti esclusivi</h6>
                        @endif
                    </span>
                </h4>

                <div class="card_container">
                    @foreach ($posts as $post)
                            <div class="cards">
                                <div class="img_container">
                                    @if (!empty($post->img_path))
                                        <img src="{{ asset('storage/'. $post->img_path) }}" alt="{{ $post->title }}">
                                    @else
                                        <img src="{{ asset('images/placeholder_post.webp') }}" alt="{{ $post->title }}">
                                    @endif
                                </div>
                                <div class="card_text">
                                    <a href="{{ route('showPagePublic', $post->slug) }}">{{ $post->title }}</a>
                                    <h4>{{ $post->user->name }}</h4>
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection
