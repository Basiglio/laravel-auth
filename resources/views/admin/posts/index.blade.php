@extends('layouts.app')

{{-- @dd($posts); --}}

@section('content')
    <div class="container">
        <h1>Tutti i miei post</h1>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Ih</th>
                    <th>Autore</th>
                    <th>Titolo</th>
                    <th>Data Pubblicazione</th>
                    <th style="width: 150px">Immagine</th>
                    <th>Modifica</th>
                    <th>Cancella</th>
                </tr>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->user_id }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->created_at->format('d-m-Y') }}</td>
                        @if (!empty($post->img_path))
                            <td>
                                <img class="img-fluid" src="{{ asset('storage/'. $post->img_path) }}" alt="{{ $post->title }}">
                            </td>
                        @else
                            <td>
                                <img class="img-fluid" src="{{ asset('images/placeholder_post.webp') }}" alt="{{ $post->title }}">
                            </td>
                        @endif
                        <td>
                            <a href="{{ route('admin.posts.edit', $post) }}"><i class="fas fa-pen-square"></i></a>
                        </td>
                        <td>
                             <form action="{{route('admin.posts.destroy', $post)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick='return confirm("Sei sicuro di voler cancellare l&apos;elemento?")' type="submit" class="btn btn-warning"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
