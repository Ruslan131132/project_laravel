@extends('layouts.user-layout')

@section('description', 'Admin can create new Class')

@section('title-block', 'Create Class')

@section('styles')
    <link rel="stylesheet" href="/css/admin/admin.css">
    <style>
        @media screen and (max-device-width: 540px) {
            div.nav-tabs{
                justify-content: space-between;
            }
            div.nav-tabs form{
                flex-basis: 100%;
                height: 50px;
            }
            div.nav-tabs form span{
                height: 50px;
            }
        }
    </style>

@endsection

@section('li-blocks')
    @include('layouts.li', ['value' => 'Главная', 'status' => '', 'icon' => '/svg/home.svg', 'route' => 'admin.main'])
    @include('layouts.li', ['value' => 'Пользователи', 'status' => '', 'icon' => '/svg/users.svg', 'route' => 'admin.users'])
    @include('layouts.li', ['value' => 'Классы', 'status' => 'active', 'icon' => '/svg/class.svg', 'route' => 'admin.classes'])
    @include('layouts.li', ['value' => 'Предметы', 'status' => '', 'icon' => '/svg/book.svg', 'route' => 'admin.subjects'])
    @include('layouts.li', ['value' => 'Занятость', 'status' => '', 'icon' => '/svg/employment.svg', 'route' => 'admin.employment'])
    @include('layouts.li', ['value' => 'Расписание', 'status' => '', 'icon' => '/svg/schedule.svg', 'route' => 'admin.schedule'])
@endsection


@section('content')
    <div class="row">
        @include('flash-message')
        <div class="bd-heading align-self-start mt-3 mb-3 mt-xl-0 mb-xl-2">
            <h3 class="pb-2 border-bottom text-center text-lg-start">Записи о классах и курсах</h3>
        </div>
        <div class="nav nav-tabs" id="nav-tab" role="tablist" style="padding-right: 0">
            <button class="nav-link {{ Session::get('current_subpage') == 'Classes' ? 'active' : ''}}" id="nav-classes-tab" data-type="Classes" data-bs-toggle="tab" data-bs-target="#nav-classes" type="button" role="tab" aria-controls="nav-classes" aria-selected="{{ Session::get('current_subpage') == 'Classes' }}">Классы</button>
            <button class="nav-link {{ Session::get('current_subpage') == 'Courses' ? 'active' : ''}}" id="nav-courses-tab" data-type="Courses" data-bs-toggle="tab" data-bs-target="#nav-courses" type="button" role="tab" aria-controls="nav-courses" aria-selected="{{ Session::get('current_subpage') == 'Courses' }}">Курсы</button>
            <button class="nav-link {{ Session::get('current_subpage') == 'Add' ? 'active' : ''}}" type="button" data-type="Add" data-bs-toggle="tab" data-bs-target="#nav-add" type="button" role="tab" aria-controls="nav-add" aria-selected="{{ Session::get('current_subpage') == 'Add' }}">Добавить</button>
        </div>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade {{ Session::get('current_subpage') == 'Classes' ? 'show active' : ''}}" id="nav-classes" role="tabpanel" aria-labelledby="nav-classes-tab">
                <table class="table table-hover table-responsive align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Класс</th>
                            <th scope="col" class="text-center">Руководитель</th>
                            <th scope="col" class="action text-end">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($classes as $class)
                        <tr>
                            <th scope="row">{{ $class->name }}</th>
                            <td class="text-center">{{ $class->teacher->surname." ".$class->teacher->name." ".$class->teacher->patronymic }}</td>
                            <td class="text-end">
                                {{--Кнопка "редактировать" - для редактирования информации в расписании--}}
                                <span class="p-0 editButton" data-class_id="{{ $class->id }}" data-teacher_id="{{ $class->teacher->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="grey" class="bi bi-pencil" viewBox="0 0 19 14" style="background: #f8f9fa; border-radius: 20px">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    </svg>
                                </span>
                                {{--Кнопка "удалить" - для удаления информации в расписании--}}
                                <span class="p-0 deleteButton" data-class_name="{{ $class->name }}" data-class_id="{{ $class->id }}" data-teacher_id="{{ $class->teacher->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-trash" viewBox="0 0 16 16" style="background: #dc3545; border-radius: 20px; padding: 5px">
                                        <path fill-rule="evenodd" d="M6.5 1a.5.5 0 0 0-.5.5v1h4v-1a.5.5 0 0 0-.5-.5h-3ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1H3.042l.846 10.58a1 1 0 0 0 .997.92h6.23a1 1 0 0 0 .997-.92l.846-10.58Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                    </svg>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade {{ Session::get('current_subpage') == 'Courses' ? 'show active' : ''}}" id="nav-courses" role="tabpanel" aria-labelledby="nav-courses-tab">
                <table class="table table-hover table-responsive align-middle">
                    <thead class="table-light">
                    <tr>
                        <th scope="col">Курс</th>
                        <th scope="col">Руководитель</th>
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($courses as $course)
                        <tr>
                            <th scope="row">
                                <p style="margin: 0">{{ $course->name }}</p>
                                <span id="{{ $course->id }}" class="form-text">
                                    {{ $course->description }}
                                </span>
                                <input id="course_price" type="hidden" value="{{ $course->price }}">
                                <input id="course_training_period" type="hidden" value="{{ $course->training_period }}">
                            </th>
                            <td>{{ $course->teacher->surname." ".$course->teacher->name." ".$course->teacher->patronymic }}</td>
                            <td class="text-end">
                                {{--Кнопка "редактировать"--}}
                                <span class="p-0 editButton" data-course_id="{{ $course->id }}" data-teacher_id="{{ $course->teacher->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="grey" class="bi bi-pencil" viewBox="0 0 19 14" style="background: #f8f9fa; border-radius: 20px">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    </svg>
                                </span>
                                {{--Кнопка "удалить"--}}
                                <span class="p-0 deleteButton" data-course_name="{{ $course->name }}" data-course_id="{{ $course->id }}" data-teacher_id="{{ $course->teacher->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-trash" viewBox="0 0 16 16" style="background: #dc3545; border-radius: 20px; padding: 5px">
                                        <path fill-rule="evenodd" d="M6.5 1a.5.5 0 0 0-.5.5v1h4v-1a.5.5 0 0 0-.5-.5h-3ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1H3.042l.846 10.58a1 1 0 0 0 .997.92h6.23a1 1 0 0 0 .997-.92l.846-10.58Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                    </svg>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade {{ Session::get('current_subpage') == 'Add' ? 'show active' : ''}}" id="nav-add" role="tabpanel" aria-labelledby="nav-classes-tab">
                <form class="form" method="POST" action="{{ route('admin.create-class') }}">
                    @csrf
                    <div class="form-group">
                        <div class="row mb-3">
                            <div class="col-sm-5 col-lg-2 themed-grid-col">
                                <label for="type" class="form-label"> Тип</label>
                                <select class="form-select" name="type" id="type">
                                    <option selected value="Class">Класс</option>
                                    <option value="Course">Курс</option>
                                </select>
                            </div>
                            <div class="col-sm-7 col-lg-4 themed-grid-col">
                                <label for="class_name" class="form-label" id="labelClassName">Класс</label>
                                <input type="text" name="class_name" id="class_name" class="form-control" placeholder="Название" required autofocus />
                            </div>
                            <div class="col-md-8 col-lg-6 themed-grid-col">
                                <label for="select" class="form-label">Руководитель</label>
                                <select class="form-select" name="teacher_id" id="teacher_id">
                                    @foreach($teachers_without_class as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->surname." ".$teacher->name." ".$teacher->patronymic }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3" id="courseRow" style="display: none">
                            <div class="col-sm-2 themed-grid-col pe-2">
                                <label for="select" class="form-label">Стоимость(₽)</label>
                                <input class="form-control" type="number" value="" name="price" id="price">
                            </div>
                            <div class="col-sm-2 col-md-3 col-lg-10 themed-grid-col">
                                <label for="email" class="form-label">Изображение</label>
                                <input type="hidden" name="img" id="user_img" value="">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuAvatar" data-bs-toggle="dropdown" aria-expanded="false" style="border: 1px solid #ced4da; padding: 3px;">
                                        <img src="" width="30" height="30" />
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonAvatar" style="min-width: 56px;">
                                        <li style="padding: 4px 0px; cursor: pointer"><img src="" width="30" height="30" /></li>
                                        @foreach(Storage::disk('public')->allFiles('img/courses') as $img)
                                            <li style="padding: 4px 0px; cursor: pointer"><img src="/storage/{{ $img }}" width="30" height="30" /></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-8 col-md-7 col-lg-6 themed-grid-col">
                                <label for="select" class="form-label">Продолжительность</label>
                                <input class="form-control" type="text" value="" name="training_period" id="training_period">
                            </div>
                            <div class="col-md-12 col-lg-6 themed-grid-col">
                                <label for="input" class="form-label">Описание</label>
                                <textarea class="form-control" value="" name="description" id="description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col text-center text-md-start">
                        <button class="btn btn-lg btn-success btn-block" type="submit">
                            Добавить
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Модальное окно для редактирования записи -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Редактирование</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="editBody">
                        <div id="loader" class="text-center">
                            <div class="spinner-border m-4" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <br />
                            <strong>Загрузка...</strong>
                        </div>
                        <form method="POST" action="{{ route('admin.edit-class') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-auto">
                                    <label for="input" class="form-label" id="classNameLabel">Класс</label>
                                    <input class="form-control" type="text" disabled value="" name="class_name" id="class_name">
                                    <input type="hidden" value="" name="class_id" id="class_id">
                                </div>
                                <div class="col-auto">
                                    <label for="select" class="form-label">Руководитель</label>
                                    <select class="form-select" name="teacher_id" id="teacher_id">
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->surname." ".$teacher->name." ".$teacher->patronymic }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 mt-2" id="course_modal">
                                <div class="col-12">
                                    <label for="input" class="form-label">Описание</label>
                                    <textarea class="form-control" value="" name="description" id="description"></textarea>
                                </div>
                                <div class="col-12">
                                    <label for="select" class="form-label">Продолжительность</label>
                                    <input class="form-control" type="text" value="" name="training_period" id="training_period">
                                </div>
                                <div class="col-4">
                                    <label for="select" class="form-label">Стоимость(₽)</label>
                                    <input class="form-control" type="text" value="" name="price" id="price">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="button" id="saveEdit" class="btn btn-primary" onclick="$($(this).parent().parent()).find('form').submit()">Сохранить изменения</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Модальное окно для удаления записи -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Удаление</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center" id="deleteBody">
                        <p class="text-secondary m-0"></p>
                        <form method="POST" action="{{ route('admin.delete-class') }}">
                            @csrf
                            <input type="hidden" id="class_id" name="class_id">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="button" id="saveEdit" class="btn btn-danger" onclick="$($(this).parent().parent()).find('form').submit()">Удалить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let teachers = {!! json_encode($teachers->toArray(), JSON_HEX_TAG) !!};
        let teachers_without_class = {!! json_encode($teachers_without_class->toArray(), JSON_HEX_TAG) !!};// учителя, которые не являются классными руководителями

        $('div#nav-add select#type').on('change', function (e){
            console.log($(this).val());
            let data;
            if (this.value == "Class"){
                $('div#courseRow').hide();
                data = teachers_without_class
            } else if (this.value == "Course"){
                $('div#courseRow').show();
                data = teachers
            }
            $(this).parent().parent().find('select#teacher_id').html(data.map(function(elem) {
                return `<option value="${elem['id']}">${elem['surname']} ${elem['name']} ${elem['patronymic']}</option>`;
            }))
        })

        //функционал выпадающего списка аватаров пользователей
        $('ul.dropdown-menu li').on('click', function (e){
            $($(this).parent().parent().parent()).find('input').val($(this).find('img').attr('src'));
            console.log($($(this).parent().parent().parent()).find('input').val());
            $($(this).parent().parent()).find('button').html($(this).html())
        })

        //Текущая подстраница
        let current_page = $('button.nav-link.active').attr('data-type');;
        $(document).on('click', 'button.nav-link', function (e) {
            current_page = $(this).attr('data-type');
            //отправляем информацию о текущей странице на сервер
            $.ajax({
                url: '{{route("set-page")}}',
                type: 'POST',
                data: {
                    'current_page': 'classes',
                    'current_subpage': current_page
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        $(document).on('click', '.editButton', function(event) {
            $('#loader').hide();
            $('#editModal').modal("show");
            $('#editModal div#course_modal').hide();
            console.log($(this).parent().parent().find('th').html());
            let data_type = 'Класс';
            let class_id = $(this).attr('data-class_id');
            let teacher_id = $(this).attr('data-teacher_id');
            let class_name = $(this).parent().parent().find('th').html();
            let teacher_name = $($(this).parent().parent().find('td')[0]).html();
            console.log(teacher_name);
            let teachers_array = teachers_without_class;
            //Если мы находимся на странице курсов
            if(class_id === undefined){
                $('#editModal div#course_modal').show();
                data_type = 'Курс';
                class_id = $(this).attr('data-course_id');
                class_name = $(this).parent().parent().find('th p').html();
                teachers_array = teachers;

                //заполнение данных о курсе
                $('#editModal div#course_modal').find('textarea#description').val($(this).parent().parent().find('th span').html().trim());
                $('#editModal div#course_modal').find('input#training_period').val($(this).parent().parent().find('th input#course_training_period').val());
                $('#editModal div#course_modal').find('input#price').val($(this).parent().parent().find('th input#course_price').val())

            }
            //заполнение тела модального окна
            $('#editBody label#classNameLabel').html(data_type);
            $('#editBody input#class_id').val(class_id);
            $('#editBody input#class_name').val(class_name);
            $('#editModal select#teacher_id').html(teachers_array.map(function(elem) {
                return `<option ${elem['id'] == teacher_id ? 'selected' : '' } value="${elem['id']}">${elem['surname']} ${elem['name']} ${elem['patronymic']}</option>`;
            })).prepend(data_type == 'Класс' ? `<option selected value="${teacher_id}">${teacher_name}</option>` : "");
        });

        // Модальное окно удаления
        $(document).on('click', '.deleteButton', function(event) {
            $('#deleteModal').modal("show");
            let class_id = $(this).attr('data-class_id') !== undefined ? $(this).attr('data-class_id') : $(this).attr('data-course_id');
            let class_name = $(this).attr('data-class_name') !== undefined ? $(this).attr('data-class_name') : $(this).attr('data-course_name');
            $('#deleteBody input#class_id').val(class_id);
            $('#deleteBody p').html(`Удалить ${$(this).attr('data-class_id') !== undefined ? 'класс' : 'курс' } <strong>${class_name}</strong>(ID: ${class_id}) из системы ?`);
        });
    </script>
@endsection
