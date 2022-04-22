@extends('layouts.admin')


@section('content')

    <h1>Posts</h1>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered border-primary">
            <thead class="table-dark">
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Photo</th>
                <th scope="col">Title</th>
                <th scope="col">Body</th>
                <th scope="col">User</th>
                <th scope="col">Category</th>
                <th scope="col">Created</th>
                <th scope="col">Updated</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @if ($posts)
                @foreach ($posts as $post)
                  <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>
                      <img 
                        height="70" width="70" 
                        src="{{$post->photo ? asset($post->photo->file) : 'https://via.placeholder.com/300.png' }}" 
                        class="img-thumbnail" alt="">
                    </td>
                    <td>{{ $post->title }}</td> 
                    <td>{{ $post->body }}</td> 
                    <td>{{ $post->user->name }}</a></td>
                    <td>
                        {{ $post->category_id }}
                    </td> 
                    <td>{{ $post->created_at->diffForHumans() }}</td> 
                    <td>{{ $post->updated_at->diffForHumans() }}</td> 
                    <td>
                      {{-- {!! Form::open(['method'=>'DELETE', 'action'=> ['AdminpostsController@destroy', $post->id ]])!!}
             
                        <div class="form-group">
                            {!! Form::submit('Delete post', ['class'=>'btn btn-danger col-md-12']) !!}
                        </div>
                      
                      {!! Form::close() !!} --}}
                    </td> 
                  </tr>
                @endforeach
              @endif
            </tbody>
        </table>
      </div>
    
@endsection