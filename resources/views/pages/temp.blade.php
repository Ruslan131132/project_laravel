<!doctype html>
<html lang="ru">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta charset="utf-8">
        <meta name="description" content='SETTINGS TEMP PAGE'>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="author" content="Ruslan Khasanshin">
        <title>Настройки</title>
        <link rel="shortcut icon" href="/img/mospolytech-logo-white.png" type="image/x-icon">
        <link rel="stylesheet" href="/css/bootstrap.css">
    </head>
    <body class="bg-light">
        <div class="text-muted vh-100 d-flex flex-column justify-content-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 text-center">
                        <span class="display-1 d-block">500</span>
                        <div class="mb-4 lead">Страница временно недоступна</div>
                        <a href="{{ URL::previous() }}" class="btn btn-link">Назад</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.bundle.js" ></script>
    </body>
</html>
