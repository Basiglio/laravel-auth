@extends('layouts.app')



@section('content')
    <div class="container">
        <h1 class="text-center">Modifica post</h1>
        {{-- GESTISCO GLI ERRORI --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="title" class="form-label">Titolo</label>
            <input id="title" name="title"  class="form-control" placeholder="Scrivi Titolo" value="{{ $post->title }}">
        </div>
        <div class="form-group">
            <label for="body" class="form-label">Testo</label>
            <textarea id="body" name="body"  class="form-control" rows="10">{{ $post->body }}</textarea>
        </div>
        <div class="form-group">
            <label for="img_path" class="form-label">Upload Immagine</label>
            <input type="file" id="img_path" name="img_path" accept="img/*">
        </div>

        <input type="submit" class="btn btn-primary" value="Modifica">
        </form>
        <a class="btn btn-warning" href="{{ route('admin.posts.index') }}">Indietro</a>
    </div>

@endsection
