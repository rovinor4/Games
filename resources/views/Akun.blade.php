@extends('component.main')
@section('body')
    <div class="container shadow border p-5 rounded-5">
        <div class="row">
            <div class="col-md-6">
                <h4 class="fw-bold text-dark">Akun Saya</h4>
                <p>{{ $Data->email }}</p>
            </div>
            <div class="col-md-6">
                <a href="{{ route('LogOut') }}">
                    <button class="btn btn-outline-danger float-end">Log Out</button>
                </a>
            </div>
        </div>
    </div>
@endsection
