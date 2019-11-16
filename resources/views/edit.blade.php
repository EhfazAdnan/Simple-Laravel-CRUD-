@extends('layout')
@section('content')
   <div class="row">
      <div class="col-md-6 offset-md-3">
        @if($message = Session::get('danger'))
           <div class="alert alert-danger">
              <strong>{{ $message }}</strong>
           </div>
        @endif

        @if($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $error)
                 <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @foreach($posts as $post)
        <form action="{{ action('PostController@update', $post->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
           <label>Name</label>
           <input type="text" class="form-control" name="name" value="{{ $post->name }}">
        </div>

        <div class="form-group">
           <label>Details</label>
           <input type="text" class="form-control" name="detail" value="{{ $post->detail }}">
        </div>

        <div class="form-group">
           <label>Author</label>
           <input type="text" class="form-control" name="author" value="{{ $post->author }}">
        </div>

        <button class="btn btn-warning" type="submit">Update</button>
        <a href="{{ action('PostController@index') }}" class="btn btn-default">Back</a>

        </form>
        @endforeach
      </div>
   </div>
@endsection