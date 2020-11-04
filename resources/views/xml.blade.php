@extends('layouts.app')
@section('content')
    <table>
        <tr>
            <th>Mac Address</th>
            <th>Link</th>
        </tr>
        @foreach($configurations as $configuration)
            <tr>
                <td>{{ $configuration->mac_address }}</td>
                <td><a href="{{$configuration->link}}">{{ $configuration->link}}</a></td>
            </tr>
        @endforeach
    </table>
@endsection
