<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
    <header class="header">
        <h1>PiGLy</h1>
    </header>

    <main class="main">
        @yield('content')
    </main>

    <footer class="footer">
        <p>&copy; 2025 体重管理アプリ</p>
    </footer>
</body>
</html>
