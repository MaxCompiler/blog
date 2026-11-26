<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
</head>
<body>
    <h1>Crear Cuenta</h1>

    <form action="{{route('register')}}" method="POST">
        @csrf

        <div>
            <label for="name">Nombres</label><br>
            <input type="text" id="name" name="name" value="{{old('name')}}">
            @error('name')
                <p style="color: red">{{$message}} </p>
            @enderror
        </div>

        <div>
            <label for="email">Correo</label><br>
            <input type="email" name="email" id="email" value="{{old('email')}}">
            @error('email')
                <p style="color: red"> {{$message}} </p>
            @enderror
        </div>

        <div>
            <label for="password">Contraseña</label><br>
            <input type="password" name="password" id="password">
            @error('password')
                <p style="color:red"> {{$message}} </p>
            @enderror
        </div>

        <div>
            <label for="confirmacion_contraseña">Repetir Contraseña</label>
            <input type="password" name="confirmacion_contraseña" id="confirmacion_contraseña">
        </div>

        <button type="submit">Registrame</button>
    </form>

    <p>¿Ya tienes cuenta? <a href="{{route('login')}}">Inicia sesión</a></p>
</body>
</html>