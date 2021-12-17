@extends('layouts.user-layout')

@section('description', 'Admin create new Employment')

@section('title-block', 'Create Employment')

@section('li-blocks')
    @include('layouts.li', ['value' => 'Главная', 'status' => '', 'icon' => '/svg/home.svg', 'route' => 'admin.main'])
    @include('layouts.li', ['value' => 'Пользователи', 'status' => '', 'icon' => '/svg/users.svg', 'route' => 'admin.users'])
    @include('layouts.li', ['value' => 'Классы', 'status' => '', 'icon' => '/svg/class.svg', 'route' => 'admin.classes'])
    @include('layouts.li', ['value' => 'Предметы', 'status' => '', 'icon' => '/svg/book.svg', 'route' => 'admin.subjects'])
    @include('layouts.li', ['value' => 'Занятость', 'status' => 'active', 'icon' => '/svg/employment.svg', 'route' => 'admin.employment'])
    @include('layouts.li', ['value' => 'Расписание', 'status' => '', 'icon' => '/svg/schedule.svg', 'route' => 'admin.schedule'])
@endsection


@section('content')
    <div class="row">
        <div class="bd-heading sticky-xl-top align-self-start mt-3 mb-3 mt-xl-0 mb-xl-2">
            <h3 class="pb-2 border-bottom">Занятость преподавателей</h3>
        </div>
        <table class="table table-hover table-responsive align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col">Преподаватель</th>
                    <th scope="col">Дисциплина</th>
                    <th scope="col">Класс</th>
                    <th scope="col">Действия</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($employments as $employment)
                <tr>
                    <th scope="row">{{ $employment->teacher->surname." ".$employment->teacher->name." ".$employment->teacher->patronymic }}</th>
                    <td>{{ $employment->subject->name }}</td>
                    <td>{{ $employment->class->name }}</td>
                    <td>
                        <mat-icon _ngcontent-serverapp-c191="" role="img" class="mat-icon notranslate material-icons mat-icon-no-color" style="color: grey;" aria-hidden="true" data-mat-icon-type="font">edit</mat-icon>
                        <mat-icon _ngcontent-serverapp-c191="" role="img" class="mat-icon notranslate material-icons mat-icon-no-color" style="color: #DB2828;" aria-hidden="true" data-mat-icon-type="font">delete_forever</mat-icon>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts', '')
