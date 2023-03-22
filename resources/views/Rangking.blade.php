@php
    $dataID = 1;
    function Id($variable)
    {
        $x = '';
        switch ($variable) {
            case '1':
                $x = '<i class="bi bi-airplane-engines bg-dark text-white rounded-circle d-block d-flex justify-content-center align-items-center" style="width: 30px;height: 30px;"></i>';
                break;
            case '2':
                $x = '<i class="bi bi-airplane-engines bg-primary text-white rounded-circle d-block d-flex justify-content-center align-items-center" style="width: 30px;height: 30px;"></i>';
                break;
            case '2':
                $x = '<i class="bi bi-airplane-engines bg-warning text-dark rounded-circle d-block d-flex justify-content-center align-items-center" style="width: 30px;height: 30px;"></i>';
                break;
            default:
                $x = '<i class="bi bi-airplane-engines bg-dark opacity-25 text-white rounded-circle d-block d-flex justify-content-center align-items-center" style="width: 30px;height: 30px;"></i>';
                break;
        }
        return $x;
    }
@endphp
@extends('component.main')
@csrf
@section('body')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Score</th>
                        </tr>
                        @foreach ($Data as $x)
                            <tr>
                                <th>{!! Id($dataID) !!}</th>
                                <th>{{ $x->username }}</th>
                                <td>{{ $x->score }}</td>
                            </tr>
                            @php
                                $dataID++;
                            @endphp
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
