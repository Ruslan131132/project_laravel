{{--@extends('layouts.user-layout')--}}
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
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">
                {{ $user->user_type == 'Учитель' ? "Здравствуйте, ".$user->teacher->name : "Привет, ".$user->pupil->name }}
            </h1>
        </div>
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <div class="col-auto d-lg-block" align="center" data-bs-toggle="modal" data-bs-target="#changeAvatarModal">
                    @if($user->img != null)
                        <img class="bd-placeholder-img" src="{{$user->img}}" alt="Аватар пользователя - {{$user->user_id}}"/>
                    @else
                        <svg class="bd-placeholder-img" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c"/>
                            <text x="50%" y="50%" fill="#eceeef" dy=".3em">{{ $user->user_type }}</text>
                        </svg>
                    @endif
                </div>
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
                <br/>
                @php
                    $courses = $user->user_type == 'Учитель' ?  $user->teacher->course : $user->pupil->course;
                @endphp
                @if(count($courses) != 0)
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Активных курсов</span>
                    <span class="badge badge-success badge-pill">{{ count($courses) }}</span>
                </h4>
                @endif
                <ul class="list-group mb-3">
                    @foreach($courses as $course)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Курс «{{$courses->name}}»</h6>
                                <small class="text-muted">{{ date("d.m.y(h:i) ", strtotime(strval($course->created_at))) }}</small>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Информация</h4>
                <form class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="firstName">Имя</label>
                            <input type="text" readonly class="form-control" id="firstName" value="{{ $user->user_type == 'Учитель' ? $user->teacher->name : $user->pupil->name }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="lastName">Фамилия</label>
                            <input type="text" readonly class="form-control" id="lastName" value="{{ $user->user_type == 'Учитель' ? $user->teacher->surname : $user->pupil->surname }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="Patronymic">Отчество</label>
                            <input type="text" readonly class="form-control" id="Patronymic" value="{{ $user->user_type == 'Учитель' ? $user->teacher->patronymic : $user->pupil->patronymic }}">
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
                        <input type="text" readonly class="form-control" id="address" value="{{ $user->user_type  == "Учитель" ? "Не указан" : $user->pupil->address }}">
                    </div>
                </form>
            </div>
        </div>
@endsection
