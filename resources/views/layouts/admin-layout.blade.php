<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content=@yield('description')>
    <meta name="author" content="Ruslan Khasanshin">
    <title>Admin · @yield('title-block')</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/admin/admin.css">
</head>
<header>
    <nav class="navbar sticky-top navbar-expand-md fixed-top ">
        <a class="navbar-brand" href="#"><img src="/img/mospolytech-logo-white.png" alt="logo" width="20" height="20" class="round"></a>
        <button style="color: #999" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <svg width="24" height="24" viewBox="0 0 16 16" class="bi bi-caret-down-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3.544 6.295A.5.5 0 0 1 4 6h8a.5.5 0 0 1 .374.832l-4 4.5a.5.5 0 0 1-.748 0l-4-4.5a.5.5 0 0 1-.082-.537z"/>
                <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
            </svg>
        </button>
        <div class="collapse navbar-collapse justify-content-md-center" id="navbarCollapse">
            <ul class="navbar-nav">
                @yield('li-blocks')
            </ul>
        </div>
        <form class="form-inline my-2 my-md-0">
            <a class="btn btn-danger btn-block"  href="/" style="color:#ffffff">Выйти</a>
        </form>
    </nav>
</header>
<body>
    @if(Session::has('flash_message'))
        <div class="alert alert-info {{ Session::has('flash_message_important') ? 'alert-important' : '' }} text-center">
            @if(Session::has('flash_message_important'))
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            @endif
            {{ session('flash_message') }}
        </div>
    @endif

    @yield('content')

    <script>
        $('div.alert').not('.alert-important').delay(3000).slideUp(300);
    </script>
    @yield('scripts')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="/js/bootstrap.js" ></script>
</body>
</html>
