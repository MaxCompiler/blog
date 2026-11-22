<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$post->titulo}} </title>
</head>
<body>
    <h1>{{$post->titulo}} </h1>
    <p>{{$post->contenido}} </p>
    <small>{{$post->created_at}} </small>
    
    <a href="{{ route('posts.edit', $post->id) }}">Editar</a>
    <hr>
    <a href="{{route('posts.index')}}">Volver a las notas</a>
</body>
</html>