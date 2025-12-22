@extends('layouts.manager')
@section('title')
Авторизация
@endsection
@section('content')
<div class="padding">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('auth.login') }}" method="post">
    @csrf
    <label>Email <input type="text" name="email" value="{{ old('email') }}"></label><br><br>
    <label>Пароль <input type="password" name="password"></label><br><br>
    <input type="submit" name="send" value="Войти">
</form>
</div>
@endsection