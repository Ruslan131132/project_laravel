@extends('layouts.user-layout')

@section('description', 'Admin Panel')

@section('title-block', 'Main')

@section('styles')
    <link rel="stylesheet" href="/css/admin/admin.css">
    <style>
        input {
            outline: none;
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
        <div class="row">
            <div class="bd-heading sticky-xl-top align-self-start mt-5 mb-3 mt-xl-0 mb-xl-2">
                <h3 class="pb-2 border-bottom">Регистрация пользователя</h3>
            </div>
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
                                <input type="text" name="surname" class="form-control" id="surname" placeholder="Введите Фамилию..." required />
                            </div>
                            <div class="col-md-3 themed-grid-col">
                                <label for="name">Имя</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Введите Имя..." required />
                            </div>
                            <div class="col-md-3 themed-grid-col">
                                <label for="patronymic">Отчество</label>
                                <input type="text" name="patronymic" class="form-control" id="patronymic" placeholder="Введите Отчество..." />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row mb-3">
                            <div class="col-md-1 themed-grid-col">
                                <label for="Class_name">Класс</label>
                                <select class="form-control" id="class_name" name="class_name" required>
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 themed-grid-col">
                                <label for="user_type">Тип</label>
                                <select class="form-control" name="user_type" id="user_type" required>
                                    <option selected>Ученик</option>
                                    <option>Учитель</option>
                                </select>
                            </div>

                            <div class="password col-md-3 themed-grid-col">
                                <label for="password">Пароль</label>
                                <input id="password" type="password" class="form-control" name="password" required />
                                <a class="password-control" onclick="return show_hide_password(this);"></a>
                            </div>
                            <div class="col-md-3 themed-grid-col">
                                <label for="email">E-Mail</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required />
                            </div>
                            <div class="col-md-3 themed-grid-col">
                                <label for="address">Адрес</label>
                                <input type="text" name="Address" id="Address" class="form-control" placeholder="Введите адрес(только для ученика)" required autofocus />
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <button class="btn btn-lg btn-success btn-block" type="submit">
                            Зарегистрировать
                        </button>
                    </div>
                </form>
{{--                    <form class="row g-3">--}}
{{--                        <div class="col-md-4">--}}
{{--                            <label for="validationServer01" class="form-label">First name</label>--}}
{{--                            <input type="text" class="form-control is-valid" id="validationServer01" value="Mark" required>--}}
{{--                            <div class="valid-feedback">--}}
{{--                                Looks good!--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <label for="validationServer02" class="form-label">Last name</label>--}}
{{--                            <input type="text" class="form-control is-valid" id="validationServer02" value="Otto" required>--}}
{{--                            <div class="valid-feedback">--}}
{{--                                Looks good!--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <label for="validationServerUsername" class="form-label">Username</label>--}}
{{--                            <div class="input-group has-validation">--}}
{{--                                <span class="input-group-text" id="inputGroupPrepend3">@</span>--}}
{{--                                <input type="text" class="form-control is-invalid" id="validationServerUsername" aria-describedby="inputGroupPrepend3" required>--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    Please choose a username.--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6">--}}
{{--                            <label for="validationServer03" class="form-label">City</label>--}}
{{--                            <input type="text" class="form-control is-invalid" id="validationServer03" required>--}}
{{--                            <div class="invalid-feedback">--}}
{{--                                Please provide a valid city.--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3">--}}
{{--                            <label for="validationServer04" class="form-label">State</label>--}}
{{--                            <select class="form-select is-invalid" id="validationServer04" required>--}}
{{--                                <option selected disabled value="">Choose...</option>--}}
{{--                                <option>...</option>--}}
{{--                            </select>--}}
{{--                            <div class="invalid-feedback">--}}
{{--                                Please select a valid state.--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3">--}}
{{--                            <label for="validationServer05" class="form-label">Zip</label>--}}
{{--                            <input type="text" class="form-control is-invalid" id="validationServer05" required>--}}
{{--                            <div class="invalid-feedback">--}}
{{--                                Please provide a valid zip.--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-12">--}}
{{--                            <div class="form-check">--}}
{{--                                <input class="form-check-input is-invalid" type="checkbox" value="" id="invalidCheck3" required>--}}
{{--                                <label class="form-check-label" for="invalidCheck3">--}}
{{--                                    Agree to terms and conditions--}}
{{--                                </label>--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    You must agree before submitting.--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-12">--}}
{{--                            <button class="btn btn-primary" type="submit">Submit form</button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
            </div>
        </div>

        <div class="row">
            <div class="bd-heading align-self-start mt-3 mb-3 mt-xl-0 mb-xl-2 pt-5">
                <h3>Список пользователей</h3>
            </div>
            <div class="nav nav-tabs mb-3 px-0" id="nav-tab" role="tablist" >
                <button class="nav-link active" id="nav-teachers-tab" data-bs-toggle="tab" data-bs-target="#nav-teachers" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Учителя</button>
                <button class="nav-link" id="nav-pupils-tab" data-bs-toggle="tab" data-bs-target="#nav-pupils" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Ученики</button>
                <button class="nav-link" id="nav-all-tab" data-bs-toggle="tab" data-bs-target="#nav-all" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Все</button>
                <input class="nav-link me-0 m-auto" type="search" placeholder="Поиск.." aria-label="Search" style="border-color: #e9ecef #e9ecef transparent #dee2e6; isolation: isolate;"/>
                <a class="search-control" onclick="return show_hide_password(this);"></a>
            </div>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-teachers" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm">
                                <table class="table manage-candidates-top mb-0">
                                    <thead>
                                        <tr>
                                            <th>Информация</th>
                                            <th class="text-center">Статус</th>
                                            <th class="action text-right">Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($teachers as $teacher)
                                        <tr class="candidates-list">
                                            <td class="title">
                                                <div class="thumb">
                                                    <img class="img-fluid" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="">
                                                </div>
                                                <div class="candidate-list-details">
                                                    <div class="candidate-list-info">
                                                        <div class="candidate-list-title">
                                                            <h5 class="mb-0">
                                                                {{ $teacher->surname }} {{ $teacher->name }} {{ $teacher->patronymic }}
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
                                                <a class="candidate-list-favourite order-2 text-danger" href="#"><i class="fas fa-heart"></i></a>
                                                <span class="candidate-list-time order-1">Онлайн</span>
                                            </td>
                                            <td>
                                                <ul class="list-unstyled mb-0 d-flex justify-content-end">
                                                    <li>
                                                        <form class="form" method="POST" action="{{ route('admin.delete-user') }}">
                                                            @csrf
                                                            <input type="hidden" name="delete-user" value="{{ $teacher->user->user_id }}" />
                                                            <input type="hidden" name="delete-user_type" value="{{ $teacher->user->user_type }}" />
                                                            <button type="submit" class="deleteInformation_button btn btn-sm btn-outline-danger">
                                                                <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"
                                                                    ></path>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li><a href="#" class="text-info" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>
                                                    <li><a href="#" class="text-danger" data-toggle="tooltip" title="" data-original-title="Delete"><i class="far fa-trash-alt"></i></a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
{{--                                    <tr class="candidates-list">--}}
{{--                                        <td class="title">--}}
{{--                                            <div class="thumb">--}}
{{--                                                <img class="img-fluid" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="">--}}
{{--                                            </div>--}}
{{--                                            <div class="candidate-list-details">--}}
{{--                                                <div class="candidate-list-info">--}}
{{--                                                    <div class="candidate-list-title">--}}
{{--                                                        <h5 class="mb-0"><a href="#">Brooke Kelly</a></h5>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="candidate-list-option">--}}
{{--                                                        <ul class="list-unstyled">--}}
{{--                                                            <li><i class="fas fa-filter pr-1"></i>Information Technology</li>--}}
{{--                                                            <li><i class="fas fa-map-marker-alt pr-1"></i>Rolling Meadows, IL 60008</li>--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                        <td class="candidate-list-favourite-time text-center">--}}
{{--                                            <a class="candidate-list-favourite order-2 text-danger" href="#"><i class="fas fa-heart"></i></a>--}}
{{--                                            <span class="candidate-list-time order-1">Shortlisted</span>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <ul class="list-unstyled mb-0 d-flex justify-content-end">--}}
{{--                                                <li><a href="#" class="text-primary" data-toggle="tooltip" title="" data-original-title="view"><i class="far fa-eye"></i></a></li>--}}
{{--                                                <li><a href="#" class="text-info" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>--}}
{{--                                                <li><a href="#" class="text-danger" data-toggle="tooltip" title="" data-original-title="Delete"><i class="far fa-trash-alt"></i></a></li>--}}
{{--                                            </ul>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr class="candidates-list">--}}
{{--                                        <td class="title">--}}
{{--                                            <div class="thumb">--}}
{{--                                                <img class="img-fluid" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">--}}
{{--                                            </div>--}}
{{--                                            <div class="candidate-list-details">--}}
{{--                                                <div class="candidate-list-info">--}}
{{--                                                    <div class="candidate-list-title">--}}
{{--                                                        <h5 class="mb-0"><a href="#">Ronald Bradley</a></h5>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="candidate-list-option">--}}
{{--                                                        <ul class="list-unstyled">--}}
{{--                                                            <li><i class="fas fa-filter pr-1"></i>Human Resources</li>--}}
{{--                                                            <li><i class="fas fa-map-marker-alt pr-1"></i>Monroe Township, NJ 08831</li>--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                        <td class="candidate-list-favourite-time text-center">--}}
{{--                                            <a class="candidate-list-favourite order-2 text-danger" href="#"><i class="fas fa-heart"></i></a>--}}
{{--                                            <span class="candidate-list-time order-1">Shortlisted</span>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <ul class="list-unstyled mb-0 d-flex justify-content-end">--}}
{{--                                                <li><a href="#" class="text-primary" data-toggle="tooltip" title="" data-original-title="view"><i class="far fa-eye"></i></a></li>--}}
{{--                                                <li><a href="#" class="text-info" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>--}}
{{--                                                <li><a href="#" class="text-danger" data-toggle="tooltip" title="" data-original-title="Delete"><i class="far fa-trash-alt"></i></a></li>--}}
{{--                                            </ul>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr class="candidates-list">--}}
{{--                                        <td class="title">--}}
{{--                                            <div class="thumb">--}}
{{--                                                <img class="img-fluid" src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="">--}}
{{--                                            </div>--}}
{{--                                            <div class="candidate-list-details">--}}
{{--                                                <div class="candidate-list-info">--}}
{{--                                                    <div class="candidate-list-title">--}}
{{--                                                        <h5 class="mb-0"><a href="#">Rafael Briggs</a></h5>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="candidate-list-option">--}}
{{--                                                        <ul class="list-unstyled">--}}
{{--                                                            <li><i class="fas fa-filter pr-1"></i>Recruitment Consultancy</li>--}}
{{--                                                            <li><i class="fas fa-map-marker-alt pr-1"></i>Haines City, FL 33844</li>--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                        <td class="candidate-list-favourite-time text-center">--}}
{{--                                            <a class="candidate-list-favourite order-2 text-danger" href="#"><i class="fas fa-heart"></i></a>--}}
{{--                                            <span class="candidate-list-time order-1">Shortlisted</span>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <ul class="list-unstyled mb-0 d-flex justify-content-end">--}}
{{--                                                <li><a href="#" class="text-primary" data-toggle="tooltip" title="" data-original-title="view"><i class="far fa-eye"></i></a></li>--}}
{{--                                                <li><a href="#" class="text-info" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>--}}
{{--                                                <li><a href="#" class="text-danger" data-toggle="tooltip" title="" data-original-title="Delete"><i class="far fa-trash-alt"></i></a></li>--}}
{{--                                            </ul>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr class="candidates-list">--}}
{{--                                        <td class="title">--}}
{{--                                            <div class="thumb">--}}
{{--                                                <img class="img-fluid" src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="">--}}
{{--                                            </div>--}}
{{--                                            <div class="candidate-list-details">--}}
{{--                                                <div class="candidate-list-info">--}}
{{--                                                    <div class="candidate-list-title">--}}
{{--                                                        <h5 class="mb-0"><a href="#">Vickie Meyer</a></h5>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="candidate-list-option">--}}
{{--                                                        <ul class="list-unstyled">--}}
{{--                                                            <li><i class="fas fa-filter pr-1"></i>Human Resources</li>--}}
{{--                                                            <li><i class="fas fa-map-marker-alt pr-1"></i>Minneapolis, MN 55406</li>--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                        <td class="candidate-list-favourite-time text-center">--}}
{{--                                            <a class="candidate-list-favourite order-2 text-danger" href="#"><i class="fas fa-heart"></i></a>--}}
{{--                                            <span class="candidate-list-time order-1">Shortlisted</span>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <ul class="list-unstyled mb-0 d-flex justify-content-end">--}}
{{--                                                <li><a href="#" class="text-primary" data-toggle="tooltip" title="" data-original-title="view"><i class="far fa-eye"></i></a></li>--}}
{{--                                                <li><a href="#" class="text-info" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>--}}
{{--                                                <li><a href="#" class="text-danger" data-toggle="tooltip" title="" data-original-title="Delete"><i class="far fa-trash-alt"></i></a></li>--}}
{{--                                            </ul>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr class="candidates-list">--}}
{{--                                        <td class="title">--}}
{{--                                            <div class="thumb">--}}
{{--                                                <img class="img-fluid" src="https://bootdey.com/img/Content/avatar/avatar4.png" alt="">--}}
{{--                                            </div>--}}
{{--                                            <div class="candidate-list-details">--}}
{{--                                                <div class="candidate-list-info">--}}
{{--                                                    <div class="candidate-list-title">--}}
{{--                                                        <h5 class="mb-0"><a href="#">Nichole Haynes</a></h5>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="candidate-list-option">--}}
{{--                                                        <ul class="list-unstyled">--}}
{{--                                                            <li><i class="fas fa-filter pr-1"></i>Information Technology</li>--}}
{{--                                                            <li><i class="fas fa-map-marker-alt pr-1"></i>Botchergate, Carlisle</li>--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                        <td class="candidate-list-favourite-time text-center">--}}
{{--                                            <a class="candidate-list-favourite order-2 text-danger" href="#"><i class="fas fa-heart"></i></a>--}}
{{--                                            <span class="candidate-list-time order-1">Shortlisted</span>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <ul class="list-unstyled mb-0 d-flex justify-content-end">--}}
{{--                                                <li><a href="#" class="text-primary" data-toggle="tooltip" title="" data-original-title="view"><i class="far fa-eye"></i></a></li>--}}
{{--                                                <li><a href="#" class="text-info" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>--}}
{{--                                                <li><a href="#" class="text-danger" data-toggle="tooltip" title="" data-original-title="Delete"><i class="far fa-trash-alt"></i></a></li>--}}
{{--                                            </ul>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                                <div class="text-center mt-3 mt-sm-3">--}}
{{--                                    <ul class="pagination justify-content-center mb-0">--}}
{{--                                        <li class="page-item disabled"> <span class="page-link">Prev</span> </li>--}}
{{--                                        <li class="page-item active" aria-current="page"><span class="page-link">1 </span> <span class="sr-only">(current)</span></li>--}}
{{--                                        <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                                        <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                                        <li class="page-item"><a class="page-link" href="#">...</a></li>--}}
{{--                                        <li class="page-item"><a class="page-link" href="#">25</a></li>--}}
{{--                                        <li class="page-item"> <a class="page-link" href="#">Next</a> </li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <div class="tab-pane fade" id="nav-pupils" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm">
                                <table class="table manage-candidates-top mb-0">
                                    <thead>
                                    <tr>
                                        <th>Информация</th>
                                        <th class="text-center">Статус</th>
                                        <th class="action text-right">Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($pupils as $pupil)
                                        <tr class="candidates-list">
                                            <td class="title">
                                                <div class="thumb">
                                                    <img class="img-fluid" src="{{ $pupil->user->img }}" alt="">
                                                </div>
                                                <div class="candidate-list-details">
                                                    <div class="candidate-list-info">
                                                        <div class="candidate-list-title">
                                                            <h5 class="mb-0">
                                                                {{ $pupil->surname }} {{ $pupil->name }} {{ $pupil->patronymic }}
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
                                                <a class="candidate-list-favourite order-2 text-danger" href="#"><i class="fas fa-heart"></i></a>
                                                <span class="candidate-list-time order-1">Онлайн</span>
                                            </td>
                                            <td>
                                                <ul class="list-unstyled mb-0 d-flex justify-content-end">
                                                    <li>
                                                        <form class="form" method="POST" action="{{ route('admin.delete-user') }}">
                                                            @csrf
                                                            <input type="hidden" name="delete-user" value="{{ $pupil->user->user_id }}" />
                                                            <input type="hidden" name="delete-user_type" value="{{ $pupil->user->user_type }}" />
                                                            <button type="submit" class="deleteInformation_button btn btn-sm btn-outline-danger">
                                                                <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                                                    <path
                                                                        fill-rule="evenodd"
                                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"
                                                                    ></path>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li><a href="#" class="text-info" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>
                                                    <li><a href="#" class="text-danger" data-toggle="tooltip" title="" data-original-title="Delete"><i class="far fa-trash-alt"></i></a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-all" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <p><strong>Данный раздел проходит <code>тестирование</code>.</strong> Просим прощение за ожидание</p>
                </div>
            </div>
        </div>

{{--        <div class="row">--}}
{{--            <div class="col">--}}
{{--                <div class="multi-collapse justify-content-md-center collapse show" id="allPupils">--}}
{{--                    <div class="card card-body" id="card">--}}
{{--                        <div class="modal-content">--}}
{{--                            <div class="modal-header">--}}
{{--                                <h5 class="modal-title">Все ученики</h5>--}}
{{--                                <button type="button" class="close" data-toggle="collapse" href="#allPupils" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" aria-label="Close">--}}
{{--                                    <span aria-hidden="true">&times;</span>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                            <div class="modal-body">--}}
{{--                                <div class="table-responsive">--}}
{{--                                    <table class="table table-light table-striped">--}}
{{--                                        <thead class="thead-light">--}}
{{--                                        <tr>--}}
{{--                                            <th scope="col">Id</th>--}}
{{--                                            <th scope="col">Фамилия</th>--}}
{{--                                            <th scope="col">Имя</th>--}}
{{--                                            <th scope="col">Отчество</th>--}}
{{--                                            <th scope="col">Должность</th>--}}
{{--                                            <th scope="col">Удаление</th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        @foreach ($pupils as $user)--}}
{{--                                            <tr>--}}
{{--                                                <th scope="row">{{ $user->user_id }}</th>--}}
{{--                                                <td>{{ $user->surname }}</td>--}}
{{--                                                <td>{{ $user->name }}</td>--}}
{{--                                                <td>{{ $user->patronymic }}</td>--}}
{{--                                                <td>{{ $user->user->user_type }}</td>--}}
{{--                                                <td>--}}
{{--                                                    <form class="form" method="POST" action="{{ route('admin.delete-user') }}">--}}
{{--                                                        @csrf--}}
{{--                                                        <input type="hidden" name="delete-user" value="{{ $user->user_id }}" />--}}
{{--                                                        <input type="hidden" name="delete-user_type" value="{{ $user->user_type }}" />--}}
{{--                                                        <button type="submit" class="deleteInformation_button btn btn-sm btn-outline-danger">--}}
{{--                                                            <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>--}}
{{--                                                                <path--}}
{{--                                                                    fill-rule="evenodd"--}}
{{--                                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"--}}
{{--                                                                ></path>--}}
{{--                                                            </svg>--}}
{{--                                                        </button>--}}
{{--                                                    </form>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                        @endforeach--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                    <nav aria-label="Page navigation for puples text-center">{{ $pupils->links() }}</nav>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row">--}}
{{--            <div class="col">--}}
{{--                <div class="multi-collapse justify-content-md-center collapse show" id="allTeachers">--}}
{{--                    <div class="card card-body" id="card">--}}
{{--                        <div class="modal-content">--}}
{{--                            <div class="modal-header">--}}
{{--                                <h5 class="modal-title">Все преподаватели</h5>--}}
{{--                                <button type="button" class="close" data-toggle="collapse" href="#allTeachers" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" aria-label="Close">--}}
{{--                                    <span aria-hidden="true">&times;</span>--}}
{{--                                </button>--}}
{{--                            </div>--}}

{{--                            <div class="modal-body">--}}
{{--                                <div class="table-responsive">--}}
{{--                                    <table class="table table-light table-striped">--}}
{{--                                        <thead class="thead-light">--}}
{{--                                        <tr>--}}
{{--                                            <th scope="col">Id</th>--}}
{{--                                            <th scope="col">Фамилия</th>--}}
{{--                                            <th scope="col">Имя</th>--}}
{{--                                            <th scope="col">Отчество</th>--}}
{{--                                            <th scope="col">Должность</th>--}}
{{--                                            <th scope="col">Удаление</th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        @foreach ($teachers as $user)--}}
{{--                                            <tr>--}}
{{--                                                <th scope="row">{{ $user->user_id }}</th>--}}
{{--                                                <td>{{ $user->surname }}</td>--}}
{{--                                                <td>{{ $user->name }}</td>--}}
{{--                                                <td>{{ $user->patronymic }}</td>--}}
{{--                                                <td>{{ $user->user->user_type }}</td>--}}
{{--                                                <td>--}}
{{--                                                    <form class="form" method="POST" action="{{ route('admin.delete-user') }}">--}}
{{--                                                        {{ csrf_field() }}--}}
{{--                                                        <input type="hidden" name="delete-user_type" value="{{ $user->user_type }}" />--}}
{{--                                                        <input type="hidden" name="delete-user" value="{{ $user->user_id }}" />--}}
{{--                                                        <button type="submit" class="deleteInformation_button btn btn-sm btn-outline-danger">--}}
{{--                                                            <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>--}}
{{--                                                                <path--}}
{{--                                                                    fill-rule="evenodd"--}}
{{--                                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"--}}
{{--                                                                ></path>--}}
{{--                                                            </svg>--}}
{{--                                                        </button>--}}
{{--                                                    </form>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                        @endforeach--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                                <nav aria-label="Page navigation for puples text-center">{{ $teachers->links() }}</nav>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}




@endsection

@section('scripts')
    <script>
        let var1 = {!! json_encode($pupils) !!};
        let var2 = {!! json_encode($teachers) !!};
        console.log(var1);
        console.log(var2);
        let users_list = "teachers"
        function show_hide_password(target){
            let input = document.getElementById('password');
            if (input.getAttribute('type') == 'password') {
                target.classList.add('view');
                input.setAttribute('type', 'text');
            } else {
                target.classList.remove('view');
                input.setAttribute('type', 'password');
            }
            return false;
        }
        function search_users(target){
            console.log(target);
        };

        $('.nav-link').click(function( event ) {
            console.log(event.target.id);
        });
    </script>
@endsection


























