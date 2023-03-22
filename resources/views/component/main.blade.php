<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome To Games | Indonesia</title>
    <link rel="stylesheet" href="./css/index.css">
    @vite(['node_modules/bootstrap/dist/css/bootstrap.css', 'node_modules/bootstrap-icons/font/bootstrap-icons.css'])

</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-dark fs-4" href="/">Game Kamu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @php
                    $data = [
                        'Home' => '/',
                        'Top Rank' => 'top-rank',
                    ];
                @endphp
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-2">
                    @foreach ($data as $key => $val)
                        <li class="nav-item">
                            <a class="{{ request()->is($val) ? 'nav-link bg-dark text-white px-3 rounded-3 fw-bold' : 'nav-link text-muted px-3 rounded-3' }}"
                                aria-current="page" href="{{ $val }}">{{ $key }}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="d-flex gap-2">
                    @if (!request()->is('login') && !Auth::check())
                        <a href="{{ route('login') }}"><button class="btn btn-dark px-4"><i
                                    class="bi bi-person-fill"></i>
                                Login</button></a>
                    @else
                        <a href="{{ route('akun') }}"><button class="btn btn-dark px-4"><i
                                    class="bi bi-person-fill"></i>
                                Akun Saya</button></a>
                    @endif
                </div>
            </div>
        </div>
    </nav>
    <main class="container mt-5">
        @yield('body')
    </main>
</body>

</html>
