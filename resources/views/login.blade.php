<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Page</title>
</head>
<body>
    @if($message = Session::get('msg'))
        <strong>{{$message}}</strong>
    
    @endif
    <form action="{{route('autho')}}" method="POST">
    @csrf
        <label for="">Email</label>
        <input type="text" name="mail" value="{{old('mail')}}">
        @error ('mail') {{$message}}
        @enderror
        <label for="">Password</label>
        <input type="text" name="pwd" value="{{old('pwd')}}" >
        @error ('pwd') {{$message}}
        @enderror
        <input type="submit" value="Login">
        <a href="{{route('action.create')}}">Register</a>
    </form>
</body>
</html>