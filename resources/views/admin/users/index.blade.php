@extends('layouts.admin')


@section('content')

    @if (session()->has('session_user_key'))
        <h3 style="text-align: center;" class="bg-danger">
          {{ session()->get("session_user_key") }}
        </h3>
    @endif

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
              <th scope="col">Action</th>
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
                  <td>
                    {{-- <!-- Example split danger button -->
                    <div class="btn-group">
                      <button type="button" class="btn btn-danger">Action</button>

                      <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" aria-haspopup="true" data-toggle="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden caret"></span>
                      </button>

                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Update</a></li>
                        
                        <li><a class="dropdown-item" href="#">Delete</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Separated link</a></li>
                      </ul>
                    </div> --}}

                    {!! Form::open(['method'=>'DELETE', 'action'=> ['AdminUsersController@destroy', $user->id ]])!!}
           
                      <div class="form-group">
                          {!! Form::submit('Delete User', ['class'=>'btn btn-danger col-md-12']) !!}
                      </div>
                    
                    {!! Form::close() !!}
                  </td> 
                </tr>
              @endforeach
            @endif
          </tbody>
      </table>
    </div>
@endsection
