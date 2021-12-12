@extends('layouts.user-layout')

@section('description', 'Admin create new Shedule')

@section('title-block', 'Create Shedule')

@section('li-blocks')
    <li class="nav-item">
        <a class="nav-link " href="{{ route('admin') }}">
            <span data-feather="home"></span>
            Создать пользователя
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('createClass') }}">
            <span data-feather="file"></span>
            Создать класс
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('createSubject') }}">
            <span data-feather="file"></span>
            Создать предмет
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('createEmployment') }}">
            <span data-feather="file"></span>
            Создать занятость
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('createShedule') }}" style="color: #ffffff">
            <span data-feather="file"></span>
            Создать расписание<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659l4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
            </svg><span class="sr-only">(current)</span>
        </a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="multi-collapse justify-content-md-center collapse show" id="collapseCreateUser">
                    <div class="card card-body" id="card">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Создание/обновление расписания</h5>
                                <button type="button" class="close" data-toggle="collapse" href="#collapseCreateUser" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form-inline" method="POST" action="{{ route('createShed') }}">
                                    @csrf
                                    <div class="form-group mx-sm-3 mb-2">
                                        <label for="Class_Name">Класс:&nbsp;</label>
                                        <select class="form-control" id="Class_Name" name="Class_Name" required>
                                            @foreach($classes as $class)
                                                <option>{{ $class->Name }}</option>
                                            @endforeach
                                        </select>
                                    </div>&nbsp;
                                    <div class="form-group mx-sm-3 mb-2">
                                        <label for="Day_Number">День недели:&nbsp;</label>
                                        <select class="form-control" id="Day_Number" name="Day_Number" required>
                                            <option selected>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                        </select>
                                    </div>&nbsp;
                                    <div class="form-group mx-sm-3 mb-2">
                                        <label for="Lesson_Number">Номер урока:&nbsp;</label>
                                        <select class="form-control" id="Lesson_Number" name="Lesson_Number" required>
                                            <option selected>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                        </select>
                                    </div>&nbsp;
                                    <div class="form-group mx-sm-3 mb-2">
                                        <label for="Subject_Name">Предмет:&nbsp;</label>
                                        <select class="form-control" id="Subject_Name" name="Subject_Name" required>
                                            @foreach($subjects as $subject)
                                                <option>{{ $subject->Name }}</option>
                                            @endforeach
                                        </select>
                                    </div>&nbsp;
                                    <div class="form-group mx-sm-3 mb-2">
                                        <label for="Cabinet_Number">Кабинет:&nbsp;</label>
                                        <select class="form-control" id="Cabinet_Number" name="Cabinet_Number" required>
                                            @foreach($cabinets as $cabinet)
                                                <option>{{ $cabinet->Name }}</option>
                                            @endforeach
                                        </select>
                                    </div>&nbsp;
                                    <button type="submit" class="btn btn-success mb-2">Добавить запись</button>
                                </form>
                                <p>Предупреждения:<br/>
                                    Если в указанный день в указанный урок кабинет занят другим классом - запись добавить не получится.<br/>
                                    Если в указанный день в указанный урок у выбранного класса уже есть урок - запись об этом классе в расписании обновится.<br/>
                                    Если записи в БД в указанный день в указанный урок у выбранного класса нет - запись добавится в БД.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts', '')
