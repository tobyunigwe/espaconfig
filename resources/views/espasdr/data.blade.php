@extends('layouts.index')
@section('content')

    <div class="container">
        <br>
        <br>
        <div class="row">
            <div class="col-md-12 centered">
                <div class="col-md-8">
                    <form class="form-inline">
                        <div class="form-group">
                            <label><h3>Person </h3></label>
                            <a href="{{ url('/add') }}">
                                <button type="button" class="btn btn-success">Add Data</button>
                            </a>
                        </div>
                    </form>
                </div>
                <div class="col-md-2">
                    <a class="inactive" id="inactive" href="#" target="">By City</a>
                </div>
                <div class="col-md-2">
                    <a class="active" id="active" href="#" target="">By Department</a>
                </div>
                <table id="datas-list" name="datas-list">
                    <thead>
                    <tr>
                        <th>UserName</th>
                        <th>Password</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Avatar</th>
                        <th>Status</th>
{{--                        <th>Carname</th>--}}
                        <th>Age</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--                    @if(!empty($data)){--}}
                    @foreach ($datas as $data)
                        <tr id="data{{ $data['id'] }}">

                            <td>{{ $data['username'] }}</td>
                            <td>{{ $data['password'] }}</td>
{{--                            <td>{{ $data['department'] }}</td>--}}
{{--                            <td>{{ $data['age'] }}</td>--}}
                            {{--                            <td><img src="{{ $data['avatar'] }}" height="60" alt="avatar"></td>--}}
                            <td>
                                @if ($data['drymode'] === '1')
                                    <h4><p class="label label-success round">True
                                        <p></h4>

                                @else
                                    <h4><p class="label label-default round">False
                                        <p></h4>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('edit', $data['id']) }}">
                                    <button type="button" class="btn btn-primary btn-sm"><span
                                            class="glyphicon glyphicon-pencil"></span></button>
                                </a>
                                <a href="{{ url('delete', $data['id']) }}">
                                    <button type="button" class="btn btn-danger btn-sm"><span
                                            class="glyphicon glyphicon-trash"></span></button>
                                </a>
                            </td>
                        </tr>
                    @endforeach

{{--                    @foreach ($datas as $data)--}}
{{--                    <tr id="api{{ $data['api_id'] }}">--}}
{{--                        <td>{{ $data['carname'] }}</td>--}}

{{--                    </tr>--}}
{{--                    @endforeach--}}

                    {{--                        @endif--}}
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <br>
    </div>

@endsection
