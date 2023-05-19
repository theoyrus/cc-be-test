<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coding Collective - Payment App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('home.index') }}">CoCoPay</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ request()->routeIs('home.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home.index') }}">Customers</a>
                </li>
                {{--
                <li class="nav-item {{ request()->routeIs('transactions.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('transactions.index') }}">Transactions</a>
                </li>
                <li class="nav-item {{ request()->routeIs('transactions.deposit') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('transactions.deposit') }}">Deposit</a>
                </li>
                <li class="nav-item {{ request()->routeIs('transactions.withdraw') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('transactions.withdraw') }}">Withdraw</a>
                </li>
                --}}
            </ul>
            <span class="navbar-text">
                <x-customer-session />
            </span>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
