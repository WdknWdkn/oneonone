<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Application Name - @yield('title')</title>
</head>
<body>
    <header>
        <!-- ヘッダーの内容 -->
    </header>
    
    <div class="container">
        @yield('content')
    </div>
    
    <footer>
        <!-- フッターの内容 -->
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
