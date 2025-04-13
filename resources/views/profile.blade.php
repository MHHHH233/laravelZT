<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER | PROFILE</title>
</head>
<body>
    <h1>PROFILE USER</h1>
    @if(Session('l')== null)
        <script>
            window.location.assign('action');
        </script>
    @else
        Bienvenue <p>{{ Session('l') }}</p> vous etes {{ Session('t') }}
        <br>
        <a href="{{route('logout') }}">Logout</a>
    @endif
    
</body>
</html>