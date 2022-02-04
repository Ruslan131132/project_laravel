@extends('layouts.user-layout')

@section('description', 'User courses page')

@section('title-block', 'Courses')

@section('styles')
    <link rel="stylesheet" href="/css/user/user-courses.css">
    <style>
       .bd-placeholder-img{
           border-radius: 25px 0 0 25px;
       }
    </style>
@endsection

@section('li-blocks')
    @include('layouts.li', ['value' => 'Главная', 'status' => '', 'icon' => '/svg/home.svg', 'route' => 'user.main'])
    @include('layouts.li', ['value' => 'Расписание', 'status' => '', 'icon' => '/svg/schedule.svg', 'route' => 'user.schedule'])
    @include('layouts.li', ['value' => 'Оценки', 'status' => '', 'icon' => '/svg/marks.svg', 'route' => 'user.marks'])
    @include('layouts.li', ['value' => 'Курсы', 'status' => 'active', 'icon' => '/svg/class.svg', 'route' => 'user.courses'])
    @include('layouts.li', ['value' => 'Олимпиады', 'status' => '', 'icon' => '/svg/globe.svg', 'route' => 'user.olimps'])
    @include('layouts.li', ['value' => 'Экзамены', 'status' => '', 'icon' => '/svg/exam.svg', 'route' => 'user.exams'])
@endsection

@section('content')
    <div class="row my-2">
        @foreach($courses as $course)
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <div class="row">
                            <div class="col-md-9 col-sm-12">
                                <h4 class="d-inline-block mb-2 ">{{ $course->name }}</h4>
                                <p class="card-text mb-auto text-muted">
                                    {{ $course->description }}
                                </p>

                                <p class="text-start text-muted py-3">
                                    {{ 'Преподаватель: '.$course->teacher->surname.' '.$course->teacher->name .' '.$course->teacher->patronymic }}
                                    @if($course->teacher_id == Auth::user()->user_id)
                                        <br>
                                        <span class="text-success">Вы куратор этого курса</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-3 col-sm-0 d-none d-lg-block">
                                @if($course->img)
                                    <img class="bd-placeholder-img" src="{{$course->img}}" height="180"/>
                                @else
                                    <svg class="bd-placeholder-img" width="150" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>{{ $course->name }}</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">{{ $course->name }}</text></svg>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <p class="text-primary my-auto">
                                    {{ $course->training_period }}
                                </p>
                                @if(Auth::user()->user_type == 'Ученик' )
                                    @if(Auth::user()->pupil->hasCourse($course->id))
                                        <a class="btn text-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M15.354 2.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L8 9.293l6.646-6.647a.5.5 0 0 1 .708 0z"></path>
                                                <path fill-rule="evenodd" d="M8 2.5A5.5 5.5 0 1 0 13.5 8a.5.5 0 0 1 1 0 6.5 6.5 0 1 1-3.25-5.63.5.5 0 1 1-.5.865A5.472 5.472 0 0 0 8 2.5z"></path>
                                            </svg>
                                            Вы записаны
                                        </a>
                                    @else
                                        <form class="d-flex d-print-inline">
                                            <input type="hidden" name="test" value="test">
                                            <a class="btn text-primary">
                                                Записаться
                                            </a>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script src="/js/user-courses.js"></script>
@endsection
