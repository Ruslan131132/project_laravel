@extends('layouts.user-layout')

@section('description', 'User schedule page')

@section('title-block', 'Schedule')

@section('styles')
    <style>
        li.list-group-item {
            min-height: 100px;
            max-height: 110px;
        }
        h4 {
            border: 1px solid #dfdfdf;
            margin-bottom: -3px;
            padding: 15px;
            border-radius: 3px;
        }
    </style>
@endsection

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
            @php
                $i = 0;//для заполнения пустых уроков
            @endphp
            <div class="col-lg-6 order-lg-{{ $day->diary_number }} px-md-4">
                <h4 class="d-flex justify-content-between align-items-center">
                    <span>{{ $day->name }}</span>
                    <span class="badge bg-dark rounded-pill">{{ count($schedule->where('day_number', $day->number)) }}</span>
                </h4>
                <ul class="list-group mb-3">
                    @foreach($schedule->where('day_number', $day->number) as $info)
                        @php
                            $i++;
                        @endphp
                        @if ($i != $info->lesson_number)
                            @for ($j = 0; $j < $info->lesson_number - $i; $j++)
                                <li class="list-group-item d-flex justify-content-between lh-sm
                                    {{ //проверяем текущий ли день в расписании
                                        $day->number == date("N", strtotime(date("l"))) &&
                                        (strtotime(date('H:i')) > strtotime(substr($lessons[$i + $j - 1], 0, -6))) &&
                                        (strtotime(date('H:i')) < strtotime(substr($lessons[$i + $j - 1], -5)))
                                        ? 'list-group-item-success'
                                        : ''
                                     }}"
                                >
                                    <div>
                                        <h6 class="mb-3">{{ $i + $j}}. -</h6>
                                        <span class="text-muted mt-2">
                                            <p>{{$lessons[$i + $j - 1]}}</p>
                                        </span>
                                    </div>
                                </li>
                            @endfor
                            @php
                                $i = $info->lesson_number;
                            @endphp
                        @endif
                        <li class="list-group-item d-flex justify-content-between lh-sm
                            {{ //проверяем текущий ли день в расписании
                                $info->day_number == date("N", strtotime(date("l"))) &&
                                (strtotime(date('H:i')) > strtotime($info->lesson->start_time)) &&
                                (strtotime(date('H:i')) < strtotime($info->lesson->end_time))
                                ? 'list-group-item-success'
                                : ''
                            }}"
                        >
                            <div>
                                <h6 class="mb-3">{{ $info->lesson_number.'. '.$info->subject->name }}</h6>
                                <span class="text-muted mt-2">
                                    {{ substr($info->lesson->start_time, 0, -3).'-'.substr($info->lesson->end_time, 0, -3) }}
                                </span>
                            </div>
                            <span class="text-muted">
                                <p class="text-end">каб. {{ $info->cabinet->name }}</p>
                                <p class="text-end">
                                    @if(Auth::user()->user_type == 'Учитель')
                                        {{ 'Класс: '.$info->class->name }}
                                    @else
                                        @if(count($info->teacher) == 0)
                                            <span class="default">/ Преподаватель вскоре будет добавлен /</span>
                                        @else
                                            @foreach($info->teacher as $teacher_info)
                                                <span class="text-start pb-2 default">
                                                    {{ '/ '.$teacher_info->surname.' '.$teacher_info->name.' '.$teacher_info->patronymic.' /' }}
                                                    <br>
                                                </span>
                                            @endforeach
                                        @endif
                                    @endif
                                </p>
                            </span>
                        </li>
                    @endforeach
                    @for ($j = 0; $j < 7 - $i; $j++)
                        <li class="list-group-item d-flex justify-content-between lh-sm
                            {{ //проверяем текущий ли день в расписании
                                $day->number == date("N", strtotime(date("l"))) &&
                                (strtotime(date('H:i')) > strtotime(substr($lessons[$i + $j], 0, -6))) &&
                                (strtotime(date('H:i')) < strtotime(substr($lessons[$i + $j], -5)))
                                ? 'list-group-item-success'
                                : '' }}"
                        >
                            <div>
                                <h6 class="mb-3">{{ $i + $j + 1}}. -</h6>
                                <span class="text-muted mt-2">
                                    <p>{{$lessons[$i + $j]}}</p>
                                </span>
                            </div>
                        </li>
                    @endfor
                </ul>
            </div>
        @endforeach
    </div>
@endsection
