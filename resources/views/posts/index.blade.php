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

    @auth
        <p>Hola , {{ auth()->user()->name }} </p>
        <a href="{{route('posts.create')}}"> +Crear Nota</a>

        <form action="{{route('logout')}}" method="post" style="display:inline;">
            @csrf
            <button type="submit">Cerrar sesion</button>
        </form>
    @endauth

    @guest
        <a href="{{route('login')}}">Iniciar sesion</a>
        <a href="{{route('register')}}">Registrarse</a>
    @endguest

    
    @if (session('exito'))
        <p style="color: green">{{session('exito')}} </p>
    @endif

    @if (session('error'))
        <p style="color:red">{{session('error')}} </p>
    @endif

    @forelse ($posts as $post)
        <article>
            <h2>
                <a href="{{route('posts.show' , $post->id)}}">{{$post->title}} </a>
            </h2>
            <p>{{$post->content}} </p>
            <small>{{$post->created_at}} </small>
        </article>
    @empty
        <p>No hay notas todavias.</p>
    @endforelse
    
</body>
</html>