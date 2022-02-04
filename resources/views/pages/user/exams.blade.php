@extends('layouts.user-layout')

@section('description', 'User exam page')

@section('title-block', 'Exams')

@section('styles')
    <style href="/css/user/user-ege.css"></style>
@endsection

@section('li-blocks')
    @include('layouts.li', ['value' => 'Главная', 'status' => '', 'icon' => '/svg/home.svg', 'route' => 'user.main'])
    @include('layouts.li', ['value' => 'Расписание', 'status' => '', 'icon' => '/svg/schedule.svg', 'route' => 'user.schedule'])
    @include('layouts.li', ['value' => 'Оценки', 'status' => '', 'icon' => '/svg/marks.svg', 'route' => 'user.marks'])
    @include('layouts.li', ['value' => 'Курсы', 'status' => '', 'icon' => '/svg/class.svg', 'route' => 'user.courses'])
    @include('layouts.li', ['value' => 'Олимпиады', 'status' => '', 'icon' => '/svg/globe.svg', 'route' => 'user.olimps'])
    @include('layouts.li', ['value' => 'Экзамены', 'status' => 'active', 'icon' => '/svg/exam.svg', 'route' => 'user.exams'])
@endsection

@section('content')
    <div class="row">
        <section class="jumbotron text-center" style="margin-top: 2rem;">
            <div class="container">
                <h1>Подготовка к Экзаменам</h1>
                <p class="lead text-muted">Подготовительные курсы Центра довузовского образования Москосвкого Политехнического Университета обеспечат солидную подготовку к выпускным и вступительным экзаменам, повышение среднего балла, ликвидацию пробелов в школьной программе, индивидуальный подход и помощь опытных преподавателей в выборе будущей профессии.</p>
            </div>
        </section>
        <div class="row" style="text-align: center" align="center">
            <div class="col-12">
                <h3><b>Мы гарантируем:</b></h3>
            </div>
        </div>
        <div class="row d-flex justify-content-sm-around">
            <div class="col-lg-3 col-md-6 text-center">
                <img src="/img/ege/2.png">
                <p>
                    Университетский<br>уровень подготовки
                </p>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <img src="/img/ege/3.png">
                <p>
                    Научить понимать,<br>а не «зубрить»
                </p>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <img src="/img/ege/4.png">
                <p>
                    Индивидуальный<br>подход
                </p>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <img src="/img/ege/5.png">
                <p>
                    Доступные<br>цены
                </p>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <img src="/img/ege/6.png" class="mt48 mb24">
                <p>Ликвидировать<br>
                    пробелы в школьной<br>
                    программе
                </p>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <img src="/img/ege/7.png" class="mt48 mb24">
                <p>
                    Педагогов, заинтересованных<br>
                    в хорошем результате
                </p>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <img src="/img/ege/8.png" class="mt48 mb24">
                <p>
                    Удобное расписание<br>
                    занятий<br>
                    (будни или выходные)
                </p>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <img src="/img/ege/9.png" class="mt48 mb24">
                <p>
                    Подготовку<br>
                    с учетом<br>
                    требований ФГОС
                </p>
            </div>
        </div>

        <br/>
        <div class="row container-info">
            <div class="row row-info" align="center">
                <div class="col">
                    <h6><a class="link_none_a" href="https://old.mospolytech.ru/index.php?id=5709">&nbsp;КАК&nbsp;<span style="color: red">ПОСТУПИТЬ НА ПОДГОТОВИТЕЛЬНЫЕ КУРСЫ</span> Московского Политеха</a></h6>
                </div>
            </div>
        </div>
        <br/>
        <footer class="container">
            <p style="text-align: right;">&copy; 2022 Московский Политехнический Университет · Курсы · Дневник · Проект</p>
        </footer>
    </div>
@endsection
