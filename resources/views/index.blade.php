@extends('layout')

@section('content')

@if($message = Session::get('success'))
   <div class="alert alert-success">
      <p>{{ $message }}</p>
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

<div class="row mb-5">
   <div class="col-md-4">
      <a href="/" class="btn btn-success">Fresh</a>
   </div>

   <div class="col-md-6">
      <form action="/search" method="get">
         <div class="input-group">
            <input type="search" name="search" class="form-control">
            <span class="input-group-prepend">
               <button class="btn btn-primary">Search</button>
            </span>
         </div>
      </form>
   </div>

   <div class="col-md-2 text-right">
      <a href="{{ action('PostController@create') }}" class="btn btn-primary">Add data</a>
   </div>
</div>

<form method="post">
   @csrf
   @method('DELETE')
   <button formaction="/deleteall" type="submit" class="btn btn-danger">Delete All Selected</button>

<table class="table table-bordered">
   <thead>
      <tr>
         <th><input type="checkbox" class="selectall"></th>
         <th>No</th>
         <th>Name</th>
         <th>Details</th>
         <th>Author</th>
         <th width="230">Action</th>
      </tr>
   </thead>
   <tbody>
      @foreach($posts as $post)
      <tr>
        <td><input type="checkbox" name="ids[]" class="selectbox" value="{{ $post->id }}"></td>
        <td>{{ $post->id }}</td>
        <td>{{ $post->name }}</td>
        <td>{{ $post->detail }}</td>
        <td>{{ $post->author }}</td>
        <td>
              <a href="{{ action('PostController@show', $post->id) }}" class="btn btn-info">Show</a>
              <a href="{{ action('PostController@edit', $post->id) }}" class="btn btn-warning">Edit</a>
              <button formaction="{{ action('PostController@destroy', $post->id) }}" type="submit" class="btn btn-danger">Delete</button>
           
        </td>
      </tr>
      @endforeach
   </tbody>
   <tfoot>
      <tr>
         <th><input type="checkbox" class="selectall2"></th>
         <th>No</th>
         <th>Name</th>
         <th>Details</th>
         <th>Author</th>
         <th width="230">Action</th>
      </tr>
   </tfoot>
</table>
</form>

{{ $posts->links() }}

<script type="text/javascript">
   $('.selectall').click(function(){
     $('.selectbox').prop('checked', $(this).prop('checked'));
     $('.selectall2').prop('checked', $(this).prop('checked'));
   });

   $('.selectall2').click(function(){
     $('.selectbox').prop('checked', $(this).prop('checked'));
     $('.selectall').prop('checked', $(this).prop('checked'));
   });

   $('.selectbox').change(function(){
     var total = $('.selectbox').length;
     var number = $('.selectbox:checked').length;
     if(total == number){
        $('.selectall').prop('checked', true);
        $('.selectall2').prop('checked', true);
     }else{
        $('.selectall').prop('checked', false);
        $('.selectall2').prop('checked', false);
     }
   });
</script>

@endsection
