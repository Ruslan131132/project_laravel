@extends('layouts.user-layout')

@section('description', 'Admin Panel')

@section('title-block', 'Users')

@section('styles')
    <link rel="stylesheet" href="/css/admin/users.css">
@endsection

@section('li-blocks')
    @include('layouts.li', ['value' => 'Главная', 'status' => '', 'icon' => '/svg/home.svg', 'route' => 'admin.main'])
    @include('layouts.li', ['value' => 'Пользователи', 'status' => 'active', 'icon' => '/svg/users.svg', 'route' => 'admin.users'])
    @include('layouts.li', ['value' => 'Классы', 'status' => '', 'icon' => '/svg/class.svg', 'route' => 'admin.classes'])
    @include('layouts.li', ['value' => 'Предметы', 'status' => '', 'icon' => '/svg/book.svg', 'route' => 'admin.subjects'])
    @include('layouts.li', ['value' => 'Занятость', 'status' => '', 'icon' => '/svg/employment.svg', 'route' => 'admin.employment'])
    @include('layouts.li', ['value' => 'Расписание', 'status' => '', 'icon' => '/svg/schedule.svg', 'route' => 'admin.schedule'])
@endsection

@section('content')
    @include('flash-message')
        <div class="row">
            <div class="bd-heading  align-self-start mt-5 mb-3 mt-xl-0 mb-xl-2">
                <h3 class="pb-2 border-bottom text-center text-lg-start">Список пользователей</h3>
            </div>
            <div class="nav nav-tabs mb-3 px-0 d-flex " id="nav-tab" role="tablist" >
                <button class="nav-link {{ Session::get('current_subpage') == 'Teachers' ? 'active' : ''}}" id="nav-teachers-tab" data-type="Teachers" data-bs-toggle="tab" data-bs-target="#nav-teachers" type="button" role="tab" aria-controls="nav-teachers" aria-selected="true">Учителя</button>
                <button class="nav-link {{ Session::get('current_subpage') == 'Pupils' ? 'active' : ''}}" id="nav-pupils-tab" data-type="Pupils" data-bs-toggle="tab" data-bs-target="#nav-pupils" type="button" role="tab" aria-controls="nav-pupils" aria-selected="false">Ученики</button>
                <button class="nav-link {{ Session::get('current_subpage') == 'Add' ? 'active' : ''}}" id="nav-create-tab" data-type="Add" data-bs-toggle="tab" data-bs-target="#nav-search" type="button" role="tab" aria-controls="nav-serch" aria-selected="false">Добавить</button>
                <form class="me-0 m-auto" method="POST" action="{{ route('admin.search-user') }}">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="search-user" id="search-user" class="form-control nav-link" value="{{\Illuminate\Support\Facades\Session::get('search-input', "")}}" aria-label="">
                        <span class="input-group-text searchButton" onclick="$(this).parent().parent().submit()">
                            <img src="/img/search-icon.png" />
                        </span>
                    </div>
                </form>
            </div>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade {{ Session::get('current_subpage') == 'Teachers' ? 'show active' : ''}}" id="nav-teachers" role="tabpanel" aria-labelledby="nav-teachers-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm">
                                <table class="table manage-candidates-top mb-0">
                                    <thead>
                                        <tr>
                                            <th>Информация</th>
                                            <th class="text-center">Статус</th>
                                            <th class="action text-end">Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($teachers as $teacher)
                                        <tr class="candidates-list" data-user_id="{{$teacher->user_id}}">
                                            <td class="title">
                                                <div class="thumb">
                                                    <img class="img-fluid" src="{{$teacher->img}}" alt="{{ $teacher->surname }} {{ $teacher->name }} {{ $teacher->patronymic }}">
                                                </div>
                                                <div class="candidate-list-details">
                                                    <div class="candidate-list-info">
                                                        <div class="candidate-list-title">
                                                            <h5 class="mb-0">
                                                                {{ $teacher->surname }} {{ $teacher->name }} {{ $teacher->patronymic }}
                                                                @if(Cache::has('user-is-online-' . $teacher->user_id))
                                                                    <span class="dot dot-green"></span>
                                                                @else
                                                                    <span class="dot dot-red"></span>
                                                                @endif
                                                            </h5>

                                                        </div>
                                                        <div class="candidate-list-option">
                                                            <ul class="list-unstyled">
                                                                <li><i class="fas fa-filter pr-1"></i>Классный руководитель: {{ $teacher->teacher->class->name ?? "-"}}<br/></li>
                                                                <li><i class="fas fa-map-marker-alt pr-1"></i>ID: {{ $teacher->user_id }}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="candidate-list-favourite-time text-center">
                                                @if(Cache::has('user-is-online-' . $teacher->user_id))
                                                    <span class="text-success">Онлайн</span>
                                                @else
                                                    <span class="text-secondary">Последний раз был {{ Carbon\Carbon::parse($teacher->last_seen)->diffForHumans() }}</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                {{--Кнопка "редактировать"--}}
                                                <span class="p-0 editButton" data-user_id="{{ $teacher->user_id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="grey" class="bi bi-pencil" viewBox="0 0 19 14" style="background: #f8f9fa; border-radius: 20px">
                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    </svg>
                                                </span>
                                                {{--Кнопка "удалить"--}}
                                                <span class="p-0 deleteButton" data-user_id="{{ $teacher->user_id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-trash" viewBox="0 0 16 16" style="background: #dc3545; border-radius: 20px; padding: 5px">
                                                        <path fill-rule="evenodd" d="M6.5 1a.5.5 0 0 0-.5.5v1h4v-1a.5.5 0 0 0-.5-.5h-3ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1H3.042l.846 10.58a1 1 0 0 0 .997.92h6.23a1 1 0 0 0 .997-.92l.846-10.58Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                                    </svg>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-2 text-start">
                                {{$teachers->appends(['pupils' => $pupils->currentPage()])->links('layouts.pagination')}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade {{ Session::get('current_subpage') == 'Pupils' ? 'show active' : ''}}" id="nav-pupils" role="tabpanel" aria-labelledby="nav-pupils-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm">
                                <table class="table manage-candidates-top mb-0">
                                    <thead>
                                    <tr>
                                        <th>Информация</th>
                                        <th class="text-center">Статус</th>
                                        <th class="action text-end">Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($pupils as $pupil)
                                        <tr class="candidates-list" data-user_id="{{$pupil->id}}">
                                            <td class="title">
                                                <div class="thumb">
                                                    <img class="img-fluid" src="{{ $pupil->img }}" alt="">
                                                </div>
                                                <div class="candidate-list-details">
                                                    <div class="candidate-list-info">
                                                        <div class="candidate-list-title">
                                                            <h5 class="mb-0">
                                                                {{ $pupil->surname }} {{ $pupil->name }} {{ $pupil->patronymic }}
                                                                @if(Cache::has('user-is-online-' . $pupil->user_id))
                                                                    <span class="dot dot-green"></span>
                                                                @else
                                                                    <span class="dot dot-red"></span>
                                                                @endif
                                                            </h5>
                                                        </div>
                                                        <div class="candidate-list-option">
                                                            <ul class="list-unstyled">
                                                                <li><i class="fas fa-filter pr-1"></i>Класс: {{ $pupil->pupil->class->name}}<br/></li>
                                                                <li><i class="fas fa-map-marker-alt pr-1"></i>ID: {{ $pupil->user_id }}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="candidate-list-favourite-time text-center">
                                                @if(Cache::has('user-is-online-' . $pupil->user_id))
                                                    <span class="text-success">Онлайн</span>
                                                @else
                                                    <span class="text-secondary">Последний раз был {{ Carbon\Carbon::parse($pupil->last_seen)->diffForHumans() }}</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                {{--Кнопка "редактировать"--}}
                                                <span class="p-0 editButton" data-user_id="{{ $pupil->user_id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="grey" class="bi bi-pencil" viewBox="0 0 19 14" style="background: #f8f9fa; border-radius: 20px">
                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    </svg>
                                                </span>
                                                {{--Кнопка "удалить"--}}
                                                <span class="p-0 deleteButton" data-user_id="{{ $pupil->user_id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-trash" viewBox="0 0 16 16" style="background: #dc3545; border-radius: 20px; padding: 5px">
                                                        <path fill-rule="evenodd" d="M6.5 1a.5.5 0 0 0-.5.5v1h4v-1a.5.5 0 0 0-.5-.5h-3ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1H3.042l.846 10.58a1 1 0 0 0 .997.92h6.23a1 1 0 0 0 .997-.92l.846-10.58Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                                    </svg>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-2 text-start">
                                {{$pupils->appends(['teachers' => $teachers->currentPage()])->links('layouts.pagination')}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade {{ Session::get('current_subpage') == 'Add' ? 'show active' : ''}}" id="nav-search" role="tabpanel" aria-labelledby="nav-search-tab">
                    <div class="bd-example">
                        <form class="form" method="POST" action="{{ route('admin.create-user') }}">
                            @csrf
                            <div class="form-group">
                                <div class="row mb-3">
                                    <div class="col-md-3 themed-grid-col">
                                        <label for="user_id">ID</label>
                                        <input type="number" name="user_id" id="user_id" class="form-control" placeholder="ID" max="2147483647" min="1000000000" required autofocus />
                                    </div>
                                    <div class="col-md-3 themed-grid-col">
                                        <label for="surname">Фамилия</label>
                                        <input type="text" name="surname" class="form-control" id="surname" placeholder="Фамилия..." required />
                                    </div>
                                    <div class="col-md-3 themed-grid-col">
                                        <label for="name">Имя</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Имя..." required />
                                    </div>
                                    <div class="col-md-3 themed-grid-col">
                                        <label for="patronymic">Отчество</label>
                                        <input type="text" name="patronymic" class="form-control" id="patronymic" placeholder="Отчество..." />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mb-3">
                                    <div class="col-md-3 themed-grid-col">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="user_type">Тип</label>
                                                <select class="form-control" name="user_type" id="user_type" required>
                                                    <option selected>Ученик</option>
                                                    <option>Учитель</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label for="Class_name">Класс</label>
                                                <select class="form-control" id="class_id" name="class_id" required>
                                                    @foreach($classes as $class)
                                                        <option value="{{$class->id}}">{{ $class->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="password col-md-3 themed-grid-col">
                                        <label for="password">Пароль</label>
                                        <input id="password" type="password" class="form-control" name="password" required />
                                        <a class="password-control" onclick="return show_hide_password(this);"></a>
                                    </div>
                                    <div class="col-md-3 themed-grid-col">
                                        <label for="img">Аватар</label>
                                        <input type="hidden" name="img" id="img" value="">
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuAvatar" data-bs-toggle="dropdown" aria-expanded="false"><img src="" /> -</button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonAvatar">
                                                <li><img src="" /> -</li>
                                                <li><img src="/img/avatar/pupil-male.png" alt="Ученик"> Ученик</li>
                                                <li><img src="/img/avatar/pupil-female.png" alt="Ученица"> Ученица</li>
                                                <li><img src="/img/avatar/teacher-male.png" alt="Учитель"> Учитель</li>
                                                <li><img src="/img/avatar/teacher-female.png" alt="Учительница"> Учительница</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-3 themed-grid-col">
                                        <label for="address">Адрес</label>
                                        <input type="text" name="address" id="address" class="form-control" placeholder="Адрес..." />
                                    </div>
                                </div>
                            </div>
                            <div class="col text-center text-md-start">
                                <button class="btn btn-lg btn-success btn-block" type="submit">
                                    Зарегистрировать
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
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
                        <form method="POST" action="{{ route('admin.edit-user') }}">
                            @csrf
                            <div class="row">
                                <div class="col-4 thumb text-center">
                                    <img name="user_img" id="user_img" src="" >
                                </div>
                                <div class="col-8">
                                    <p class="text-secondary mb-3" name="user_type" id="user_type"></p>
                                    <div class="text-secondary">Класс:
                                        <select class="form-select d-inline-block w-auto" name="class_id" id="class_id" disabled>
                                            <option>-</option>
                                            @foreach($classes as $class)
                                                <option value="{{$class->id}}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <p class="text-secondary mt-3" name="user_id" id="user_id"></p>
                                    <input type="hidden" name="user_id" id="input_user_id">
                                </div>
                            </div>
                            <br/>
                            <div class="form-floating">
                                <input type="text" name="surname" id="surname" class="form-control" placeholder="Фамилия" required="" autofocus="">
                                <label for="surname">Фамилия</label>
                            </div>
                            <br>
                            <div class="form-floating">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Имя" required="" autofocus="">
                                <label for="name">Имя</label>
                            </div>
                            <br>
                            <div class="form-floating">
                                <input type="text" name="patronymic" id="patronymic" class="form-control" placeholder="Отчество" required="" autofocus="">
                                <label for="patronymic">Отчество</label>
                            </div>
                            <br>
                            <div class="row">
                                <p class="text-secondary" role="button" data-bs-toggle="collapse" data-bs-target="#collapsePassword" aria-expanded="false" aria-controls="collapsePassword">
                                    <img src="/svg/question-circle.svg">
                                    Сбросить пароль
                                </p>
                                <div class="collapse" id="collapsePassword">
                                    <div class="form-floating">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Пароль" required>
                                        <a class="password-control" onclick="return show_hide_password(this);"></a>
                                        <label for="password">Пароль</label>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="button" id="saveEdit" class="btn btn-primary" disabled onclick="$($(this).parent().parent()).find('form').submit()">Сохранить изменения</button>
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
                        <form method="POST" action="{{ route('admin.delete-user') }}">
                            @csrf
                            <input type="hidden" name="user_id" id="user_id">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="button" id="saveEdit" class="btn btn-danger" onclick="$($(this).parent().parent()).find('form').submit()">Удалить</button>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('scripts')
    <script>
        //функционал списка типов пользователей
        $('select#user_type').on('change', function (e){
            if (this.value == "Учитель"){
                $(this).parent().parent().find('select#class_id').parent().hide();
                $(this).parent().attr('class', 'col-12');
            } else if (this.value == "Ученик"){
                $(this).parent().parent().find('select#class_id').parent().show();
                $(this).parent().attr('class', 'col-6');
            }
        })

        //функционал выпадающего списка аватаров пользователей
        $('ul.dropdown-menu li').on('click', function (e){
            $($(this).parent().parent().parent()).find('input').val($(this).find('img').attr('src'));
            console.log($($(this).parent().parent().parent()).find('input').val());
            $($(this).parent().parent()).find('button').html($(this).html())
        })

        //Текущая подстраница
        let current_page = $('button.nav-link.active').attr('data-type');
        $(document).on('click', 'button.nav-link', function (e) {
            current_page = $(this).attr('data-type');
            //отправляем информацию о текущей странице на сервер
            $.ajax({
                url: '{{route("set-page")}}',
                type: 'POST',
                data: {
                    'current_page': 'users',
                    'current_subpage': current_page,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if (current_page == "Teachers" || current_page == "Pupils"){
                $($(this).parent()).find('input, span').show();
            } else {
                $($(this).parent()).find('input, span').hide();
            }
        });


        //отображение и скрытие поля ввода пароля
        function show_hide_password(target){
            let input = $(target.parentElement).find(':input')[0];
            if (input.getAttribute('type') == 'password') {
                target.classList.add('view');
                input.setAttribute('type', 'text');
            } else {
                target.classList.remove('view');
                input.setAttribute('type', 'password');
            }
            return false;
        }

        // Модальное окно редактирования
        $(document).on('click', '.editButton', function(event) {
            $('#editBody input:password').val('');
            $('#editBody div#collapsePassword').removeClass('show');
            $('#editBody select#class_id').prop("disabled", true);
            $($('#editBody select#lass_id option')[0]).show();
            let user_id = $(this).attr('data-user_id');

            $.ajax({
                url: '{{route("admin.show-user")}}',
                type: 'POST',
                data: {
                    'user_id': user_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataset: 'json',
                beforeSend: function() {
                    $('#editModal').modal("show");
                },
                success: function(result) {
                    $('#loader').hide();
                    $('#editBody form').show();
                    console.log('Дошел');
                    //Заполняем все поля
                    $('#editBody input#surname').val(result['surname']);
                    $('#editBody input#name').val(result['name']);
                    $('#editBody input#patronymic').val(result['patronymic']);
                    $("#editBody img#user_img").attr("src", result['img']);
                    $("#editBody p#user_type").html("Должность: " + result['user_type']);
                    $("#editBody p#user_id").html("ID: " + result['id']);
                    $("#editBody input#input_user_id").val(result['id']);
                    if (result['user_type'] == "Ученик") {
                        $($('#editBody select#class_id option')[0]).hide();
                        $('#editBody select#class_id').prop("disabled", false);
                    }

                    $('#editBody select#class_id option').each(function()
                    {
                         if ($(this).val() == result['class_id']) $(this).prop("selected", true);
                    });
                    $('#saveEdit').prop("disabled", false);
                },
                error: function(jqXHR, testStatus, error) {
                    $('#editBody form').hide();
                    $('#loader').html("Ошибка <strong>"+ jqXHR.status + "</strong> - " + error).show();
                    $('#saveEdit').prop("disabled", true);
                },
                timeout: 100000
            })
        });

        // Модальное окно удаления
        $(document).on('click', '.deleteButton', function(event) {
            $('#deleteModal').modal("show");
            let user_id = $(this).attr('data-user_id');
            $('#deleteBody input#user_id').val(user_id);
            $('#deleteBody p').html(`Удалить пользователя <strong>${user_id}</strong> из системы ?`);
        });
    </script>
@endsection
