<!doctype html>
<html lang="ru">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta charset="utf-8">
        <meta name="description" content=@yield('description')>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="author" content="Ruslan Khasanshin">
        <title>User · @yield('title-block')</title>
        <link rel="shortcut icon" href="/img/mospolytech-logo-white.png" type="image/x-icon">
        <link rel="stylesheet" href="/css/bootstrap.css">
        <link rel="stylesheet" href="/css/user/user.css">
        @yield('styles')
    </head>
    <body>
        <header class="navbar sticky-top navbar-expand-md navbar-dark bg-dark p-0 shadow justify-content-between" aria-label="Fourth navbar example">
            <a class="navbar-brand col-md-3 col-lg-2 order-1 order-md-1 me-0 px-3" href="#">
                <img src="/img/mospolytech-logo-white.png" alt="logo" width="20" height="20" class="round"> Дневник
            </a>
            <button class="navbar-toggler order-0 order-md-0 ms-3" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="dropdown order-3 p-0 me-3">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="rounded-circle me-sm-2" src="{{ Auth::user()->img }}" alt="{{ Auth::user()->id }}" width="32" height="32">
                    <strong class="d-none d-sm-inline">{{ Auth::user()->name}}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser">
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changeAvatarModal">Аватар</a></li>
                    <li><a class="dropdown-item" href="{{ Auth::user()->user_type == 'Администратор' ? route('admin.settings') : route('user.settings')}}">Настройки</a></li>
                    <li><a class="dropdown-item" href="{{ route('user.main') }}">Профиль</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Выйти</a></li>
                </ul>
            </div>
        </header>

        <!-- Modal -->
        <div class="modal fade" id="changeAvatarModal" tabindex="-1" aria-labelledby="changeAvatarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Выбор аватара</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="m-2" method="post" action="{{ route('file-upload') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group border-bottom">
                                <label for="image" class="form-label">Выберите изображение</label>
                                <input class="form-control" id="image" type="file" name="image">
                            </div>
                            <br />
                            <button type="submit" class="btn btn-dark d-block w-75 mx-auto">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="sidebar-sticky pt-3" >
                        <ul class="nav flex-column">
                            @yield('li-blocks')
                            <li class="nav-item" id="exit-mobile-screen">
                                <a class="nav-link exit-link" href="{{ route('logout') }}">Выйти</a>
                            </li>

                        </ul>
                    </div>
                </nav>
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    @yield('content')
                </main>
            </div>
        </div>
        <script src="/js/jquery.js"></script>
        <script src="/js/bootstrap.bundle.js" ></script>
        @yield('scripts')
    </body>
</html>
