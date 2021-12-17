@extends('layouts.user-layout')

@section('description', 'User marks page')

@section('title-block', 'Marks')

@section('styles')
    <link rel="stylesheet" href="/css/user/user-marks.css">
@endsection

@section('li-blocks')
    @include('layouts.li', ['value' => 'Главная', 'status' => '', 'icon' => '/svg/home.svg', 'route' => 'user.main'])
    @include('layouts.li', ['value' => 'Расписание', 'status' => '', 'icon' => '/svg/schedule.svg', 'route' => 'user.schedule'])
    @include('layouts.li', ['value' => 'Оценки', 'status' => 'active', 'icon' => '/svg/marks.svg', 'route' => 'user.marks'])
    @include('layouts.li', ['value' => 'Курсы', 'status' => '', 'icon' => '/svg/class.svg', 'route' => 'user.courses'])
    @include('layouts.li', ['value' => 'Олимпиады', 'status' => '', 'icon' => '/svg/globe.svg', 'route' => 'user.olimps'])
    @include('layouts.li', ['value' => 'Экзамены', 'status' => '', 'icon' => '/svg/exam.svg', 'route' => 'user.exams'])
@endsection

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        @if($User_Type=="Учитель")
            @php
                $classes = [];
                $subjects = [];
                foreach ($classes_subjects as $key) {
                  $classes[] = $key->className;
                  $subjects[] = $key->subjectName;
                }
                $classes_unique = array_unique($classes);
                $subjects_unique = array_unique($subjects);
            @endphp
            <div class="row pt-3 pb-2 mb-3" style="text-align: center">
                <div class="col-4" >
                    <h1 class="h3">Журнал</h1>
                </div>
                <div class="col-4">
                    <form class="form-inline">
                        <label for="classes"><h1 class="h3">Класс:</h1></label>
                        <select class="choose form-control" id="classes" >
                            @foreach($classes_unique as $class)
                                <option
                                    @php
                                        if(Session::has('teachers_class') && Session::get('teachers_class', 0) == $class){
                                            echo "selected";
                                        }else{
                                            if($classes_subjects[0]->className == $class)
                                                echo "selected";
                                        }
                                    @endphp
                                >{{ $class }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="col-4">
                    <form class="form-inline">
                        <label for="subjects"><h1 class="h3">Предмет:</h1></label>
                        <select class="choose form-control" id="subjects" >
                            @foreach($subjects_unique as $subject)
                                <option
                                    @php
                                        if(Session::has('teachers_subject') && Session::get('teachers_subject', 0) == $subject){
                                            echo "selected";
                                        }else{
                                            if($classes_subjects[0]->subjectName == $subject)
                                                echo "selected";
                                        }
                                    @endphp
                                >{{ $subject }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
        @endif
        <div class="table-responsive mt-4">
            <table class="table table-striped table-hover table-bordered table-sm" style="text-align: center;">
                @if($User_Type=="Учитель")
                    <thead>
                    <tr>
                        <th scope="col" style="width:20%;">ФИО ученика</th>
                        <th scope="col">Оценки</th>
                        <th scope="col" style="width:10%;">Ср. балл</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $full_select = 0;
                        $average_score = 0;
                    @endphp
                    @foreach($row as $pupil)
                        @php
                            $full_select = 0;
                            $average_score = 0;
                        @endphp
                        <tr>
                            <th scope="col-md-3 col-lg-2">{{$pupil->Surname}} {{$pupil->Name}} {{$pupil->Patronymic}}</th>
                            <td>
                                @foreach($class_marks as $el)
                                    @if($pupil->Id == $el->Pupil_Id)
                                        <select title="{{$el->Updated_at}}" id='{{$el->markId}}' data-pupil_id='{{$el->Pupil_Id}}' data-subject_id='{{$el->Subject_Id}}' class="marks">
                                            <option> </option>
                                            <option {{($el->Mark==1) ? 'selected' : ''}}>1</option>
                                            <option {{($el->Mark==2) ? 'selected' : ''}}>2</option>
                                            <option {{($el->Mark==3) ? 'selected' : ''}}>3</option>
                                            <option {{($el->Mark==4) ? 'selected' : ''}}>4</option>
                                            <option {{($el->Mark==5) ? 'selected' : ''}}>5</option>
                                        </select>
                                        @php
                                            $average_score += $el->Mark;
                                            $full_select++;
                                        @endphp
                                    @endif
                                @endforeach
                                @for($m = 0; $m < 33 - $full_select; $m++)
                                    <select data-pupil_id='{{$pupil->Id}}' data-subject_id='{{$choosed_subject[0]->Id}}' class="marks">
                                        <option selected> </option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                @endfor

                            </td>
                            <td>{{($average_score==0) ? 0 : round($average_score/$full_select, 2)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                @endif
                @if($User_Type=="Ученик")
                    <thead>
                    <tr>
                        <th scope="col" style="width:20%;">Предметы</th>
                        <th scope="col">Оценки</th>
                        <th scope="col" style="width:10%;">Ср. балл</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $full_select = 0;
                        $average_score = 0;
                    @endphp
                    @foreach($row as $subject)
                        @php
                            $full_select = 0;
                            $average_score = 0;
                        @endphp
                        <tr>
                            <th scope="col-md-3 col-lg-2">{{$subject->Name}}</th>
                            <td>
                                @foreach($class_marks as $el)
                                    @if($subject->Id == $el->subId)
                                        <select disabled title="{{$el->Updated_at}}" class="marks">
                                            <option selected>{{$el->Mark}}</option>
                                        </select>
                                        @php
                                            $full_select++;
                                            $average_score += $el->Mark;
                                        @endphp
                                    @endif
                                @endforeach
                                @for($m = 0; $m < 33 - $full_select; $m++)
                                    <select disabled class="marks">
                                        <option selected> </option>
                                    </select>
                                @endfor
                            </td>
                            <td>{{($average_score==0) ? 0 : round($average_score/$full_select, 2)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                @endif
            </table>
        </div>
    </main>
@endsection


@section('scripts')
    <script src="/js/user-marks.js"></script>
@endsection
