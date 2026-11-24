<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$post->title}} </title>
</head>
<body>
    <h1>{{$post->title}} </h1>
    <p>{{$post->content}} </p>
    <small>{{$post->created_at}} </small>
    <br>
    
    <a href="{{ route('posts.edit', $post->id) }}">Editar</a><br>

    <form action="{{route('posts.destroy', $post->id)}}" method="post" 
        onsubmit="return confirm('¿Seguro que quieres eliminar esta nota?')">
        @csrf
        @method('DELETE')

        <button type="submit">Eliminar</button>
    </form>
    <hr>
    <a href="{{route('posts.index')}}">Volver a las notas</a>
</body>
</html>