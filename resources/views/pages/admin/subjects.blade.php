@extends('layouts.user-layout')

@section('description', 'Admin create new Subject')

@section('title-block', 'Create Subject')

@section('li-blocks')
    @include('layouts.li', ['value' => 'Главная', 'status' => '', 'icon' => '/svg/home.svg', 'route' => 'admin.main'])
    @include('layouts.li', ['value' => 'Пользователи', 'status' => '', 'icon' => '/svg/users.svg', 'route' => 'admin.users'])
    @include('layouts.li', ['value' => 'Классы', 'status' => '', 'icon' => '/svg/class.svg', 'route' => 'admin.classes'])
    @include('layouts.li', ['value' => 'Предметы', 'status' => 'active', 'icon' => '/svg/book.svg', 'route' => 'admin.subjects'])
    @include('layouts.li', ['value' => 'Занятость', 'status' => '', 'icon' => '/svg/employment.svg', 'route' => 'admin.employment'])
    @include('layouts.li', ['value' => 'Расписание', 'status' => '', 'icon' => '/svg/schedule.svg', 'route' => 'admin.schedule'])
@endsection

@section('content')
    <div class="row">
        <div class="bd-heading align-self-start mt-3 mb-3 mt-xl-0 mb-xl-2">
            <h3 class="pb-2 border-bottom text-center text-lg-start">Список предметов</h3>
        </div>
        <table class="table table-hover table-responsive">
            <thead class="table-light">
            <tr>
                <th scope="col">Дисциплина</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($subjects as $subject)
                <tr>
                    <th scope="row">{{ $subject->name }}</th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts', '')
