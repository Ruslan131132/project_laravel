@extends('layouts.user-layout')

@section('description', 'Admin create new Shedule')

@section('title-block', 'Create Shedule')

@section('li-blocks')
    @include('layouts.li', ['value' => 'Главная', 'status' => '', 'icon' => '/svg/home.svg', 'route' => 'admin.main'])
    @include('layouts.li', ['value' => 'Пользователи', 'status' => '', 'icon' => '/svg/users.svg', 'route' => 'admin.users'])
    @include('layouts.li', ['value' => 'Классы', 'status' => '', 'icon' => '/svg/class.svg', 'route' => 'admin.classes'])
    @include('layouts.li', ['value' => 'Предметы', 'status' => '', 'icon' => '/svg/book.svg', 'route' => 'admin.subjects'])
    @include('layouts.li', ['value' => 'Занятость', 'status' => '', 'icon' => '/svg/employment.svg', 'route' => 'admin.employment'])
    @include('layouts.li', ['value' => 'Расписание', 'status' => 'active', 'icon' => '/svg/schedule.svg', 'route' => 'admin.schedule'])
@endsection

@section('content')
    <div class="row">
        <div class="bd-heading sticky-xl-top align-self-start mt-3 mb-3 mt-xl-0 mb-xl-2">
            <div class="row border-bottom justify-content-between">
                <div class="col-auto">
                    <h3 class="pb-2 ">Расписание</h3>
                </div>
                <div class="col-auto">
                    <div class="row g-3 d-print-inline">
                        <div class="col-auto">
                            <label for="class_name" class="col-form-label">Класс:&nbsp;</label>
                        </div>
                        <div class="col-auto">
                            <form method="POST" action="{{ route('admin.schedule') }}">
                                @csrf
                                <select class="form-control" id="class_id" name="class_id" width="50px" required onChange="this.form.submit()">
                                    @foreach($classes ?? '' as $class)
                                        <option value="{{ $class->id }}" {{ $class->id == $current_class_id ? 'selected' : '' }}>{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($days as $day)
            <div class="col-sm-6 order-sm-{{ $day->diary_number }} px-md-4">
                <h4 class="d-flex justify-content-between align-items-center" style="border: 1px solid #dfdfdf; margin-bottom: -3px; padding: 15px; border-radius: 3px;">
                    <span>{{ $day->name }}</span>
                    <span class="badge bg-dark rounded-pill">{{ count($schedule->where('day_number', $day->number)) }}</span>
                </h4>
                <ul class="list-group mb-3">
                    @foreach($schedule->where('day_number', $day->number) as $info)
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">{{ $info->subject->name }}</h6>
                                <small class="text-muted">преподаватель</small>
                            </div>
                            <span class="text-muted my-auto">каб. {{ $info->cabinet->name }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts', '')
