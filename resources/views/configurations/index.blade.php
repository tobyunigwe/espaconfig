@extends('layouts.app')
@section('content')

    <table class="table col-12 col-sm-10 col-lg-6 mx-auto table-info">
        <thead>
        <tr>
            <th>ID</th>
            <th>Links</th>
        </tr>
        </thead>
        <tbody>
        @foreach($configurations as $configuration)
            <tr>
                <td>{{ $configuration->id }}</td>
                <td><a href="{{$configuration->link}}">{{ $configuration->link}}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

