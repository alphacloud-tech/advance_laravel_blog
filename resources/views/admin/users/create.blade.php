@extends('layouts.admin')

@section('content')

    <h1 class="page-header">Create Users</h1>

    {!! Form::open(['method'=>'POST', 'action'=> 'AdminUsersController@store', 'files'=>true])!!}
        
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
            {!! Form::select('role_id', [''=>'Choose Option'] + $roles, null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('is_active', 'Status') !!}
            {!! Form::select('is_active', array(1 => 'active', 0 => 'not active'), 0, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('photo_id', 'User image') !!}
            {!! Form::file('photo_id') !!}
        </div>


        <div class="form-group">
            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password',  ['class'=>'form-control']) !!}
        </div>


        <div class="form-group">
            {!! Form::submit('Create User', ['class'=>'btn btn-primary col-md-12']) !!}
        </div>
        
    {!! Form::close() !!}

    @include('includes.form_error')

@endsection