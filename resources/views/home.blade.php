@extends('layouts.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('configurations')}}">Configurations</a></li>
            <li class="breadcrumb-item"><a href="{{route('register')}}">Register</a></li>
        </ol>
    </nav>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Welcome, ') . Auth::user()->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                        <img class="img-fluid mx-auto d-block" style="margin: auto" src="/images/picasse-logo.png" alt="">
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
