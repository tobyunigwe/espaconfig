@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Users') }}</div>

                    <div class="card-body">

                        <table class="table">
                            <thread>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thread>
                            <body>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}"><button type="button" class="btn btn-primary float-left">Edit</button></a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-left">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-warning">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </body>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
