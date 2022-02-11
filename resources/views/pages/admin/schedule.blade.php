@extends('layouts.user-layout')

@section('description', 'Admin create new Shedule')

@section('title-block', 'Create Shedule')

@section('styles')
    <link rel="stylesheet" href="/css/admin/schedule.css">
@endsection

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
        @include('flash-message')
        <div class="bd-heading align-self-start mt-3 mb-3 mt-xl-0 mb-xl-2">
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
                            <form method="POST" action="{{ route('set-page') }}">
                                @csrf
                                <input type="hidden" name="current_page" value="schedule">
                                <select class="form-control" id="class_id" name="current_subpage" required onChange="this.form.submit()">
                                    @foreach($classes ?? '' as $class)
                                        <option value="{{ $class->id }}" {{ $class->id == Session::get('current_subpage') ? 'selected' : '' }}>{{ $class->name }}</option>
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
            @php
                $i = 0;//для заполнения пустых уроков
            @endphp
            <div class="col-lg-6 order-lg-{{ $day->diary_number }} px-md-4">
                <h4 class="d-flex justify-content-between align-items-center" >
                    <span>{{ $day->name }}</span>
                    <span class="badge bg-dark rounded-pill">
                        {{ count($schedule->where('day_number', $day->number)) }}
                    </span>
                </h4>
                <ul class="list-group mb-3">
                    <input type="hidden" class="day_number" name="day_number" value="{{ $day->number }} ">
                    @foreach($schedule->where('day_number', $day->number) as $info)
                        @php
                            $i++;
                        @endphp
                        @if ($i != $info->lesson_number)
                            @for ($j = 0; $j < $info->lesson_number - $i; $j++)
                                <li class="list-group-item lh-sm">
                                    <h6 class="mb-3 default">{{ $i + $j}}. -</h6>
                                    <h6 class="mb-3 add">{{ $i + $j}}.
                                        <select name="subject_id" class="subject_id">
                                            @foreach($subjects as $subject)
                                                <option value="{{ $subject->id }}">
                                                    {{ $subject->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </h6>
                                    <input type="hidden" name="lesson_number" class="lesson_number" value="{{ $i + $j}}">
                                    <div class="d-flex justify-content-between mb-3">
                                        <span class="text-muted mt-2">
                                            <p>{{$lessons[$i + $j - 1]}}</p>
                                            <p class="add m-0 add">каб.
                                                <select name="cabinet_id" class="cabinet_id">
                                                    @foreach($cabinets as $cabinet)
                                                        <option value="{{ $cabinet->id }}">
                                                            {{ $cabinet->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </p>
                                        </span>
                                        <span class="bg-success rounded-pill text-center m-auto me-0 addButton default">{{--  Кнопка "+" - для добавления информации в расписание--}}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                            </svg>
                                        </span>
                                        <div class="row add me-0 m-auto">
                                            {{--Кнопка "x" - для отмены редактирования информации--}}
                                            <span class="p-0 cancelButton">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="grey" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                                </svg>
                                            </span>
                                            {{--Кнопка "ok" - для подтверждения редактирования информации--}}
                                            <span class="p-0 confirmButton add">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="green" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-start text-muted">
                                        <span class="text-start pb-2 add">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-dash-circle deleteTeacher" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                            </svg>
                                            <select name="teacher_id" class="teacher_id">
                                                @foreach($teachers as $teacher)
                                                    <option value="{{ $teacher->user_id }}">
                                                        {{ $teacher->surname.' '.$teacher->name.' '.$teacher->patronymic }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <br>
                                        </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-plus-circle addTeacher add" viewBox="0 0 16 16">{{--  Кнопка "+" - для добавлеия учителя в расписание--}}
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg>
                                    </div>
                                </li>
                            @endfor
                            @php
                                $i = $info->lesson_number;
                            @endphp
                        @endif
                        <li class="list-group-item lh-sm">
                            <h6 class="mb-3 default">{{ $info->lesson_number.'. '.$info->subject->name }}</h6>
                            <h6 class="mb-3 edit">{{ $info->lesson_number.'.' }}
                                <select name="subject_id" class="subject_id">
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ $subject->id == $info->subject_id ? 'selected' : '' }}>
                                            {{ $subject->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </h6>
                            <input type="hidden" name="schedule_id" class="schedule_id" value="{{$info->id}}">
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted mt-2 time">
                                    <p>{{ substr($info->lesson->start_time, 0, -3).'-'.substr($info->lesson->end_time, 0, -3) }}</p>
                                    <p class="default m-0">каб. {{ $info->cabinet->name }}</p>
                                    <p class="edit m-0">каб.
                                        <select name="cabinet_id" class="cabinet_id">
                                            @foreach($cabinets as $cabinet)
                                                <option value="{{ $cabinet->id }}" {{ $cabinet->id == $info->cabinet_id ? 'selected' : '' }}>
                                                    {{ $cabinet->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </p>
                                    <input type="hidden" class="cabinet_id" value="{{$info->cabinet_id}}">
                                </span>
                                <div class="row default me-0 m-auto">
                                    {{--Кнопка "редактировать" - для редактирования информации в расписании--}}
                                    <span class="p-0 editButton">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="grey" class="bi bi-pencil-square" viewBox="0 0 19 14" style="background: #f8f9fa; border-radius: 20px">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        </svg>
                                    </span>
                                    {{--Кнопка "удалить" - для удаления информации в расписании--}}
                                    <span class="p-0 deleteButton">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-trash3" viewBox="0 0 16 16" style="background: #dc3545; border-radius: 20px; padding: 5px">
                                            <path fill-rule="evenodd" d="M6.5 1a.5.5 0 0 0-.5.5v1h4v-1a.5.5 0 0 0-.5-.5h-3ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1H3.042l.846 10.58a1 1 0 0 0 .997.92h6.23a1 1 0 0 0 .997-.92l.846-10.58Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                        </svg>
                                    </span>
                                </div>
                                <div class="row edit me-0 m-auto">
                                    {{--Кнопка "x" - для отмены редактирования информации--}}
                                    <span class="p-0 cancelButton">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="grey" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                        </svg>
                                    </span>
                                    {{--Кнопка "ok" - для подтверждения редактирования информации--}}
                                    <span class="p-0 confirmButton edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="green" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="text-start text-muted">
                                @if(count($info->teacher) == 0)
                                    <span class="text-danger default">Преподаватель: -</span>
                                    <input type="hidden" class="teacher" value="">
                                @else
                                    @foreach($info->teacher as $teacher_info)
                                        <span class="text-start pb-2 default">
                                            {{ '/ '.$teacher_info->user->surname.' '.$teacher_info->user->name.' '.$teacher_info->user->patronymic.'/' }}
                                            <br>
                                        </span>

                                      {{--  Кнопка "-" - для удаления учителя из расписания--}}
                                        <span class="text-start pb-2 edit">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-dash-circle deleteTeacher" viewBox="0 0 16 16">
                                              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                              <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                          </svg>
                                          <select name="teacher_id" class="teacher_id">
                                              @foreach($teachers as $teacher)
                                                  <option value="{{ $teacher->user_id }}" {{ $teacher->user_id == $teacher_info->id ? 'selected' : '' }}>
                                                      {{ $teacher->surname.' '.$teacher->name.' '.$teacher->patronymic }}
                                                  </option>
                                              @endforeach
                                          </select>
                                          <br>
                                        </span>
                                    @endforeach
                                @endif
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-plus-circle edit addTeacher" viewBox="0 0 16 16">{{--  Кнопка "+" - для добавлеия учителя в расписание--}}
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </div>
                        </li>
                    @endforeach
                    @for ($j = 0; $j < 7 - $i; $j++)
                        <li class="list-group-item lh-sm">
                            <h6 class="mb-3 default">{{ $i + $j + 1}}. -</h6>
                            <h6 class="mb-3 add">{{ $i + $j + 1}}.
                                <select name="subject_id" class="subject_id">
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">
                                            {{ $subject->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </h6>
                            <input type="hidden" name="lesson_number" class="lesson_number" value="{{ $i + $j + 1}}">
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted mt-2">
                                    <p>{{$lessons[$i + $j]}}</p>
                                    <p class="add m-0 add">каб.
                                        <select name="cabinet_id" class="cabinet_id">
                                            @foreach($cabinets as $cabinet)
                                                <option value="{{ $cabinet->id }}">
                                                    {{ $cabinet->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </p>
                                </span>
                                <span class="bg-success rounded-pill text-center m-auto me-0 addButton default">{{--  Кнопка "+" - для добавления информации в расписание--}}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                </span>
                                <div class="row add me-0 m-auto">
                                    {{--Кнопка "x" - для отмены редактирования информации--}}
                                    <span class="p-0 cancelButton">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="grey" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                            </svg>
                                        </span>
                                    {{--Кнопка "ok" - для подтверждения редактирования информации--}}
                                    <span class="p-0 confirmButton add">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="green" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                            </svg>
                                        </span>
                                </div>
                            </div>
                            <div class="text-start text-muted">
                                <span class="text-start pb-2 add">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-dash-circle deleteTeacher" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                    </svg>
                                    <select name="teacher_id" class="teacher_id">
                                        @foreach($teachers as $teacher)
                                            <option value="{{ $teacher->user_id }}">
                                                {{ $teacher->surname.' '.$teacher->name.' '.$teacher->patronymic }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <br>
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-plus-circle addTeacher add" viewBox="0 0 16 16">{{--  Кнопка "+" - для добавлеия учителя в расписание--}}
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </div>
                        </li>
                    @endfor
                </ul>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script>
        function ajax(url, data) {
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    console.log('sending...');
                },
                success: function(result) {
                    console.log(JSON.stringify(result));
                    location.reload()
                },
                error: function(jqXHR, testStatus, error) {
                    $('main').prepend(
                        `<div class=" alert alert-danger alert-dismissible" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <strong>${"Ошибка <strong>"+ jqXHR.status + "</strong> - " + error}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`
                    );
                }
            })
        }
        let teachers = {!! json_encode($teachers->toArray(), JSON_HEX_TAG) !!};//для добавления списка учителей

        //кнопка "редактировать"
        $(document).on('click', '.editButton', function(event) {
            //скрываем все сеансы редактирования при наличии
            $('.add').hide();
            $('.edit').hide();
            $('.default').show();
            //открываем сеанс редактирования для кликнутой записи
            $($(this).parent().parent().parent()).find('.default').hide();
            $($(this).parent().parent().parent()).find('.edit').show();
        });
        $(document).on('click', '.cancelButton', function(event) {
            console.log($(this).parent().parent().parent());
            //закрываем сеанс редактирования для кликнутой записи
            $($(this).parent().parent().parent()).find('.add').hide();
            $($(this).parent().parent().parent()).find('.edit').hide();
            $($(this).parent().parent().parent()).find('.default').show();
        });

        //кнопка "+" для добавления учителя в расписание в режиме редактирования/добавления информации
        $(document).on('click', '.addTeacher', function(event) {
            let existedTeachers = [];
            $(this).parent().find('select').each(function( index ) {
                existedTeachers.push($( this ).val());
                console.log( index + ": " + $( this ).val() );
            });//находим уже добавленных пользователей
            console.log(existedTeachers);
            $(this).before(
                `<span class="text-start pb-2 edit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-dash-circle deleteTeacher" viewBox="0 0 16 16">
                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                      <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                    </svg>
                    <select name="teacher_id" class="teacher_id">
                        ${teachers
                            .filter( (el) => {
                                return !existedTeachers.includes(el['user_id'].toString());
                            })//убираем ранее добавленных учителей
                            .map( (teacher) => {
                            return `<option value="${teacher['user_id']}">${teacher['surname'] + ' ' + teacher['name'] + ' ' + teacher['patronymic']}</option>`;
                            })//выводим options
                        }
                    </select>
                    <br>
                </span>`
            );
            $($(this).parent().parent()).find('.edit').show();//делаем добавленные учителей видимыми
        });

        //кнопка "-" для удаления учителя из расписания в режиме редактирования/добавления информации
        $(document).on('click', '.deleteTeacher', function(event) {
            //удаляем блок
            $(this).parent().remove();
        });

        //кнопка подтверждения добавления/редактирования записи
        $(document).on('click', '.confirmButton', function(event) {
            let li = $(this).parent().parent().parent(); //кликнутый блок
            let url, data;
            if ($(this).hasClass( "add" )){
                url = '{{route("admin.create-schedule")}}'
                data = {
                    'day_number': li.parent().find('input.day_number').val(),
                    'lesson_number': li.find('input.lesson_number').val(),
                    'subject_id': li.find('select.subject_id').val(),
                    'cabinet_id': li.find('select.cabinet_id').val(),
                    'teachers': li.find('select.teacher_id').map(function () {
                        return $(this).val();
                    }).get()
                }
            } else if ($(this).hasClass( "edit" )){
                url = '{{route("admin.edit-schedule")}}'
                data = {
                    'schedule_id': li.find('input.schedule_id').val(),
                    'subject_id': li.find('select.subject_id').val(),
                    'cabinet_id': li.find('select.cabinet_id').val(),
                    'teachers': li.find('select.teacher_id').map(function () {
                        return $(this).val();
                    }).get()
                };
            } else {
                return false;
            }

            ajax(url, data);
        });

        //кнопка удалить
        $(document).on('click', '.deleteButton', function(event) {
            let li = $(this).parent().parent().parent(); //кликнутый блок
            let schedule_id = li.find('input.schedule_id').val();
            console.log(schedule_id);
            ajax(
                '{{route("admin.delete-schedule")}}',
                {
                'schedule_id': schedule_id
                }
            );
        });

        //кнопка добавления данных в расписание
        $(document).on('click', '.addButton', function(event) {

            $('.add').hide();
            $('.edit').hide();
            $('.default').show();

            $($(this).parent().parent()).find('.default').hide();
            $($(this).parent().parent()).find('.add').show();
        });
    </script>
@endsection
