<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <header>
    <div><a><a href="/">HOME</a></div>
        @if (Auth::check())
            <div>
                <span><a href="{{ route('user.index', ['user_id' => Auth::user()->id]) }}">{{ Auth::user()->name }}でログイン中</a></span>
                <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
            </div>
        @else
        <div>
            <span><a href="{{ route('login') }}">ログイン</a></span>
            <span></span><span><a href="{{ route('register') }}">会員登録</a></span><span></span></div>
        @endif
    </header>
    @yield('content')
    @if(Auth::check())
        <script>
        document.getElementById('logout').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        });
        </script>
    @endif
</body>
</html>
