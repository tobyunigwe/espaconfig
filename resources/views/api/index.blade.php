@extends('layouts.app')
@section('content')

    <table class="table col-12 col-sm-10 col-lg-6 mx-auto table-info">
        <thead>
        <tr>
            <th>Device name</th>
            <th>Device IP adress</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody>
        @foreach($configurations as $configuration)
            <tr>
                <td>{{ $configuration['route'][3]}}</td>
                <td>{{ $configuration['identifier']}}</td>
                <td>
                    <a href="" class="btn btn-primary">Deploy</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

