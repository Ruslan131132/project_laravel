@extends('layouts.user-layout')

@section('description', 'User olimpiads page')

@section('title-block', 'Olimpiads')

@section('styles')
    <link rel="stylesheet" href="/css/user/user-olimpiads.css">
@endsection

@section('li-blocks')
    @include('layouts.li', ['value' => 'Главная', 'status' => '', 'icon' => '/svg/home.svg', 'route' => 'user.main'])
    @include('layouts.li', ['value' => 'Расписание', 'status' => '', 'icon' => '/svg/schedule.svg', 'route' => 'user.schedule'])
    @include('layouts.li', ['value' => 'Оценки', 'status' => '', 'icon' => '/svg/marks.svg', 'route' => 'user.marks'])
    @include('layouts.li', ['value' => 'Курсы', 'status' => '', 'icon' => '/svg/class.svg', 'route' => 'user.courses'])
    @include('layouts.li', ['value' => 'Олимпиады', 'status' => 'active', 'icon' => '/svg/globe.svg', 'route' => 'user.olimps'])
    @include('layouts.li', ['value' => 'Экзамены', 'status' => '', 'icon' => '/svg/exam.svg', 'route' => 'user.exams'])
@endsection

@section('content')
    <div class="row">
        <div class="p-5 my-3 bg-light rounded-3 mt-1">
            <div class="container" >
                <h1 class="display-3">Задания олимпиад</h1>
                <p>Тренируйтесь на материалах прошедших соревнований и побеждайте!</p>
                <p><a class="btn btn-primary btn-lg" href="https://olimpiada.ru/articles/tasks_in_olympiads" role="button">Подробнее &raquo;</a></p>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 main-new">
                    <h2>Всероссийская олимпиада школьников
                        <p>Идет муниципальный этап</p>
                    </h2>
                    <div class="container">
                        <div class="row" name="noborder">
                            <div class="col-12 col-lg-8">
                                <p><a  href="https://olimpiada.ru/activity/43">Интеллектуальный чемпионат России для всех желающих. Проводится по 24 предметам в четыре этапа для 4-11 классов</a></p>
                            </div>
                            <div class="col-12 col-lg-4">
                                <img class="d-none d-sm-block mt-sm-0 mt-md-5 mt-lg-0" src="/img/olimp1.png" id="img1">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 news-list">
                    <h2>
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bell" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2z"/>
                            <path fill-rule="evenodd" d="M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                        </svg>Новости
                    </h2>
                    <p>
                        <a href="https://olimpiada.ru/news/19466"><span>30 ноября </span>
                            Предварительные результаты отборочного этапа олимпиады «Высшая проба»
                        </a>
                    </p>
                    <p>
                        <a href="https://olimpiada.ru/news/19464"><span>30 ноября</span>
                            Даты проведения и регистрация на отборочный этап Московской традиционной олимпиады по лингвистике
                        </a>
                    </p>
                    <p>
                        <a href="https://olimpiada.ru/news/19466"><span>30 ноября</span>
                            Предварительные результаты отборочного этапа олимпиады «Высшая проба»
                        </a>
                    </p>
                    <p>
                        <a class="black none_a" href="https://olimpiada.ru/news/19459" ><span>30 ноября</span>
                            Задания и решения II тура и результаты I тура дистанционного этапа олимпиады им. Л. Эйлера</a>
                    </p>
                    <br />
                    <p class="mb-3">
                        <a href="https://olimpiada.ru/news"><span>Еще 11 новостей вчера →	</span>
                        </a>
                    </p>
                </div>
            </div>

            <div class="row center-info">
                <div class="col-md-6 col-lg-4">
                    <h6>Интервью</h6>
                    <p>
                        <a href="https://olimpiada.ru/activity/43" class="fs-3">«Время, назад!»: как проходила Московская математическая олимпиада в 1950-60-х →</a>
                    </p>
                </div>
                <div class="col-md-6 col-lg-4">
                    <h6>Интервью</h6>
                    <p>
                        <a href="https://olimpiada.ru/article/951" class="fs-3">«Задача «Математических этюдов» – помочь полюбить математику»: интервью с автором проекта Николаем Андреевым →</a>
                    </p>
                </div>
                <div class="col-md-12 col-lg-4">
                    <a  href="https://olimpiada.ru/activity/23">
                        <h6>Олимпиада</h6>
                        <p>
                        <p class="fs-3">Открытая олимпиада по программированию</p>
                            <span class="text-danger">Длинный отборочный тур проходит до 20 января</span>
                        </p>
                        <p>Олимпиада для школьников, увлекающихся программированием. По сложности задач соревнование не уступает Всероссийской олимпиаде по информатике</p>
                    </a>
                </div>
            </div>
            <div class="row bottom-info">
                <div class="col-md-12 col-lg-4">
                    <a href="https://olimpiada.ru/activity/135">
                        <h6 class="text-black">
                            Олимпиада
                        </h6>
                        <p class="fs-3">Международная физическая олимпиада
                            <span class="text-danger">Пройдет онлайн с 7 по 15 декабря в Москве</span>
                        </p>
                        <p>Соревнование для школьников из разных стран мира. Участники выполняют задания в лаборатории и решают теоретические задачи</p>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <h6>
                        Интервью
                    </h6>
                    <p>
                        <a href="https://olimpiada.ru/article/949" class="fs-3">«Сегодня траекторий попадания в астрономию много»: как стать астрофизиком без обсерватории и телескопа на балконе→</a>
                    </p>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="https://olimpiada.ru/activities?type=any&class=any&period_date=&period=year&dogm=on" class="text-white text-center">
                        <p class="h1">71</p>
                        <p>олимпиада Департамента образования и науки города Москвы</p>
                    </a>
                </div>
            </div>
            <div class="row footer-row">
                <div class="col text-center" >
                    <p>
                        <img src="/img/olimp3.png" alt="Всероссийская олимпиада школьников в Москве" >
                    </p>
                    <p>
                        <a href="https://vos.olimpiada.ru/">
                            <span>
                                Главная олимпиада страны →
                            </span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
