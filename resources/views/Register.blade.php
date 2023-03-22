@extends('component.main')
@section('body')
    <div class="row mt-5 justify-content-center">
        <div class="col-5 col-md-5">
            <div class="card shadow-sm p-4">
                <div class="text-center">
                    <h4 class="fw-bold text-dark">Register</h4>
                    <p style="font-size: 14px;">Register akun baru anda</p>
                </div>
                <form action="{{ route('registerPost') }}" method="post">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-floating mb-3">
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                            value="{{ old('username') }}" placeholder=" ">
                        <label for="">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" placeholder=" ">
                        <label for="">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            value="{{ old('password') }}" placeholder=" ">
                        <label for="">Password</label>
                    </div>
                    <button class="btn btn-dark float-end">Buat Akun</button>
                </form>
                <hr>
                <a href="{{ route('login') }}">
                    <button class="btn btn-dark w-100"><i class="bi bi-person"></i> Login Akun saja</button>
                </a>
            </div>
        </div>
    </div>
@endsection
