@extends('welcome')

@section('content')
<div class="container">
    @if(Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if(Session::get('fail'))
        <div class="alert alert-danger">
            {{ Session::get('fail') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            Your information
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Name:</b> {{Auth::user()->name}}</li>
                <li class="list-group-item"><b>Email:</b> {{Auth::user()->email}}</li>
                <li class="list-group-item"><b>Role:</b> {{$role}}</li>
            </ul>
        </div>
    </div>
</div>
@endsection