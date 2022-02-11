@extends('layouts.app')

@section('content')
@include('fraction')
@if(Session::has('message'))
<div class="alert alert-danger">{{Session::get('message')}}</div>
@endif
@if(Session::has('messages'))
<div class="alert alert-success">{{Session::get('messages')}}</div>
@endif
<div class="container">
<h1>{{$albums->name}}({{$albums->images->count()}})</h1>
<div class="row">
@foreach($albums->images as $album)
<div class="col-sm-4">
<div class="item"> 
<img src="{{asset('storage/'.$album->name)}}" class="img-thumbnail"  style="width:250px;height:300px;">
</div>

<!-- Button trigger modal -->
@if(Auth::check()&&Auth::user()->user_type=='admin')
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$album->id}}">
 Delete
</button>
@endif

<!-- Modal -->
<div class="modal fade" id="exampleModal{{$album->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
 Do you really wanna delete?
      </div>
      <div class="modal-footer">
      <form action="{{route('image.delete')}}" method="POST">
        <input type="hidden" name="id" value="{{$album->id}}">
        @csrf
        <input type="submit" value="Delete" class="btn btn-danger">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
@endforeach
</div>
</div>
@endsection
