@extends('layouts.user-layout')

@section('description', 'Admin can create new Class')

@section('title-block', 'Create Class')

@section('li-blocks')
    @include('layouts.li', ['value' => 'Главная', 'status' => '', 'icon' => '/svg/home.svg', 'route' => 'admin.main'])
    @include('layouts.li', ['value' => 'Пользователи', 'status' => '', 'icon' => '/svg/users.svg', 'route' => 'admin.users'])
    @include('layouts.li', ['value' => 'Классы', 'status' => 'active', 'icon' => '/svg/class.svg', 'route' => 'admin.classes'])
    @include('layouts.li', ['value' => 'Предметы', 'status' => '', 'icon' => '/svg/book.svg', 'route' => 'admin.subjects'])
    @include('layouts.li', ['value' => 'Занятость', 'status' => '', 'icon' => '/svg/employment.svg', 'route' => 'admin.employment'])
    @include('layouts.li', ['value' => 'Расписание', 'status' => '', 'icon' => '/svg/schedule.svg', 'route' => 'admin.schedule'])
@endsection

@section('content')
    <div class="row">
        <div class="bd-heading sticky-xl-top align-self-start mt-3 mb-3 mt-xl-0 mb-xl-2">
            <h3 class="pb-2 border-bottom">Записи о классах и курсах</h3>
        </div>
        <div class="nav nav-tabs" id="nav-tab" role="tablist" style="padding-right: 0">
            <button class="nav-link active" id="nav-classes-tab" data-bs-toggle="tab" data-bs-target="#nav-classes" type="button" role="tab" aria-controls="nav-classes" aria-selected="true">Классы</button>
            <button class="nav-link" id="nav-courses-tab" data-bs-toggle="tab" data-bs-target="#nav-courses" type="button" role="tab" aria-controls="nav-courses" aria-selected="false">Курсы</button>
            <button type="button" class="nav-link me-0 m-auto" >Добавить</button>
        </div>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-classes" role="tabpanel" aria-labelledby="nav-classes-tab">
                <table class="table table-hover table-responsive align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Класс</th>
                            <th scope="col">Руководитель</th>
                            <th scope="col">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($classes as $class)
                        <tr>
                            <th scope="row">{{ $class->name }}</th>
                            <td>{{ $class->teacher->surname." ".$class->teacher->name." ".$class->teacher->patronymic }}</td>
                            <td>
                                <mat-icon _ngcontent-serverapp-c191="" role="img" class="mat-icon notranslate material-icons mat-icon-no-color" style="color: grey;" aria-hidden="true" data-mat-icon-type="font">edit</mat-icon>
                                <mat-icon _ngcontent-serverapp-c191="" role="img" class="mat-icon notranslate material-icons mat-icon-no-color" style="color: #DB2828;" aria-hidden="true" data-mat-icon-type="font">delete_forever</mat-icon>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-courses" role="tabpanel" aria-labelledby="nav-courses-tab">
                <table class="table table-hover table-responsive align-middle">
                    <thead class="table-light">
                    <tr>
                        <th scope="col">Курс</th>
                        <th scope="col">Руководитель</th>
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($courses as $course)
                        <tr>
                            <th scope="row">
                                <p style="margin: 0">{{ $course->name }}</p>
                                <span id="{{ $course->id }}" class="form-text">
                                    {{ $course->description }}
                                </span>
                            </th>
                            <td>{{ $course->teacher->surname." ".$course->teacher->name." ".$course->teacher->patronymic }}</td>
                            <td>
                                <mat-icon _ngcontent-serverapp-c191="" role="img" class="mat-icon notranslate material-icons mat-icon-no-color" style="color: grey;" aria-hidden="true" data-mat-icon-type="font">edit</mat-icon>
                                <mat-icon _ngcontent-serverapp-c191="" role="img" class="mat-icon notranslate material-icons mat-icon-no-color" style="color: #DB2828;" aria-hidden="true" data-mat-icon-type="font">delete_forever</mat-icon>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

            {{--        <form class="row g-3" method="POST" action="{{ route('admin.create-class') }}">--}}
{{--            @csrf--}}
{{--            <div class="col-4 ">--}}
{{--                <div class="tab-content" id="nav-tabContent">--}}
{{--                    <div class="tab-pane fade show active" id="nav-classes" role="tabpanel" aria-labelledby="nav-classes-tab">--}}
{{--                        <label for="class_name" class="form-label">Класс:&nbsp;</label>--}}
{{--                        <input type="text" name="name"  id="class_name" class="form-control" style="width: 50px" required>--}}
{{--                    </div>--}}
{{--                    <div class="tab-pane fade" id="nav-courses" role="tabpanel" aria-labelledby="nav-courses-tab">--}}
{{--                        <label for="course_name" class="form-label">Название курса:&nbsp;</label>--}}
{{--                        <input type="text" name="name"  id="course_name" class="form-control" required autofocus>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4">--}}
{{--                <label for="teachers-select" class="form-label">Классный руководитель:&nbsp;</label>--}}
{{--                <select class="form-control" name="teachers-select">--}}
{{--                    @foreach($teachers as $teacher)--}}
{{--                        <option value="{{ $teacher->id }}">{{ $teacher->surname." ".$teacher->name." ".$teacher->patronymic }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="col-4 d-grid gap-3">--}}
{{--                <button type="submit" class="btn btn-success btn-primary">Создать запись</button>--}}
{{--            </div>--}}
{{--        </form>--}}




{{--            </div>--}}
{{--            <div class="tab-pane fade" id="nav-courses" role="tabpanel" aria-labelledby="nav-courses-tab">--}}
{{--                <form class="row g-3" method="POST" action="{{ route('admin.create-course') }}">--}}
{{--                    @csrf--}}
{{--                    <div class="col-md-4">--}}
{{--                        <label for="course_name">Название курса:&nbsp;</label>--}}
{{--                        <input type="text" name="name"  id="course_name" class="form-control" required autofocus>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-4">--}}
{{--                        <label for="teacher-select">Куратор:&nbsp;</label>--}}
{{--                        <select class="form-control" name="teachers-select">--}}
{{--                            @foreach($teachers as $teacher)--}}
{{--                                <option value="{{ $teacher->id }}">{{ $teacher->surname." ".$teacher->name." ".$teacher->patronymic }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <button type="submit" class="btn btn-success mb-2">Создать запись</button>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
@endsection

@section('scripts', '')
