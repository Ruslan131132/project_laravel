@extends('layouts.user-layout')

@section('description', 'User shedule page')

@section('title-block', 'Shedule')

@section('li-blocks')
    @include('layouts.li', ['value' => 'Главная', 'status' => '', 'icon' => '/svg/home.svg', 'route' => 'user.main'])
    @include('layouts.li', ['value' => 'Расписание', 'status' => 'active', 'icon' => '/svg/schedule.svg', 'route' => 'user.schedule'])
    @include('layouts.li', ['value' => 'Оценки', 'status' => '', 'icon' => '/svg/marks.svg', 'route' => 'user.marks'])
    @include('layouts.li', ['value' => 'Курсы', 'status' => '', 'icon' => '/svg/class.svg', 'route' => 'user.courses'])
    @include('layouts.li', ['value' => 'Олимпиады', 'status' => '', 'icon' => '/svg/globe.svg', 'route' => 'user.olimps'])
    @include('layouts.li', ['value' => 'Экзамены', 'status' => '', 'icon' => '/svg/exam.svg', 'route' => 'user.exams'])
@endsection

@section('content')
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
                                <h6 class="mb-3">{{ $info->lesson_number.') '.$info->subject->name }}</h6>
                                <span class="text-muted mt-2">
                                    {{ substr($info->lesson->start_time, 0, -3).'-'.substr($info->lesson->end_time, 0, -3) }}
                                </span>
                            </div>
                            <span class="text-muted">
                                <p>каб. {{ $info->cabinet->name }}</p>
                                <p>
                                    @if(Auth::user()->user_type == 'Учитель')
                                        {{ 'Класс: '.$info->class->name }}
                                    @else
                                        {{ 'препод' }}
                                    @endif
                                </p>
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
@endsection
