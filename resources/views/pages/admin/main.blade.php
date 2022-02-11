@extends('layouts.user-layout')

@section('description', 'Page presents activity on this site and Admin Info')

@section('title-block', 'Admin main test')

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
        <div class="col-md-6 col-lg-4 col-xl-5 order-md-1 order-lg-2 mb-4">
            <h4 class="mb-3">Ваши данные</h4>
            <form class="needs-validation" novalidate>
                <label for="lastName">Фамилия</label>
                <input type="text" readonly class="form-control" id="lastName" value="{{ Auth::user()->surname }}">
                <label for="firstName">Имя</label>
                <input type="text" readonly class="form-control" id="firstName" value="{{ Auth::user()->name }}">
                <label for="Patronymic">Отчество</label>
                <input type="text" readonly class="form-control" id="Patronymic" value="{{ Auth::user()->patronymic }}">
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
        let users_online = <?=json_encode($users_online)?>;
        let all_users = <?=json_encode($all_users)?>;
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
                    data: [users_online, all_users - users_online]
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
