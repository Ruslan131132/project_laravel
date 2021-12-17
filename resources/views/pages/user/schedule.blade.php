@extends('layouts.user-layout')

@section('description', 'User shedule page')

@section('title-block', 'Shedule')

@section('li-blocks')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">
            <span data-feather="home"></span>
            Главная <span class="sr-only"></span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('shedule') }}">
            <span data-feather="file"></span>
            Расписание <span class="sr-only">(current)</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('marks') }}">
            <span data-feather="bar-chart-2"></span>
            Оценки
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('courses') }}">
            <span data-feather="shopping-cart"></span>
            Записаться на курс
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
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Расписание</h1>
        </div>
        @php
            $days = array(1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday');
        @endphp
        <div class="row">
            @foreach( $days as $i => $value)
                <div class="col-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
		        <span class="text-muted" style="padding-top: 20px;">
		          {{($i==1) ? 'Пн' : ''}}
                    {{($i==2) ? 'Вт' : ''}}
                    {{($i==3) ? 'Ср' : ''}}
                    {{($i==4) ? 'Чт' : ''}}
                    {{($i==5) ? 'Пт' : ''}}
                    {{($i==6) ? 'Сб' : ''}}
				</span>
                    </h4>
                    <ul class="list-group mb-3">
                        @php $index = 0; @endphp
                        @foreach($data as $el)
                            @if ( $el->Day_Number == $i)
                                @php $index++; @endphp
                                <li class="list-group-item d-flex justify-content-between lh-condensed"
                                    @php
                                        if( $today > $el->Start_Time && $today < $el->End_Time && $value==$day)
                                            echo 'style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;"';
                                        else
                                            echo '';
                                    @endphp
                                >
                                    <div>
                                        <h6 class="my-0">{{$el->Name}}</h6>
                                        <small class="text-muted time">
                                            @php
                                                $start_time = mb_substr($el->Start_Time,0,5);
                                                $end_time = mb_substr($el->End_Time,0,5);
                                            @endphp
                                            {{$start_time}}-{{$end_time}}
                                        </small>
                                    </div>
                                    <span class="text-muted" style="padding-top: 20px;">Каб.{{$el-> Cabinet_Id}}</span>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </main>
@endsection
