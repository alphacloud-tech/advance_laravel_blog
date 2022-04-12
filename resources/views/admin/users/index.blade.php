@extends('layouts.admin')


@section('content')
    <h1 class="page-header">Users</h1>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Active</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
          </tr>
        </thead>
        <tbody>
          @if ($users)
            @foreach ($users as $user)
              <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td> 
                <td>{{ $user->role->name }}</td> 
                <td>{{ $user->is_active == 1 ? 'active' : 'not active' }}</td> 
                <td>{{ $user->created_at->diffForHumans() }}</td> 
                <td>{{ $user->updated_at->diffForHumans() }}</td> 
              </tr>
            @endforeach
          @endif
        </tbody>
    </table>
@endsection
