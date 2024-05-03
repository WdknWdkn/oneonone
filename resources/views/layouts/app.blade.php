<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Application Name - @yield('title')</title>
</head>
<body>
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="shrink-0 flex items-center">
                            <div class="text-lg font-bold">One On One</div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="">
            @yield('content')
        </div>
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
