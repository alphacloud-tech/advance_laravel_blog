@extends('layouts.admin')


@section('content')

    <h1>Create Post</h1>

    {!! Form::open(['method'=>'POST', 'action'=> 'AdminPostsController@store', 'files'=>true])!!}
        
        <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('category', 'Category') !!}
            {!! Form::select('category_id', [''=>'Choose Category'] + $categories, null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('body', 'Description') !!}
            {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('photo_id', 'Post image') !!}
            {!! Form::file('photo_id') !!}
        </div>


        <div class="form-group">
            {!! Form::submit('Create Post', ['class'=>'btn btn-primary col-md-12']) !!}
        </div>
        
    {!! Form::close() !!}

    @include('includes.form_error')
    
@endsection