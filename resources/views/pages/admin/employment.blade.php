@extends('layouts.user-layout')

@section('description', 'Admin create new Employment')

@section('title-block', 'Create Employment')

@section('li-blocks')
    @include('layouts.li', ['value' => 'Главная', 'status' => '', 'icon' => '/svg/home.svg', 'route' => 'admin.main'])
    @include('layouts.li', ['value' => 'Пользователи', 'status' => '', 'icon' => '/svg/users.svg', 'route' => 'admin.users'])
    @include('layouts.li', ['value' => 'Классы', 'status' => '', 'icon' => '/svg/class.svg', 'route' => 'admin.classes'])
    @include('layouts.li', ['value' => 'Предметы', 'status' => '', 'icon' => '/svg/book.svg', 'route' => 'admin.subjects'])
    @include('layouts.li', ['value' => 'Занятость', 'status' => 'active', 'icon' => '/svg/employment.svg', 'route' => 'admin.employment'])
    @include('layouts.li', ['value' => 'Расписание', 'status' => '', 'icon' => '/svg/schedule.svg', 'route' => 'admin.schedule'])
@endsection


@section('content')
    <div class="row">
        @include('flash-message')
        <div class="bd-heading  align-self-start mt-3 mb-3 mt-xl-0 mb-xl-2 mb-2">
            <div class="row border-bottom justify-content-between">
                <div class="col-lg-6 text-center text-lg-start">
                    <h3 class="pb-2 ">Занятость преподавателя</h3>
                </div>
                <div class="col-lg-6">
                    <form class="mb-2 mx-auto d-flex justify-content-center justify-content-lg-end " method="POST" action="{{ route('set-page') }}">
                        @csrf
                        <input type="hidden" name="current_page" value="employment">
                        <select class="form-select" name="current_subpage" id="teacher_id" onChange="this.form.submit()" style="width:auto; margin: 0">
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ $teacher->id == Session::get('current_subpage') ? 'selected' : '' }}>{{ $teacher->surname." ".$teacher->name." ".$teacher->patronymic }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
        </div>
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
                                    {{ 'Класс: '.$info->class->name }}
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

@section('scripts')

    <script>

        // Модальное окно удаления
        $(document).on('click', '.deleteButton', function(event) {
            console.log('Клик');
            $('#deleteModal').modal("show");
            $('#deleteBody input#employment_id').val($(this).attr('data-employment_id'));
            $('#deleteBody p').html(`Удалить занятость(ID: ${$(this).attr('data-employment_id')}) из системы ?`);
        });
    </script>
@endsection
