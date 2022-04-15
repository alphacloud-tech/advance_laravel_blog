@extends('layouts.admin')


@section('content')
    <h1 class="page-header">Users</h1>
    <div class="table-responsive">
      <table class="table table-striped table-hover table-bordered border-primary">
          <thead class="table-dark">
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Photo</th>
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
                  <td>
                    <img 
                      height="70" width="70" 
                      src="{{$user->photo ? asset($user->photo->file) : 'https://via.placeholder.com/300.png' }}" 
                      class="img-thumbnail" alt="">
                  </td>
                  <td><a href="{{ route('users.edit', $user->id)}}">{{ $user->name }}</a></td>
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
    </div>
@endsection
