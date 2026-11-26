<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Iniciar Session</h1>
    @if (session('error'))
        <p style="color:red"> {{ session($message) }} </p>
    @endif

    <form action="{{route('login')}}" method="post">
        @csrf

        <div>
            <label for="email">Correo</label> <br>
            <input type="text" name="email" id="email" value="{{old('email')}}">
            @error('email')
                <p style="color:red"></p>
            @enderror
        </div>

        <div>
            <label for="password">Contraseña</label><br>
            <input type="password" name="password" id="password">
        </div>

        <div>
            <label><input type="checkbox" name="rememeber">Recordarme</label>
        </div>

        <button type="submit">Entrar</button>
    </form>

    <p>¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
</body>
</html>