@extends('layouts.app')
@section('content')
    <table>
        <tr>
            <th>ID</th>
            <th>Links</th>
        </tr>
        @foreach($configurations as $configuration)
            <tr>
                <td>{{ $configuration->id }}</td>
                <td><a href="{{$configuration->link}}">{{ $configuration->link}}</a></td>
            </tr>
        @endforeach
    </table>
@endsection
