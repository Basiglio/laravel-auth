<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IL BLOGGONE</title>
</head>
<body>
    {{-- @dd($post) --}}
    <div class="container">
        <h1>è uscito un nuovo articolo!</h1>
        <img src="{{ asset('storage/'. $post->img_path) }}" alt="{{ $post->title }}">
        <a href="{{ route('showPagePublic', $post->slug) }}">{{ $post->title }}</a>
        <h2>IL BLOGGONE</h2>
        <h2><a href="{{ route('homePagePublic') }}">!! Clicca e leggi i nostri articoli !!</a></h2>
    </div>
</body>
</html>
