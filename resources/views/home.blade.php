@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

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
