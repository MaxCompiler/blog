<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear un nuevo post</title>
</head>
<body>
    <h1>Nueva Nota</h1>
    <form action="{{route('posts.store')}}" method="POST">
        @csrf
        <div>
            <label for="titulo">Titulo: </label>
            <input type="text" id="titulo" name="titulo" value="{{old('titulo')}}">
            @error('titulo')
                <p style="color:red">{{$message}} </p>
            @enderror
        </div>

        <div>
            <label for="contenido">Contenido: </label><br>
            <textarea name="contenido" id="contenido" rows="6">{{old('contenido')}} </textarea>
            @error('contenido')
                <p style="color: red">{{$message}} </p>
            @enderror
        </div>

        <button type="submit">Guardar</button>
    </form>

    <hr>
    <a href="{{route('posts.index')}}"><-volver </a>
</body>
</html>