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
    <div class="container">
        <section class="jumbotron text-center" style="margin-top: 2rem;">
            <div class="container">
                <h1>Подготовка к Экзаменам</h1>
                <p class="lead text-muted">Подготовительные курсы Центра довузовского образования Москосвкого Политехнического Университета обеспечат солидную подготовку к выпускным и вступительным экзаменам, повышение среднего балла, ликвидацию пробелов в школьной программе, индивидуальный подход и помощь опытных преподавателей в выборе будущей профессии.</p>
            </div>
        </section>
        <div class="row" style="text-align: center" align="center">
            <div class="col">
                <h3><b>Мы гарантируем:</b></h3>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-sm" style="text-align: center;">
                <tbody>
                <tr>
                    <td width="25%">
                        <img src="/img/ege/2.png" class="mt48 mb24">
                    </td>
                    <td width="25%">
                        <img src="/img/ege/3.png" class="mt48 mb24">
                    </td>
                    <td width="25%">
                        <img src="/img/ege/4.png" class="mt48 mb24">
                    </td>
                    <td width="25%">
                        <img src="/img/ege/5.png" class="mt48 mb24">
                    </td>
                </tr>
                <tr>
                    <td>
                        Университетский<br>
                        уровень подготовки
                    </td>
                    <td>
                        Научить понимать,<br>
                        а не «зубрить»
                    </td>
                    <td>
                        Индивидуальный<br>
                        подход
                    </td>
                    <td>
                        Доступные<br>
                        цены
                    </td>
                </tr>
                <tr>
                    <td>
                        <img src="/img/ege/6.png" class="mt48 mb24">
                    </td>
                    <td>
                        <img src="/img/ege/7.png" class="mt48 mb24">
                    </td>
                    <td>
                        <img src="/img/ege/8.png" class="mt48 mb24">
                    </td>
                    <td>
                        <img src="/img/ege/9.png" class="mt48 mb24">
                    </td>
                </tr>
                <tr>
                    <td>
                        Ликвидировать<br>
                        пробелы в школьной<br>
                        программе
                    </td>
                    <td>
                        Педагогов, заинтересованных<br>
                        в хорошем результате
                    </td>
                    <td>
                        Удобное расписание<br>
                        занятий<br>
                        (будни или выходные)
                    </td>
                    <td>
                        Подготовку<br>
                        с учетом<br>
                        требований ФГОС
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <br/>
        <div class="container container-info">
            <div class="row row-info" align="center">
                <div class="col">
                    <b><p><a class="link_none_a" href="https://old.mospolytech.ru/index.php?id=5709">&nbsp;КАК&nbsp;<nobr style="color: red">ПОСТУПИТЬ НА ПОДГОТОВИТЕЛЬНЫЕ КУРСЫ</nobr> Московского Политеха</a></p></b>
                </div>
            </div>
        </div>
        <br/>
        <footer class="container">
            <p style="text-align: right;">&copy; 2020 Московский Политехнический Университет · Курсы · Дневник</p>
        </footer>
    </div>
@endsection
