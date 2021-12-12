<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="author" content="Ruslan Khasanshin">
    <meta name="description" content=@yield('description')>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/bootstrap.css">

    @yield('styles')
</head>
<body>
    @yield('content')

    @yield('scripts')
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.bundle.js"></script>
</body>
</html>
