@extends('layouts.user-layout')

@section('description', 'User main page')

@section('title-block', 'Main')

@section('styles')
    <link rel="stylesheet" href="/css/user/user-main.css">
@endsection

@section('li-blocks')
    @include('layouts.li', ['value' => 'Главная', 'status' => 'active', 'icon' => '/svg/home.svg', 'route' => 'user.main'])
    @include('layouts.li', ['value' => 'Расписание', 'status' => '', 'icon' => '/svg/schedule.svg', 'route' => 'user.schedule'])
    @include('layouts.li', ['value' => 'Оценки', 'status' => '', 'icon' => '/svg/marks.svg', 'route' => 'user.marks'])
    @include('layouts.li', ['value' => 'Курсы', 'status' => '', 'icon' => '/svg/class.svg', 'route' => 'user.courses'])
    @include('layouts.li', ['value' => 'Олимпиады', 'status' => '', 'icon' => '/svg/globe.svg', 'route' => 'user.olimps'])
    @include('layouts.li', ['value' => 'Экзамены', 'status' => '', 'icon' => '/svg/exam.svg', 'route' => 'user.exams'])
@endsection

@section('content')
        <div class="row">
            <div class="col order-md-2 mb-4">
                @php
                    $courses = $user->user_type == 'Учитель' ?  $user->teacher->course : $user->pupil->course;
                @endphp
                @if(count($courses) != 0)
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Активных курсов</span>
                        <span class="badge bg-success rounded-pill">{{ count($courses) }}</span>
                    </h4>
                    <ul class="list-group mb-3">
                        @foreach($courses as $course)
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Курс «{{$course->name}}»</h6>
                                    <small class="text-muted">{{ date("d.m.y(h:i) ", strtotime(strval($course->created_at))) }}</small>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="col-md-9 order-md-1">
                <h4 class="mb-3">Информация</h4>
                <form class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="firstName">Имя</label>
                            <input type="text" readonly class="form-control" id="firstName" value="{{ $user->name }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="lastName">Фамилия</label>
                            <input type="text" readonly class="form-control" id="lastName" value="{{ $user->surname }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="Patronymic">Отчество</label>
                            <input type="text" readonly class="form-control" id="Patronymic" value="{{ $user->patronymic }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="position">Должность</label>
                            <input type="text" readonly class="form-control" id="position" value="{{ $user->user_type }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="class">{{ $user->user_type == "Учитель" ? "Классный руководитель" : "Класс"}}</label>
                            <input type="text" readonly class="form-control" id="class" value="{{ $user->user_type == "Учитель" ?  $user->teacher->class->name : $user->pupil->class->name }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address">Адрес</label>
                        <input type="text" readonly class="form-control" id="address" value="{{ $user->address }}">
                    </div>
                </form>
            </div>
        </div>
@endsection
