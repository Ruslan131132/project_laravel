@extends('layouts.admin-layout')

@section('description', 'Admin Panel')

@section('title-block', 'Main')

@section('li-blocks')
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('admin.admin-main') }}" style="color: #ffffff">
            <span data-feather="home"></span>
                Создать пользователя
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659l4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
            </svg>
            <span class="sr-only">(current)</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.create-class') }}">
            <span data-feather="file"></span>
            Создать класс
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.create-subject') }}">
            <span data-feather="file"></span>
            Создать предмет
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.create-employment') }}" >
            <span data-feather="file"></span>
            Создать занятость
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('admin.create-shedule') }}" >
            <span data-feather="file"></span>
            Создать расписание
        </a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
	  <div class="row">
		<div class="col">
		  <div class="multi-collapse justify-content-md-center collapse show" id="collapseCreateUser">
			<div class="card card-body" id="card">
			  <div class="modal-content">
				<div class="modal-header">
				  <h5 class="modal-title">Регистрация пользователя в систему</h5>
				  <button type="button" class="close" data-toggle="collapse" href="#collapseCreateUser" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<div class="modal-body">
			      <form class="form"  method="POST" action="{{ route('admin.create-user') }}">
                      @csrf
			        <div class="form-group">
				      <div class="row mb-3">
		                <div class="col-md-3 themed-grid-col">
			                <label for="user_id" >ID</label>
		                    <input type="number" name="user_id"  id="user_id" class="form-control" placeholder="ID" max="2147483647" min="1000000000" required autofocus>
		                </div>
{{--		                <div class="col-md-3 themed-grid-col">--}}
{{--			                <label for="Surname" >Фамилия</label>--}}
{{--		                    <input type="text" name="Surname" class="form-control" id="Surname" placeholder="Введите Фамилию..." required>--}}
{{--		                </div>--}}
{{--		                <div class="col-md-3 themed-grid-col">--}}
{{--			                <label for="Name" >Имя</label>--}}
{{--		                    <input type="text" name="Name" class="form-control" id="Name" placeholder="Введите Имя..." required>--}}
{{--		                </div>--}}
{{--		                <div class="col-md-3 themed-grid-col">--}}
{{--			                <label for="Patronymic" >Отчество</label>--}}
{{--		                    <input type="text" name="Patronymic" class="form-control" id="Patronymic" placeholder="Введите Отчество...">--}}
{{--		                </div>--}}
					  </div>
		            </div>

		            <div class="form-group">
			          <div class="row mb-3">
{{--				        <div class="col-md-1 themed-grid-col">--}}
{{--			              <label for="Class_Name">Класс</label>--}}
{{--						  <select class="form-control" id="Class_Name" name="Class_Name" required>--}}
{{--						    @foreach($classes as $class)--}}
{{--						    <option>{{ $class->Name }}</option>--}}
{{--						    @endforeach--}}
{{--						  </select>--}}
{{--		                </div>--}}
					    <div class="col-md-2 themed-grid-col">
			                <label for="User_Type" >Тип</label>
		                    <select class="form-control" name="user_type" id="user_type" required>
							  <option selected>Ученик</option>
							  <option>Учитель</option>
							</select>
		                </div>

		                 <div class="password col-md-3 themed-grid-col">
			                <label for="password" >Пароль</label>
							<input id="password" type="password" class="form-control" name="password" required>
							<a href="#" class="password-control" onclick="return show_hide_password(this);"></a>
		                </div>
{{--		                <div class="col-md-3 themed-grid-col">--}}
{{--			                <label for="email" >E-Mail</label>--}}
{{--		                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>--}}
{{--		                </div>--}}
{{--		                <div class="col-md-3 themed-grid-col">--}}
{{--			                <label for="address" >Адрес</label>--}}
{{--		                    <input type="text" name="Address"  id="Address" class="form-control" placeholder="Введите адрес(только для ученика)" required autofocus>--}}
{{--		                </div>--}}
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
		</div>
	  </div>
    </div>


{{--    <div class="container-fluid">--}}
{{--	  <div class="row">--}}
{{--		<div class="col">--}}
{{--		  <div class="multi-collapse justify-content-md-center collapse show" id="allPupils">--}}
{{--			<div class="card card-body" id="card">--}}
{{--			  <div class="modal-content">--}}
{{--				<div class="modal-header">--}}
{{--				  <h5 class="modal-title">Все ученики</h5>--}}
{{--				  <button type="button" class="close" data-toggle="collapse" href="#allPupils" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" aria-label="Close">--}}
{{--				    <span aria-hidden="true">&times;</span>--}}
{{--				  </button>--}}
{{--				</div>--}}
{{--				<div class="modal-body">--}}
{{--				  <div class="table-responsive">--}}
{{--					<table class="table table-light table-striped">--}}
{{--					  <thead class="thead-light">--}}
{{--					    <tr>--}}
{{--					      <th scope="col">Id</th>--}}
{{--					      <th scope="col">Фамилия</th>--}}
{{--					      <th scope="col">Имя</th>--}}
{{--					      <th scope="col">Отчество</th>--}}
{{--					      <th scope="col">Должность</th>--}}
{{--					      <th scope="col">Удаление</th>--}}
{{--					    </tr>--}}
{{--					  </thead>--}}
{{--					  <tbody>--}}
{{--                        @foreach ($pupils as $user)--}}
{{--                          <tr>--}}
{{--                              <th scope="row">{{ $user->User_Id }}</th>--}}
{{--                              <td>{{ $user->Surname }}</td>--}}
{{--                              <td>{{ $user->Name }}</td>--}}
{{--                              <td>{{ $user->Patronymic }}</td>--}}
{{--                              <td>{{ $user->User_Type }}</td>--}}
{{--                              <td>--}}
{{--                                <form class="form"  method="POST" action="{{ route('deleteUser') }}">--}}
{{--                                    @csrf--}}
{{--                                    <input type="hidden" name="deleteUser" value="{{ $user->User_Id }}">--}}
{{--                                    <input type="hidden" name="deleteUser_Type" value="{{ $user->User_Type }}">--}}
{{--                                    <button type="submit" class="deleteInformation_button btn btn-sm btn-outline-danger" >--}}
{{--                                        <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z">--}}
{{--                                            </path>--}}
{{--                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z">--}}
{{--                                            </path>--}}
{{--                                        </svg>--}}
{{--                                    </button>--}}
{{--                                </form>--}}
{{--                              </td>--}}
{{--                          </tr>--}}
{{--                        @endforeach--}}
{{--					  </tbody>--}}
{{--					</table>--}}
{{--	                <nav aria-label="Page navigation for puples text-center">{{ $pupils->links() }}</nav>--}}
{{--				  </div>--}}
{{--				</div>--}}
{{--			  </div>--}}
{{--			</div>--}}
{{--		  </div>--}}
{{--		</div>--}}
{{--	  </div>--}}
{{--    </div>--}}

{{--	<div class="container-fluid">--}}
{{--	  <div class="row">--}}
{{--		<div class="col">--}}
{{--		  <div class="multi-collapse justify-content-md-center collapse show" id="allTeachers">--}}
{{--			<div class="card card-body" id="card">--}}
{{--			  <div class="modal-content">--}}
{{--				<div class="modal-header">--}}
{{--				  <h5 class="modal-title">Все преподаватели</h5>--}}
{{--				  <button type="button" class="close" data-toggle="collapse" href="#allTeachers" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" aria-label="Close">--}}
{{--				    <span aria-hidden="true">&times;</span>--}}
{{--				  </button>--}}
{{--				</div>--}}

{{--				<div class="modal-body">--}}
{{--				  <div class="table-responsive">--}}
{{--					<table class="table table-light table-striped">--}}
{{--					  <thead class="thead-light">--}}
{{--					    <tr>--}}
{{--					      <th scope="col">Id</th>--}}
{{--					      <th scope="col">Фамилия</th>--}}
{{--					      <th scope="col">Имя</th>--}}
{{--					      <th scope="col">Отчество</th>--}}
{{--					      <th scope="col">Должность</th>--}}
{{--					      <th scope="col">Удаление</th>--}}
{{--					    </tr>--}}
{{--					  </thead>--}}
{{--					  <tbody>--}}
{{--						@foreach ($teachers as $user)--}}
{{--                            <tr>--}}
{{--                              <th scope="row">{{ $user->User_Id }}</th>--}}
{{--                              <td>{{ $user->Surname }}</td>--}}
{{--                              <td>{{ $user->Name }}</td>--}}
{{--                              <td>{{ $user->Patronymic }}</td>--}}
{{--                              <td>{{ $user->User_Type }}</td>--}}
{{--                              <td>--}}
{{--                                <form class="form"  method="POST" action="{{ route('deleteUser') }}">--}}
{{--                                  {{ csrf_field() }}--}}
{{--                                  <input type="hidden" name="deleteUser_Type" value="{{ $user->User_Type }}">--}}
{{--                                  <input type="hidden" name="deleteUser" value="{{ $user->User_Id }}">--}}
{{--                                  <button type="submit" class="deleteInformation_button btn btn-sm btn-outline-danger" >--}}
{{--                                    <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z">--}}
{{--                                      </path>--}}
{{--                                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z">--}}
{{--                                      </path>--}}
{{--                                    </svg>--}}
{{--                                  </button>--}}
{{--                                </form>--}}
{{--                              </td>--}}
{{--                            </tr>--}}
{{--					    @endforeach--}}
{{--					  </tbody>--}}
{{--					</table>--}}
{{--				  </div>--}}
{{--				  <nav aria-label="Page navigation for puples text-center">{{ $teachers->links() }}</nav>--}}
{{--				  </div>--}}
{{--			  </div>--}}
{{--			</div>--}}
{{--		  </div>--}}
{{--		</div>--}}
{{--	  </div>--}}
{{--    </div>--}}

@endsection

@section('scripts')
    <script>
        function show_hide_password(target){
            let input = document.getElementById('Password');
            if (input.getAttribute('type') == 'password') {
                target.classList.add('view');
                input.setAttribute('type', 'text');
            } else {
                target.classList.remove('view');
                input.setAttribute('type', 'password');
            }
            return false;
        }
    </script>
@endsection


























