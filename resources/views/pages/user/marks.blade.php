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

    <div class="row">
        <div class="bd-heading align-self-start mt-3 mb-3 mt-xl-0 mb-xl-2 mb-2">
            <div class="row border-bottom justify-content-between ">
                <div class="col-sm-12 col-md-auto">
                    <h3 class="pb-2 d-md-inline text-center text-md-start">Оценки</h3>
                </div>
                @if(Auth::user()->user_type == 'Учитель')
                    <div class="col-sm-12 col-md-auto">
                        <form class="row g-3 d-print-inline justify-content-around mb-2" method="POST" action="{{ route('marks-filter') }}">
                            @csrf
                            <div class="col-auto text-center">
                                <label for="class_name" class="col-form-label">Класс:&nbsp;</label>
                                <select class="form-control w-auto d-inline" id="class_id" name="class_id" required onChange="this.form.submit()">
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}" {{ $class->id == Session::get('current_class_id') ? 'selected' : '' }}>{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-auto">
                                <label for="class_name" class="col-form-label">Предмет:&nbsp;</label>
                                <select class="form-control w-auto d-inline" id="subject_id" name="subject_id"  required onChange="this.form.submit()">
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ $subject->id == Session::get('current_subject_id') ? 'selected' : '' }}>{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
        <div class="table-responsive mt-4">
            <table class="table table-striped table-hover table-bordered table-sm" style="text-align: center;">
                @php
                    $full_select = 0;
                    $average_score = 0;
                @endphp
                @if(Auth::user()->user_type == 'Учитель')
                    <thead>
                        <tr>
                            <th scope="col" style="width:20%;">ФИО ученика</th>
                            <th scope="col">Оценки</th>
                            <th scope="col" style="width:10%;">Ср. балл</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($pupils as $pupil)
                        @php
                            $full_select = 0;
                            $average_score = 0;
                        @endphp
                        <tr>
                            <th scope="col-md-3 col-lg-2">{{ $pupil->surname.' '.$pupil->name.' '.$pupil->patronymic }}</th>
                            <td>
                                @foreach($marks as $mark)
                                    @if($pupil->id == $mark->pupil_id)
                                        <form method="POST" action="{{ route('user.edit-mark') }}" style="display: inherit; padding: 2px;">
                                            @csrf
                                            <input type="hidden" value="{{$mark->id}}" name="id" />
                                            <input type="hidden" value="{{$pupil->id}}" name="pupil_id" />
                                            <select name="mark" class="marks" title="{{'Добавлена: '.$mark->created_at.'; Обновлена: '.$mark->updated_at}}" id='{{$mark->id}}' data-pupil_id='{{$mark->pupil_id}}' data-subject_id='{{$mark->subject_id}}'  onChange="this.form.submit()">
                                                <option></option>
                                                <option {{($mark->mark==1) ? 'selected' : ''}}>1</option>
                                                <option {{($mark->mark==2) ? 'selected' : ''}}>2</option>
                                                <option {{($mark->mark==3) ? 'selected' : ''}}>3</option>
                                                <option {{($mark->mark==4) ? 'selected' : ''}}>4</option>
                                                <option {{($mark->mark==5) ? 'selected' : ''}}>5</option>
                                            </select>
                                        </form>
                                        @php
                                            $average_score += $mark->mark;
                                            $full_select++;
                                        @endphp
                                    @endif
                                @endforeach
                                @for($m = 0; $m < 33 - $full_select; $m++)
                                    <form method="POST" action="{{ route('user.create-mark') }}" style="display: inherit; padding: 2px;">
                                        @csrf
                                        <input type="hidden" value="{{$pupil->id}}" name="pupil_id" />
                                        <select data-pupil_id='{{$pupil->id}}' name="mark" data-subject_id='{{Session::get('current_subject_id')}}' class="marks" onChange="this.form.submit()">
                                            <option selected></option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </form>
                                @endfor

                            </td>
                            <td>{{($average_score==0) ? 0 : round($average_score/$full_select, 2)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                @else
                    <thead>
                        <tr>
                            <th scope="col-2" >Предмет</th>
                            <th scope="col-9">Оценки</th>
                            <th scope="col-1" style="width:10%;">Ср. балл</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subjects as $subject)
                            @php
                                $full_select = 0;
                                $average_score = 0;
                            @endphp
                            <tr>
                                <th scope="col-md-3 col-lg-2">{{ $subject->name }}</th>
                                <td>
                                    @foreach($marks as $mark)
                                        @if($subject->id == $mark->subject_id)
                                            <select class="marks" disabled title="{{'Добавлена: '.$mark->created_at.'; Обновлена: '.$mark->updated_at}}" >
                                                <option selected>{{$mark->mark}}</option>
                                            </select>
                                            @php
                                                $full_select++;
                                                $average_score += $mark->mark
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
{{--    </main>--}}
@endsection


@section('scripts')
    <script src="/js/user-marks.js"></script>
    <script>
        function getInfo(selectObject){
            console.log(selectObject.value);
        }
    </script>
@endsection
