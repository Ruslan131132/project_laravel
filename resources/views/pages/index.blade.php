@extends('layouts.main-layout')

@section('description', 'Electronic Diary')

@section('title', 'Diary · Main')

@section('styles')
    <link rel="stylesheet" href="/css/main/main.css">
@endsection

@section('scripts', '')

@section('content')
    <nav class="navbar sticky-top navbar-expand-md fixed-top ">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">
            <img src="/img/mospolytech-logo-white.png" alt="logo" width="20" height="20" class="round"> Дневник
        </a>
        <button style="color: #999" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <svg width="24" height="24" viewBox="0 0 16 16" class="bi bi-caret-down-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3.544 6.295A.5.5 0 0 1 4 6h8a.5.5 0 0 1 .374.832l-4 4.5a.5.5 0 0 1-.748 0l-4-4.5a.5.5 0 0 1-.082-.537z"/>
                <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
            </svg>
        </button>
        <div class="collapse navbar-collapse justify-content-md-center" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link m-0 px-2">
                        <img src="/img/mospolytech-logo-white.png" alt="logo" width="20" height="20" class="round">
                    </a>
                </li>
                <li>
                    <a class="puple nav-link py-2" href="https://www.gosuslugi.ru/105551/2/info">Ученику</a>
                </li>
                <li class="nav-item active">
                    <a class="teacher nav-link" href="https://www.gosuslugi.ru/44300/2/info">Учителю</a>
                </li>
                <li class="nav-item active">
                    <a class="parent nav-link" href="https://www.gosuslugi.ru/help/news/2020_05_30_gosuslugi_family">Родителю</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="https://www.gosuslugi.ru/">Гос.Услуги</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " href="https://www.gosuslugi.ru/10999">Дет.сад</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="https://www.gosuslugi.ru/category">Дополнительно</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Компонент для демонстрации информации -->
    <div class="p-5 mb-3 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Дневник</h1>
            <p class="col-md-8 fs-4">Добро пожаловать - Здесь вы можете следить за успеваемостью.</p>
            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#ModalInfo">Подробнее &raquo;</button>

            <div id="ModalInfo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalPopoversLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalPopoversLabel">Информация</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>«Электронный дневник и журнал» — сервис,
                                позволяющий участникам учебного процесса получать информацию об учебных расписаниях,
                                текущих и итоговых оценках и домашних заданиях в режиме онлайн.
                            </p>
                        </div>
                        <div class="modal-footer">
                            <p>
                                Более подробно <a href="https://ru.wikipedia.org/wiki/%D0%AD%D0%BB%D0%B5%D0%BA%D1%82%D1%80%D0%BE%D0%BD%D0%BD%D1%8B%D0%B9_%D0%B4%D0%BD%D0%B5%D0%B2%D0%BD%D0%B8%D0%BA_%D0%B8_%D0%B6%D1%83%D1%80%D0%BD%D0%B0%D0%BB" class="tooltip-test" title="Ознакомление" data-container="#exampleModalPopovers">здесь</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br class="clearfix w-100 d-md-none pb-3">
    <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
        <div class="bg-light mr-md-3 py-3 px-3 py-md-5 px-md-3 text-center overflow-hidden">
            <div class="my-3 p-3">
                <h2 class="display-5">Вход</h2>
                <p class="lead">
                </p>
            </div>
            <div class="form-signin">
                @include('flash-message')
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-floating">
                        <input type="number" name="user_id"  id="user_id" class="form-control" placeholder="ID" required autofocus>
                        <label for="user_id">ID</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Пароль" required>
                        <label for="password">Пароль</label>
                    </div>
                    @if ($message = Session::get('error_auth'))
                        <div class="text-danger my-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="#dc3545" class="bi bi-exclamation-triangle" viewBox="0 1 16 16">
                                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                            </svg>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" name="remember_token" value="1"> Запомнить меня
                        </label>
                    </div>
                    <button class="btn btn-lg btn-success btn-block" type="submit">Войти</button>
                </form>
            </div>
        </div>
    </div>
    <br class="clearfix w-100 d-md-none pb-3">
    <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
        <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
            <div class="my-3 p-3">
                <h2 class="display-5">Популярные электронные услуги</h2>
                <p class="lead">У вас есть возможность</p>
            </div>
            <div id="mobile_style" class="bg-dark shadow-sm mx-auto">
                <div class="row" style=" text-align: left; margin: 5%; ">
                    <p class="link_list" >
                        <a class="links" href="https://www.gosuslugi.ru/group/school_enrollment">
                            <svg width="15" height="15" viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="8" cy="8" r="8"/>
                            </svg> Записаться в школу
                        </a>
                        <br/>
                        <a class="links" href="https://www.gosuslugi.ru/group/kindergarten_enrollment">
                            <svg width="15" height="15" viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="8" cy="8" r="8"/>
                            </svg> Записаться в детский сад
                        </a>
                        <br/>
                        <a class="links" href="https://www.mos.ru/pgu/ru/application/dogm/077060701/#step_1">
                            <svg width="15" height="15" viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="8" cy="8" r="8"/>
                            </svg> Записаться в кружок или секцию
                        </a>
                        <br/>
                        <font size="2" style="color: #d7d7d7">
                            <a class="links" href="https://www.gosuslugi.ru/">
                                <u>Больше услуг на www.gosuslugi.ru</u>
                            </a>
                        </font>
                    </p>
                </div>
            </div>
        </div>
        <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
            <div class="my-3 p-3">
                <h2 class="display-5">Олимпиада по математике</h2>
                <p class="lead">Главные призы - новые iPhone, iPad и PS5 </p>
            </div>
            <div class="bg-light shadow-sm mx-auto" style="width: 80%; height:80%; border-radius: 21px 21px 0 0;"><img id="prize_img" src="/img/Prize.png" alt="Здесь должен быть школьник" >
            </div>

        </div>
    </div>

    <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
        <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
            <div class="my-3 py-3">
                <h2 class="display-5">Внимание!</h2>
                <p class="lead">Если у вас нет логина и пароля - Обратитесь к преподавателю</p>
            </div>
            <div class="bg-white shadow-sm mx-auto" style="width: 80%; height: 80%; border-radius: 21px 21px 0 0;"><img src="/img/book.png" alt="Здесь должен быть школьник" style="width: 75%; height: 75%";></div>
        </div>
        <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
            <div class="my-3 p-3">
                <h2 class="display-5">Школьные сервисы</h2>
                <p class="lead">Просматривайте</p>
            </div>
            <div id="mobile_style" class="bg-dark shadow-sm mx-auto">
                <div class="row" style=" text-align: left; margin: 5%; ">
                    <p class="link_list" >
                        <a class="links" href="https://edu.tatar.ru/uslugi_app/parents/index.html">
                            <svg width="15" height="15" viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg" >
                                <circle cx="8" cy="8" r="8"/>
                            </svg> Оценки и домашние задания
                        </a>
                        <br/>
                        <a class="links" href="https://edu.tatar.ru/uslugi_app/parents/index.html">
                            <svg width="15" height="15" viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="8" cy="8" r="8"/>
                            </svg> Уведомления от учителей и администрации
                        </a>
                        <br/>
                        <a class="links" href="https://edu.tatar.ru/uslugi_app/parents/index.html">
                            <svg width="15" height="15" viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="8" cy="8" r="8"/>
                            </svg> Баланс и пополнение школьной карты
                        </a>
                        <br/>
                        <font size="2" style="color: #d7d7d7">
                            <a class="links" href="https://edu.tatar.ru/uslugi_app/parents/index.html"><u>Узнайте как подключиться</u></a>
                        </font>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <footer class="container py-5">
        <div class="row">
            <div class="col-12 col-md">
                <img src="/img/LogoMospolytech.jpg" alt="logo" width="24" height="24" class="round">
                <small class="d-block mb-3 text-muted">&copy; 2020 · Project · Ruslan</small>
                <p>
                    <a href="https://www.facebook.com/dnevnik.ru"> <img src="/img/social-links/facebook.png" width="26" height="26"></a>
                    <a href="http://twitter.com/dnevnik_ru"> <img src="/img/social-links/twitter.png" width="26" height="26"></a>
                    <a href="http://vkontakte.ru/club19853844"> <img src="/img/social-links/vkontakte.png" width="26" height="26"></a>
                    <a href="http://www.odnoklassniki.ru/dnevnik.ru"> <img src="/img/social-links/odnoklassniki.png" width="26" height="26"></a>
                    <a href="https://www.youtube.com/user/DnevnikVideoRussia"> <img src="/img/social-links/youtube.png" width="26" height="26"></a>
                </p>
            </div>
            <div class="col-6 col-md">
                <h5>О компании</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">О нас</a></li>
                    <li><a class="text-muted" href="#">Руководство</a></li>
                    <li><a class="text-muted" href="#">Новости</a></li>
                    <li><a class="text-muted" href="#">Контакты</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Возможности</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Преподавателям</a></li>
                    <li><a class="text-muted" href="#">Родителям</a></li>
                    <li><a class="text-muted" href="#">Учащимся</a></li>
                    <li><a class="text-muted" href="#">Госорганам</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Партнерам</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Реклама</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Поддержка</h5>
                <ul class="list-unstyled text-small">
                    <li><a href="#">Портал</a></li>
                    <li><a href="#">Подключить ОО</a></li>
                </ul>
            </div>
        </div>
    </footer>
@endsection
