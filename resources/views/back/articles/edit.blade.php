@extends('back.layouts.master')

@section('title',$article->title.' Düzenleniyor')
	

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

		<form action="{{route('makaleler.update', $article->id)}}" method="POST" enctype="multipart/form-data">
				@method('PUT')
			@csrf
			
				<div class="form-group">
				  <label for="title">Makale Başlığı</label>
				  <input type="text" value="{{$article->title}}" name="title" id="title" class="form-control col-md-3" required>
				</div>
				
				<div class="form-group">
				  <label for="category">Kategory</label>
				  <select class="form-control col-md-3" name="category" id="category" value="{{$article->category_id}}" required> 
					<option value="">~Seçim Yapınız</option>
					@foreach ($categories as $category)
					<option @if ($article->category_id ==$category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
					@endforeach				
				  </select>
				</div>

				
				<div class="form-group">
					<label for="title">Fotoğraf</label><br>
					<img src="{{asset($article->image)}}" class="img-thumbnail mx-auto py-2 col-3	" alt="image" >			
					<input type="file" name="image" class="form-control col-md-3" value="{{$article->image}}">
				  </div>

			

				  <div class="form-group">
					<label for="status">Durum</label>
					<select class="form-control col-md-3" name="status" id="status" value="{{$article->status}}" required> 
					  <option value="">~Seçim Yapınız</option>					 
					  <option>Aktif</option>
					  <option>Pasif</option>								
					</select>
				  </div>
				
				  {{--<div class="form-group" id="içerik">
					  <label for="içerik">İçerik</label>
					  <textarea class="form-control" id="editor" name="content" rows="5">{{old('content')}}</textarea>
					</div>	--}}
				 
				  <div class="form-group" id="içerik">
					  <label for="içerik">İçerik</label>
					  <textarea class="form-control" id="summernote" name="content" rows="5">{!!$article->content!!}</textarea>
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
		{{--cke	--}}
		<script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
		<script>
			ClassicEditor
				.create( document.querySelector( '#editor' ) )
				.catch( error => {
					console.error( error );
				} );
		</script>

		{{--end cke--}}

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



