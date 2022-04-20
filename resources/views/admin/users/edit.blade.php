@extends('layouts.admin')

@section('content')

    <h1 class="page-header">Edit Users</h1>

    <div class="col-sm-3">
        <img 
            class="img-responsive img-rounded" 
            src="{{$user->photo ? asset($user->photo->file) : 'https://via.placeholder.com/300.png' }}" alt=""
        >
    </div>

    <div class="col-sm-9">
        {!! Form::model($user, ['method'=>'PATCH', 'action'=> ['AdminUsersController@update', $user->id ], 'files'=>true])!!}
            
            <div class="form-group">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('role_id', 'Role') !!}
                {!! Form::select('role_id', $roles, null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('is_active', 'Status') !!}
                {!! Form::select('is_active', array(1 => 'active', 0 => 'not active'), null, ['class'=>'form-control']) !!}
            </div>


            <div class="form-group">
                {!! Form::label('photo_id', 'User image') !!}
                {!! Form::file('photo_id') !!}
            </div>


            <div class="form-group">
                {!! Form::label('password', 'Password') !!}
                {!! Form::password('password', ['class'=>'form-control']) !!}
            </div>

            
            <div class="form-group">
                {!! Form::submit('Update User', ['class'=>'btn btn-primary col-sm-4']) !!}
            </div>
            
        {!! Form::close() !!}


        {!! Form::open(['method'=>'DELETE', 'action'=> ['AdminUsersController@destroy', $user->id ]])!!}
           
            <div class="form-group">
                {!! Form::submit('Delete User', ['class'=>'btn btn-danger col-sm-4 pull-right']) !!}
            </div>
            
        {!! Form::close() !!}
    </div>
    
    @include('includes.form_error')

@endsection