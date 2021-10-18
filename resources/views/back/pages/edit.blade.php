@extends('back.layouts.master')

@section('title',$page->title.' Düzenleniyor')
	

@section('content')
    
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
	</div>
	<div class="card-body">

		@if ($errors->any())
			<div class="alert alert-danger">
				@foreach ($errors->all() as $error)
					<li>{{ $error}}</li>
				@endforeach
			</div>
		@endif

		<form action="{{route('pages.update', $page->id)}}" method="POST" enctype="multipart/form-data">			
			@csrf
			
				<div class="form-group">
				  <label for="title">Sayfa Başlığı</label>
				  <input type="text" value="{{$page->title}}" name="title" id="title" class="form-control col-md-3" required>
				</div>
				
				<div class="form-group">
				  <label for="slug">Sayfa link </label>
				  <input type="text" value="{{$page->slug}}" name="slug" id="slug" class="form-control col-md-3" required>
				</div>
				
				
				<div class="form-group">
				  <label for="order">Başlık Sırası </label>
				  <input type="text" value="{{$page->order}}" name="order" id="order" class="form-control col-md-3" required>
				</div>
				
				
				
				<div class="form-group">
					<label for="image">Fotoğraf</label><br>
					<img src="{{asset($page->image)}}" class="img-thumbnail mx-auto py-2 col-3" alt="image" >			
					<input type="file" name="image" class="form-control col-md-3" value="{{$page->image}}">
				  </div>		

				
				 
				  <div class="form-group" id="içerik">
					  <label for="içerik">İçerik</label>
					  <textarea class="form-control" id="summernote" name="content" rows="5">{!!$page->content!!}</textarea>
					</div>	
				 
				  <div class="form-group">
					<button type="submit" class="btn btn-primary btn-block">Gönder</button>
				</div>

		</form>

		</div>
	</div>

</div>


@endsection

		@section('js')		
		<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
		<script>
		$(document).ready(function() {
			$('#summernote').summernote({
				'height' :300
			});
		
		  });
		  
		  </script>
		@endsection		  
		@section('css')			
		<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
		@endsection		  



