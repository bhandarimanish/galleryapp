@extends('layouts.app')

@section('content')


<div class="container">

    <div class="row justify-content-center">
    	<div class="col-md-8">
    		<div class="card">
    			<form action="{{route('upload')}}" method="post" enctype="multipart/form-data">@csrf
    				<input type="file" name="image" class="form-control">
    				<button type="submit" class="btn btn-success">Upload</button>
    			</form>
    		</div>
    	</div>
        @foreach($albums as $album)
        <img src="{{asset('avatars')}}/{{$album->image}}">
        @endforeach
    </div>
</div>



@endsection