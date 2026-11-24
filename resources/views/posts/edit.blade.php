<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar nota</title>
</head>
<body>
    <h1>Editar nota</h1>

    <form action="{{route('posts.update',$post->id)}}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="titulo">Titulo</label>
            <input type="text" id="titulo" name="title" value="{{old('title', $post->titulo)}}">
            @error('titulo')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="contenido">Contenido</label><br>
            <textarea name="content" id="contenido" rows="6">{{old('content', $post->contenido)}} </textarea>
        </div>

        <button type="submit" >Actualizar</button>
    </form>
    
    <a href="{{route('posts.show', $post->id)}}"> <- Cancelar</a>
</body>
</html>