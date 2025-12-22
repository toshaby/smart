<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/manager.css', 'resources/js/manager.js'])
</head>
<body>
    <div class="head">
        <h1>@yield('title')</h1>
    </div>
    <div class="main">
        <div class="main_left">
            @auth
                <span>{{ auth()->user()->name }}</span><br>
                @if (auth()->user()->hasRole('manager'))
                <a href="{{ route('manager.tickets.index') }}">Тикеты</a>
                @endif
                <form action="{{ route('auth.logout') }}" method="post">
                    @csrf
                    <input type="submit" value="Выйти">
                </form>
            @endauth
            @guest
                <a href="{{ route('auth.form') }}">Войти</a>
            @endguest
        </div>
        <div class="main_content">
            @yield('content')
        </div>
        <div class="main_right">
            
        </div>
    </div>
    <div class="footer">
        <h2>Низ</h2>
    </div>
</body>
</html>