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

    <div class="container">
        <div class="bd-heading sticky-xl-top align-self-start mt-3 mb-3 mt-xl-0 mb-xl-2 mb-2">
            <div class="row border-bottom justify-content-between">
                <div class="col-6">
                    <h3 class="pb-2 ">Оценки</h3>
                </div>
                @if(Auth::user()->user_type == 'Учитель')
                    <div class="col-6">
                        <form class="row g-3 d-print-inline" method="POST" action="{{ route('user.marks') }}">
                            @csrf
                            <div class="col-auto">
                                <label for="class_name" class="col-form-label">Класс:&nbsp;</label>
                            </div>
                            <div class="col-auto">
                                <select class="form-control" id="class_id" name="class_id" width="50px" required onChange="this.form.submit()">
                                    @foreach($classes_info as $info)
                                        <option value="{{ $info->class_id }}" {{ $info->class_id == $current_class_id ? 'selected' : '' }}>{{ $info->class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-auto">
                                <label for="class_name" class="col-form-label">Предмет:&nbsp;</label>
                            </div>
                            <div class="col-auto">
                                <select class="form-control" id="subject_id" name="subject_id" width="100px" required onChange="this.form.submit()">
                                    @foreach($subjects_info ?? '' as $info)
                                        <option value="{{ $info->subject_id }}" {{ $info->subject_id == $current_subject_id ? 'selected' : '' }}>{{ $info->subject->name }}</option>
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
                                @foreach($marks_info as $info)
                                    @if($pupil->id == $info->pupil_id)
                                        <form method="POST" action="{{ route('user.change-mark') }}" style="display: inherit; padding: 2px;">
                                            @csrf
                                            <input type="hidden" value="{{$info->id}}" name="id" />
                                            <input type="hidden" value="{{$pupil->id}}" name="pupil_id" />
                                            <select name="mark" class="marks" title="{{'Добавлена: '.$info->created_at.'; Обновлена: '.$info->created_at}}" id='{{$info->id}}' data-pupil_id='{{$info->pupil_id}}' data-subject_id='{{$info->subject_id}}'  onChange="this.form.submit()">
                                                <option></option>
                                                <option {{($info->mark==1) ? 'selected' : ''}}>1</option>
                                                <option {{($info->mark==2) ? 'selected' : ''}}>2</option>
                                                <option {{($info->mark==3) ? 'selected' : ''}}>3</option>
                                                <option {{($info->mark==4) ? 'selected' : ''}}>4</option>
                                                <option {{($info->mark==5) ? 'selected' : ''}}>5</option>
                                            </select>
                                        </form>
                                        @php
                                            $average_score += $info->mark;
                                            $full_select++;
                                        @endphp
                                    @endif
                                @endforeach
                                @for($m = 0; $m < 33 - $full_select; $m++)
                                    <form method="POST" action="{{ route('user.add-mark') }}" style="display: inherit; padding: 2px;">
                                        @csrf
                                        <input type="hidden" value="{{$pupil->id}}" name="pupil_id" />
                                        <select data-pupil_id='{{$pupil->id}}' name="mark" data-subject_id='{{$current_subject_id}}' class="marks" onChange="this.form.submit()">
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
                        @foreach($subjects_info as $subject_info)
                            @php
                                $full_select = 0;
                                $average_score = 0;
                            @endphp
                            <tr>
                                <th scope="col-md-3 col-lg-2">{{ $subject_info->subject->name }}</th>
                                <td>
                                    @foreach($marks_info as $info)
                                        @if($subject_info->subject_id == $info->subject_id)
                                            <select class="marks" disabled title="{{'Добавлена: '.$info->created_at.'; Обновлена: '.$info->created_at}}" >
                                                <option selected>{{$info->mark}}</option>
                                            </select>
                                            @php
                                                $full_select++;
                                                $average_score += $info->mark
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
