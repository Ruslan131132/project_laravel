@extends('layouts.user-layout')

@section('description', 'Page presents activity on this site and Admin Info')

@section('title-block', 'Admin main test')

@section('styles')
    <link rel="stylesheet" href="/css/user/user-main.css">
@endsection

@section('li-blocks')
    @include('layouts.li', ['value' => 'Главная', 'status' => 'active', 'icon' => '/svg/home.svg', 'route' => 'admin.main'])
    @include('layouts.li', ['value' => 'Пользователи', 'status' => '', 'icon' => '/svg/users.svg', 'route' => 'admin.users'])
    @include('layouts.li', ['value' => 'Классы', 'status' => '', 'icon' => '/svg/class.svg', 'route' => 'admin.classes'])
    @include('layouts.li', ['value' => 'Предметы', 'status' => '', 'icon' => '/svg/book.svg', 'route' => 'admin.subjects'])
    @include('layouts.li', ['value' => 'Занятость', 'status' => '', 'icon' => '/svg/employment.svg', 'route' => 'admin.employment'])
    @include('layouts.li', ['value' => 'Расписание', 'status' => '', 'icon' => '/svg/schedule.svg', 'route' => 'admin.schedule'])
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-4 col-xl-3 order-md-2 order-lg-3 mb-4">
            <div class="col-auto d-lg-block" align="center" data-bs-toggle="modal" data-bs-target="#changeAvatarModal">
                <svg class="bd-placeholder-img" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#55595c"/>
                    <text x="50%" y="50%" fill="#eceeef" dy=".3em">Администратор</text>
                </svg>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="changeAvatarModal" tabindex="-1" aria-labelledby="changeAvatarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Выбор аватара</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                       <form class="m-2" method="post" action="{{ route('file-upload') }}" enctype="multipart/form-data">
                           @csrf
                           <div class="form-group border-bottom">
                               <label for="image" class="form-label">Выберите изображение</label>
                               <input class="form-control" id="image" type="file" name="image">
                           </div>
                           <br />
                           <button type="submit" class="btn btn-dark d-block w-75 mx-auto">Сохранить</button>
                       </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-5 order-md-1 order-lg-2">
            <h4 class="mb-3">Ваши данные</h4>
            <form class="needs-validation" novalidate>
                <label for="lastName">Фамилия</label>
                <input type="text" readonly class="form-control" id="lastName" value="">
                <label for="firstName">Имя</label>
                <input type="text" readonly class="form-control" id="firstName" value="">
                <label for="Patronymic">Отчество</label>
                <input type="text" readonly class="form-control" id="Patronymic" value="">
            </form>
        </div>
        <div class="col-md-6 col-lg-4 order-md-3 order-lg-1">
            <div class="card">
                <div class="card-header">Статистика</div>
                <div class="card-body">
                    <canvas id="chDonut" ></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.js'></script>
    <script>
        let donutOptions = {
            cutoutPercentage: 65,
            legend: {position:'top', padding: '15px', labels: {pointStyle:'circle', usePointStyle:true}}
        };
        let chDonutData = {
            labels: ['Онлайн', 'Оффлайн'],
            datasets: [
                {
                    backgroundColor: ['#4cbf73', '#d9534f'],
                    borderWidth: 0,
                    data: [740, 1120]
                }
            ]
        };

        let chDonut = document.getElementById("chDonut");
        if (chDonut) {
            new Chart(chDonut, {
                type: 'pie',
                data: chDonutData,
                options: donutOptions
            });
        }
    </script>
@endsection
