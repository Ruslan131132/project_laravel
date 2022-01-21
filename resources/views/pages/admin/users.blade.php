@extends('layouts.user-layout')

@section('description', 'Admin Panel')

@section('title-block', 'Main')

@section('styles')
    <link rel="stylesheet" href="/css/admin/admin.css">
    <style>
        *:focus {
            outline: none;
        }

        .form-control:focus {
            -webkit-box-shadow: none;
            box-shadow: none;
            border: 1px solid #ced4da;
        }

        .dot {
            height: 10px;
            width: 10px;
            border-radius: 50%;
            display: inline-block;
        }
        .dot-red {
            background: red;
        }
        .dot-green {
            background: #39c739;
        }
    </style>

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
                <h3 class="pb-2 border-bottom">Список пользователей</h3>
            </div>
            <div class="nav nav-tabs mb-3 px-0" id="nav-tab" role="tablist" >
                <button class="nav-link {{ Session::get('current_subpage') == 'Teachers' ? 'active' : ''}}" id="nav-teachers-tab" data-type="Teachers" data-bs-toggle="tab" data-bs-target="#nav-teachers" type="button" role="tab" aria-controls="nav-teachers" aria-selected="true">Учителя</button>
                <button class="nav-link {{ Session::get('current_subpage') == 'Pupils' ? 'active' : ''}}" id="nav-pupils-tab" data-type="Pupils" data-bs-toggle="tab" data-bs-target="#nav-pupils" type="button" role="tab" aria-controls="nav-pupils" aria-selected="false">Ученики</button>
                <button class="nav-link {{ Session::get('current_subpage') == 'Add' ? 'active' : ''}}" id="nav-create-tab" data-type="Add" data-bs-toggle="tab" data-bs-target="#nav-search" type="button" role="tab" aria-controls="nav-serch" aria-selected="false">Добавить</button>
                <form class="me-0 m-auto" method="POST" action="{{ route('admin.search-user') }}">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="search-user" id="search-user" class="form-control nav-link" value="{{\Illuminate\Support\Facades\Session::get('search-input', "")}}" aria-label="" style="border-color: #e9ecef #e9ecef transparent #dee2e6; isolation: isolate; color: grey; border-radius: 0; border-top-left-radius: 0.25rem">
                        <span class="input-group-text" style="border-radius: 0; border-bottom: 0; border-top-right-radius: 0.25rem;" onclick="console.log($(this).parent().parent().submit())">
                            <img src="/img/search-icon.png" style="transform: scaleX(-1); width: 20px; height: 20px; transform: scale(-2, 2);"/>
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
                                        <tr class="candidates-list" data-user_id="{{$teacher->id}}">
                                            <td class="title">
                                                <div class="thumb">
                                                    <img class="img-fluid" src="{{$teacher->user->img}}" alt="{{ $teacher->surname }} {{ $teacher->name }} {{ $teacher->patronymic }}">
                                                </div>
                                                <div class="candidate-list-details">
                                                    <div class="candidate-list-info">
                                                        <div class="candidate-list-title">
                                                            <h5 class="mb-0">
                                                                {{ $teacher->surname }} {{ $teacher->name }} {{ $teacher->patronymic }}
                                                                @if(Cache::has('user-is-online-' . $teacher->user->user_id))
                                                                    <span class="dot dot-green"></span>
                                                                @else
                                                                    <span class="dot dot-red"></span>
                                                                @endif
                                                            </h5>

                                                        </div>
                                                        <div class="candidate-list-option">
                                                            <ul class="list-unstyled">
                                                                <li><i class="fas fa-filter pr-1"></i>Классный руководитель: {{ $teacher->class->name ?? "-"}}<br/></li>
                                                                <li><i class="fas fa-map-marker-alt pr-1"></i>ID: {{ $teacher->user->user_id }}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="candidate-list-favourite-time text-center">
                                                @if(Cache::has('user-is-online-' . $teacher->id))
                                                    <span class="text-success">Онлайн</span>
                                                @else
                                                    <span class="text-secondary">Последний раз был {{ Carbon\Carbon::parse($teacher->user->last_seen)->diffForHumans() }}</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <mat-icon _ngcontent-serverapp-c191="" role="img" class="mat-icon notranslate material-icons mat-icon-no-color editButton" style="color: grey;" aria-hidden="true" data-mat-icon-type="font" data-user_id="{{ $teacher->id }}">edit</mat-icon>
                                                <mat-icon _ngcontent-serverapp-c191="" role="img" class="mat-icon notranslate material-icons mat-icon-no-color deleteButton" style="color: #DB2828;" aria-hidden="true" data-mat-icon-type="font" data-user_id="{{ $teacher->id }}">delete_forever</mat-icon>
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
                                                    <img class="img-fluid" src="{{ $pupil->user->img }}" alt="">
                                                </div>
                                                <div class="candidate-list-details">
                                                    <div class="candidate-list-info">
                                                        <div class="candidate-list-title">
                                                            <h5 class="mb-0">
                                                                {{ $pupil->surname }} {{ $pupil->name }} {{ $pupil->patronymic }}
                                                                @if(Cache::has('user-is-online-' . $pupil->user->user_id))
                                                                    <span class="dot dot-green"></span>
                                                                @else
                                                                    <span class="dot dot-red"></span>
                                                                @endif
                                                            </h5>
                                                        </div>
                                                        <div class="candidate-list-option">
                                                            <ul class="list-unstyled">
                                                                <li><i class="fas fa-filter pr-1"></i>Класс: {{ $pupil->class->name}}<br/></li>
                                                                <li><i class="fas fa-map-marker-alt pr-1"></i>ID: {{ $pupil->user->user_id }}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="candidate-list-favourite-time text-center">
                                                @if(Cache::has('user-is-online-' . $pupil->id))
                                                    <span class="text-success">Онлайн</span>
                                                @else
                                                    <span class="text-secondary">Последний раз был {{ Carbon\Carbon::parse($pupil->user->last_seen)->diffForHumans() }}</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <mat-icon _ngcontent-serverapp-c191="" role="img" class="mat-icon notranslate material-icons mat-icon-no-color editButton" style="color: grey;" aria-hidden="true" data-mat-icon-type="font" data-user_id="{{ $pupil->id }}">edit</mat-icon>
                                                <mat-icon _ngcontent-serverapp-c191="" role="img" class="mat-icon notranslate material-icons mat-icon-no-color deleteButton" style="color: #DB2828;" aria-hidden="true" data-mat-icon-type="font" data-user_id="{{ $pupil->id }}">delete_forever</mat-icon>
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
                                        <label for="user_img">Аватар</label>
                                        <input type="hidden" name="img" id="user_img" value="null">
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuAvatar" data-bs-toggle="dropdown" aria-expanded="false" style="border: 1px solid #ced4da; padding: 3px;">
                                                <img src="" width="30" height="30" />
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonAvatar">
                                                <li style="padding: 4px 0px; cursor: pointer"><img src="" width="30" height="30" /> -</li>
                                                <li style="padding: 4px 0px; cursor: pointer" ><img src="/img/avatar/pupil-male.png" width="30" height="30" alt="Ученик"> Ученик</li>
                                                <li style="padding: 4px 0px; cursor: pointer"><img src="/img/avatar/pupil-female.png" width="30" height="30" alt="Ученица"> Ученица</li>
                                                <li style="padding: 4px 0px; cursor: pointer"><img src="/img/avatar/teacher-male.png" width="30" height="30" alt="Учитель"> Учитель</li>
                                                <li style="padding: 4px 0px; cursor: pointer"><img src="/img/avatar/teacher-female.png" width="30" height="30" alt="Учительница"> Учительница</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-3 themed-grid-col">
                                        <label for="address">Адрес</label>
                                        <input type="text" name="address" id="address" class="form-control" placeholder="Адрес..." required autofocus />
                                    </div>
                                </div>
                            </div>
                            <div class="col">
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
                                <div class="col-4 thumb" style="text-align: center">
                                    <img name="user_img" id="user_img" src="" style="border-radius: 30px; height: 140px; overflow: hidden;">
                                </div>
                                <div class="col-8">
                                    <p class="text-secondary mb-3" name="user_type" id="user_type"></p>
                                    <div class="text-secondary">Класс:
                                        <select class="form-select" name="class_id" id="class_id" style="width:auto; display: inline-block;" disabled>
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
                                        <a class="password-control" onclick="return show_hide_password(this);" style="bottom: 39px;"></a>
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
                $('select#class_id').parent().hide();
                $(this).parent().attr('class', 'col-12');
                $('input#address').parent().hide();
            } else if (this.value == "Ученик"){
                $('select#class_id').parent().show();
                $(this).parent().attr('class', 'col-6');
                $('input#address').parent().show();
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
                    if (result['user_type'] == "Ученик") $($('#editBody select#class_id option')[0]).hide();

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
                timeout: 8000
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
