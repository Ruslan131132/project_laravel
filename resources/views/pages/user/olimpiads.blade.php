@extends('layouts.user-layout')

@section('description', 'User olimpiads page')

@section('title-block', 'Olimpiads')

@section('styles')
    <link rel="stylesheet" href="/css/user/user-olimpiads.css">
@endsection

@section('li-blocks')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">
            <span data-feather="user"></span>
            Главная <span class="sr-only"></span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('shedule') }}">
            <span data-feather="shedule"></span>
            Расписание
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('marks') }}">
            <span data-feather="marks"></span>
            Оценки
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('courses') }}">
            <span data-feather="courses"></span>
            Записаться на курс
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('olimpiads') }}">
            <span data-feather="users"></span>
            Олимпиады
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('ege') }}">
            <span data-feather="layers"></span>
            ЕГЭ
        </a>
    </li>
@endsection

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" link="#000000">
        <div class="jumbotron" style="background: #f3f3f3; margin-top: 2rem;">
            <div class="container" >
                <h1 class="display-3">Задания олимпиад</h1>
                <p>Тренируйтесь на материалах прошедших соревнований и побеждайте!</p>
                <p><a class="btn btn-primary btn-lg" href="https://olimpiada.ru/articles/tasks_in_olympiads" role="button">Подробнее &raquo;</a></p>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8" style="background: #fff0c7; border-right: 3px solid #ffffff; border-bottom: 3px solid #ffffff; ">
                    <h2>Всероссийская олимпиада школьников<p style="color: red">Идет муниципальный этап</p></h2>
                    <div class="container">
                        <div class="row" name="noborder">
                            <div class="col">
                                <p><a  href="https://olimpiada.ru/activity/43" style="color: black; font-size: 150%">Интеллектуальный чемпионат России для всех желающих. Проводится по 24 предметам в четыре этапа для 4-11 классов</a></p>
                            </div>
                            <div class="col">
                                <img src="/img/olimp1.png" height="100%" width="100%" id="img1">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" style="background: #f3f3f3; border-left: 3px solid #ffffff; border-bottom: 3px solid #ffffff;">
                    <h2 style="color: #072bf9"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bell" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2z"/><path fill-rule="evenodd" d="M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/></svg>Новости</h2>
                    <p>
                        <a class="black none_a" href="https://olimpiada.ru/news/19466" style="color: black"><font style="color: #072bf9">
                                30 ноября </font>Предварительные результаты отборочного этапа олимпиады «Высшая проба»</a>
                    </p>
                    <br />
                    <p><a class="black none_a" href="https://olimpiada.ru/news/19464" style="color: black"><font style="color: #072bf9">
                                30 ноября </font>Даты проведения и регистрация на отборочный этап Московской традиционной олимпиады по лингвистике</a>
                    </p>
                    <br />
                    <p>
                        <a class="black none_a" href="https://olimpiada.ru/news/19466" style="color: black"><font style="color: #072bf9">
                                30 ноября	</font>
                            Предварительные результаты отборочного этапа олимпиады «Высшая проба»</a>
                    </p>
                    <br />
                    <p>
                        <a class="black none_a" href="https://olimpiada.ru/news/19459" style="color: black"><font style="color: #072bf9">
                                30 ноября	</font>Задания и решения II тура и результаты I тура дистанционного этапа олимпиады им. Л. Эйлера</a>
                    </p>
                    <br />
                    <br />
                    <p><a class="black none_a" href="https://olimpiada.ru/news" style="color: black"><font style="color: #072bf9">
                                Еще 11 новостей вчера →	</font></a></p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4" style="background: #f3f3f3; border-right: 3px solid #ffffff; border-top: 3px solid #ffffff; border-bottom: 3px solid #ffffff;">
                    <h6><br/><font style="color: #072bf9">Интервью</font></h6>
                    <p>
                        <a  href="https://olimpiada.ru/activity/43" style="color: black; font-size: 200%">«Время, назад!»: как проходила Московская математическая олимпиада в 1950-60-х →</a>
                    </p>
                </div>
                <div class="col-md-4" style="background: #f3f3f3; border-left: 3px solid #ffffff; border-right: 3px solid #ffffff; border-top: 3px solid #ffffff; border-bottom: 3px solid #ffffff;">
                    <h6><br/><font style="color: #072bf9">Интервью</font></h6>
                    <p>
                        <a  href="https://olimpiada.ru/article/951" style="color: black; font-size: 200%">«Задача «Математических этюдов» – помочь полюбить математику»: интервью с автором проекта Николаем Андреевым →</a>
                    </p>
                </div>
                <div class="col-md-4" style="background: #fff0c7; border-left: 3px solid #ffffff; border-top: 3px solid #ffffff; border-bottom: 3px solid #ffffff;">
                    <a  href="https://olimpiada.ru/activity/23" style="color: black;">
                        <h6><br/><font style="color: #072bf9">Олимпиада</font></h6>
                        <p>
                            <big><big><big>Открытая олимпиада по программированию</big></big></big><br>
                            <font style="color: red;">Длинный отборочный тур проходит до 20 января</font>
                        </p>

                        <p>Олимпиада для школьников, увлекающихся программированием. По сложности задач соревнование не уступает Всероссийской олимпиаде по информатике</p>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4" style="background: #fff0c7; border-right: 3px solid #ffffff; border-top: 3px solid #ffffff;">
                    <a  href="https://olimpiada.ru/activity/135" style="color: black;">
                        <h6><br/>Олимпиада</h6>
                        <p style="font-size: 200%">Международная физическая олимпиада
                            <font style="color: red;">Пройдет онлайн с 7 по 15 декабря в Москве</font></p>

                        <p>Соревнование для школьников из разных стран мира. Участники выполняют задания в лаборатории и решают теоретические задачи</p>
                    </a>
                </div>
                <div class="col-md-4" style="background: #f3f3f3; border-left: 3px solid #ffffff; border-right: 3px solid #ffffff; border-top: 3px solid #ffffff;">
                    <h6><br/><font style="color: #072bf9">Интервью</font></h6>
                    <p>
                        <a  href="https://olimpiada.ru/article/949" style="color: black; font-size: 200%">«Сегодня траекторий попадания в астрономию много»: как стать астрофизиком без обсерватории и телескопа на балконе→</a>
                    </p>
                </div>
                <div class="col-md-4" style="background-color: rgb(158, 80, 72); background-image: url(../img/olimp2.png); border-left: 3px solid #ffffff; border-top: 3px solid #ffffff;">
                    <a  href="https://olimpiada.ru/activities?type=any&class=any&period_date=&period=year&dogm=on" style="color: white;">
                        <p style="font-size: 1000%;text-align: center; font-family: 'Bonvalet'">71</p>
                        <p>олимпиада Департамента образования и науки города Москвы</p>
                    </a>
                </div>

                <div class="row" >
                    <div class="col" style="text-align: center;">
                        <p style="text-align: center;">
                            <img style=" width: 80%; margin-top: 20px;" src="/img/olimp3.png" alt="Всероссийская олимпиада школьников в Москве" align="center" >
                        </p>
                        <p>
                            <a  href="https://vos.olimpiada.ru/" >Главная олимпиада страны →</a>
                        </p>
                    </div>
                </div>
                <hr>
                <br />
                <br />
            </div>
        </div><!-- /container -->
    </main>
@endsection
