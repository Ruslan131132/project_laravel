@extends('layouts.user-layout')

@section('description', 'Admin create new Class')

@section('title-block', 'Create Class')

@section('li-blocks')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin') }}">
            <span data-feather="home"></span>
            Создать пользователя
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('createClass') }}" style="color: #ffffff">
            <span data-feather="file"></span>
            Создать класс<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659l4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
            </svg><span class="sr-only">(current)</span>
        </a>
    </li>
    <li class="nav-item" >
        <a class="nav-link" href="{{ route('createSubject') }}">
            <span data-feather="file"></span>
            Создать предмет
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('createEmployment') }}" >
            <span data-feather="file"></span>
            Создать занятость
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('createShedule') }}" >
            <span data-feather="file"></span>
            Создать расписание
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
                                <h5 class="modal-title">Создание класса</h5>
                                <button type="button" class="close" data-toggle="collapse" href="#collapseCreateUser" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form-inline" method="POST" action="{{ route('createclass') }}">
                                    @csrf
                                    <div class="form-group mx-sm-3 mb-2">
                                        <label for="inputPassword2">Существующие Классы:&nbsp;</label>
                                        <select class="form-control">
                                            @foreach($classes as $class)
                                                <option>{{ $class->Name }}</option>
                                            @endforeach
                                        </select>
                                    </div>&nbsp;
                                    <div class="form-group mx-sm-3 mb-2">
                                        <label for="inputPassword2">Класс:&nbsp;</label>
                                        <input type="text" name="Class_Name"  id="Class_Name" class="form-control"  style="width: 60px" required autofocus>
                                    </div>
                                    <div class="form-group mx-sm-3 mb-2">
                                        <label for="inputPassword2">Руководитель:&nbsp;</label>
                                        <input type="text" name="Surname" class="form-control" id="Surname" placeholder="Фамилия" required>&nbsp;
                                        <input type="text" name="Name" class="form-control" id="Name" placeholder="Имя" required>&nbsp;
                                        <input type="text" name="Patronymic" class="form-control" id="Patronymic" placeholder="Отчество">
                                    </div>
                                    <button type="submit" class="btn btn-success mb-2">Создать запись</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts', '')
