<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content=@yield('description')>
    <meta name="author" content="Ruslan Khasanshin">
    <title>User · @yield('title-block')</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/user/user.css">
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">
            <img src="/img/mospolytech-logo-white.png" alt="logo" width="20" height="20" class="round"> Дневник
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav px-3" id="button_big_screen">
            <li class="nav-item text-nowrap">
                <a class="btn btn-danger"  href="{{ route('main') }}">Выйти</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="sidebar-sticky pt-3" >
                    <ul class="nav flex-column">
                        @yield('li-blocks')
                    </ul>
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Полезные ссылки</span>
                        <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item active">
                            <a class="links_main nav-link py-2" href="https://www.gosuslugi.ru/105551/2/info">Ученику</a>
                        </li>
                        <li class="nav-item active">
                            <a class="links_main nav-link " href="https://www.gosuslugi.ru/44300/2/info">Учителю</a>
                        </li>
                        <li class="nav-item active">
                            <a class="links_main nav-link" href="https://www.gosuslugi.ru/help/news/2020_05_30_gosuslugi_family">Родителю</a>
                        </li>
                        <li class="nav-item active">
                            <a class="links_main nav-link" href="https://www.gosuslugi.ru/">Гос.Услуги</a>
                        </li>
                        <li class="nav-item active">
                            <a class="links_main nav-link " href="https://www.gosuslugi.ru/10999">Дет.сад</a>
                        </li>
                        <li class="nav-item active">
                            <a class="links_main nav-link" href="https://www.gosuslugi.ru/category">Дополнительно</a>
                        </li>
                        <li class="nav-item " id="button_little_screen" >
                            <a class="btn btn-danger"  href="{{ route('main') }}">Выйти</a>
                        </li>
                    </ul>
                </div>
            </nav>
            @yield('content')
        </div>
    </div>
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.bundle.js" ></script>
    <script src="/js/bootstrap.js" ></script>
    @yield('scripts')
</body>
</html>
