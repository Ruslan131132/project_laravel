@extends('layouts.user-layout')

@section('description', 'User courses page')

@section('title-block', 'Courses')

@section('styles')
    <link rel="stylesheet" href="/css/user/user-courses.css">
@endsection

@section('li-blocks')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">
            <span data-feather="user"></span>
            Главная <span class="sr-only"></span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('shedule') }}">
            <span data-feather="shedule"></span>
            Расписание
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('marks') }}">
            <span data-feather="marks"></span>
            Оценки
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('courses') }}">
            <span data-feather="courses"></span>
            Записаться на курс <span class="sr-only">(current)</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('olimpiads') }}">
            <span data-feather="users"></span>
            Олимпиады
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('ege') }}">
            <span data-feather="layers"></span>
            ЕГЭ
        </a>
    </li>
@endsection

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Выбор курса</h1>
        </div>
        <div class="row" align="center">
            @if(Session::has('course_message'))
                <div class="alert alert-info {{ Session::has('course_message_important') ? 'alert-important' : '' }}" style="text-align: center; position: fixed; z-index: 101;  flex-wrap: wrap; margin-right: -15px; margin-left: -15px;" width="20%">
                    @if(Session::has('course_message_important'))
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    @endif
                    {{ session('course_message') }}
                </div>
            @endif
        </div>
        <div class="text-center">
            <div class="row featurette" id="courses">
                <hr class="featurette-divider">
                <div class="album py-5 ">
                    <div class="container" style="text-align: center;">
                        <div class="row" id="print_course">
                            @php
                                $courses = [
                                    ['Английский язык',12, 30],
                                    ['Программирование', 6, 40],
                                    ['математика(ЕГЭ)', 9, 18],
                                    ['Русский язык(ЕГЭ)', 9, 18],
                                    ['Биология(ЕГЭ)', 18, 30],
                                    ['С++', 10, 60],
                                    ['Химия(ЕГЭ)', 10, 15],
                                    ['Физика', 9, 20]
                                ];
                            @endphp
                            @for($i = 0; $i < count($courses); $i++)
                                <div class="col-md-3">
                                    <div class="card mb-4 shadow-sm" style="border-radius: 25px;">
                                        <img src="/img/courses/c{{$i+1}}.jpg" class="bd-placeholder-img card-img-top" width="100%" height="200">
                                        <div class="card-body">
                                            <p class="card-text">{{$courses[$i][0]}}</p>
                                            <div class="row">
                                                <div class="col-12" style="height: 70px;">
                                                    <small class="text-muted">{{$courses[$i][1]}} месяцев</small>
                                                    <p>{{$courses[$i][2]}} тыс. ₽</p>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <div class="btn-group">
                                                    @php $has_course = 1; @endphp
                                                    @foreach($active_courses as $el)

                                                        @if($el->Course == $i+1)
                                                            @php $has_course = 0; @endphp
                                                            <form class="form-signin">
                                                                <button type="button" class="btn btn-outline-success">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                                        <path fill-rule="evenodd" d="M15.354 2.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L8 9.293l6.646-6.647a.5.5 0 0 1 .708 0z"></path>
                                                                        <path fill-rule="evenodd" d="M8 2.5A5.5 5.5 0 1 0 13.5 8a.5.5 0 0 1 1 0 6.5 6.5 0 1 1-3.25-5.63.5.5 0 1 1-.5.865A5.472 5.472 0 0 0 8 2.5z"></path>
                                                                    </svg>
                                                                    Активный
                                                                </button>
                                                            </form>
                                                            @break
                                                        @endif
                                                    @endforeach
                                                    @if($has_course == 1)
                                                        <form class="form-signin"  method="POST" action="{{ route('regCourse') }}">
                                                            @csrf
                                                            <input type="hidden" id="c{{$i+1}}" name="signUp" value="{{$i+1}}" />
                                                            <button type="submit" class="btn btn-outline-secondary">Записаться</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div> <!-- End of Album -->
            </div> <!-- End of row featurette -->
        </div>
    </main>
@endsection

@section('scripts')
    <script src="/js/user-courses.js"></script>
@endsection
