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
        <div class="bd-heading align-self-start mt-3 mb-3 mt-xl-0 mb-xl-2">
            <h3 class="pb-2 border-bottom">
                Занятость преподавателей
                <button class="btn text-primary float-end" id="create-employment" data-type="add" data-bs-toggle="modal" data-bs-target="#addModal" type="button">Добавить</button>
            </h3>
        </div>
        <table class="table table-hover table-responsive align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col">Преподаватель</th>
                    <th scope="col">Дисциплина</th>
                    <th scope="col" class="text-center">Класс</th>
                    <th scope="col" class="text-center">Действия</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($employments as $employment)
                <tr>
                    <th scope="row">{{ $employment->teacher->surname." ".$employment->teacher->name." ".$employment->teacher->patronymic }}</th>
                    <td class="m-auto">{{ $employment->subject->name }}</td>
                    <td class="text-center">{{ $employment->class->name }}</td>
                    <td class="text-center">
                        <mat-icon _ngcontent-serverapp-c191="" role="img" class="mat-icon notranslate material-icons mat-icon-no-color deleteButton" style="color: #DB2828;" aria-hidden="true" data-mat-icon-type="font" data-employment_id="{{ $employment->id }}">delete_forever</mat-icon>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Модальное окно для удаления записи -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Удаление</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center" id="deleteBody">
                        <p class="text-secondary m-0"></p>
                        <form method="POST" action="{{ route('admin.delete-employment') }}">
                            @csrf
                            <input type="hidden" id="employment_id" name="employment_id">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="button" id="saveEdit" class="btn btn-danger" onclick="$($(this).parent().parent()).find('form').submit()">Удалить</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Модальное окно для добавления записи -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Добавление занятости</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin.create-employment') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-auto">
                                    <label for="select" class="form-label">Руководитель</label>
                                    <select class="form-select" name="teacher_id" id="teacher_id">
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->surname." ".$teacher->name." ".$teacher->patronymic }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <div class="row">
                                        <div class="col-8">
                                            <label for="user_type">Дисциплина</label>
                                            <select class="form-control" name="subject_id" id="subject_id" required>
                                                @foreach($subjects as $subject)
                                                    <option value="{{$subject->id}}">{{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label for="Class_name">Класс</label>
                                            <select class="form-control" id="class_id" name="class_id" required>
                                                @foreach($classes as $class)
                                                    <option value="{{$class->id}}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="button" id="saveEdit" class="btn btn-success" onclick="$($(this).parent().parent()).find('form').submit()">Добавить</button>
                    </div>
                </div>
            </div>
        </div>

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
