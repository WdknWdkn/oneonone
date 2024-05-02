<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Application Name - @yield('title')</title>
</head>
<body class="bg-gray-100">
    <header class="bg-blue-500 text-white p-4 shadow">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-lg font-bold">One On One</h1>
            <nav>
                <!-- ナビゲーションリンクをここに挿入 -->
                <a href="/interviews/" class="text-white hover:text-blue-300 px-3 py-2 rounded">Home</a>
                <!-- 他のナビゲーションリンクを追加 -->
            </nav>
        </div>
    </header>
    
    <div class="container mx-auto mt-8 p-4">
        @yield('content')
    </div>
    
    <footer class="bg-gray-800 text-white text-center p-4 mt-8">
        <div class="max-w-7xl mx-auto">
            &copy; 2024 Kentaro Wada. All rights reserved.
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
