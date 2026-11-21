<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mis notas</title>
</head>
<body>
    <h1>Mis Notas</h1>

    <a href="{{route('posts.create')}}"> +Crear Nota</a>
    @if (session('exito'))
        <p style="color: green">{{session('exito')}} </p>
    @endif

    @forelse ($posts as $post)
        <article>
            <h2>
                <a href="{{route('posts.show' , $post->id)}}">{{$post->titulo}} </a>
            </h2>
            <p>{{$post->contenido}} </p>
            <small>{{$post->created_at}} </small>
        </article>
    @empty
        <p>No hay notas todavias.</p>
    @endforelse
    
</body>
</html>