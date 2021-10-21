@extends('back.layouts.master')

@section('title','Ayarlar')
	

@section('content')
    
<div class="card shadow mb-4">
	<div class="card-header py-3">
	</div>
	<div class="card-body">
	
		<form action="{{ route('config.update')}}" method="POST" enctype="multipart/form-data">
			@csrf
			{{-- First Row--}}
			<div class="row">

				<div class="col-md-3">
					<div class="form-group">
						<label for="">Site Başlığı</label>
						<input type="text" name="title" required class="form-control" value="{{$config->title}}">
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label for="">Site Aktiflik</label>
							<select class="form-control" name="active" id="active">
								<option @if ($config->active ==1) selected @endif value="1">Aktif</option>
								<option @if ($config->active ==0) selected @endif value="0">Pasif</option>
						    </select>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label for="">Site Logo</label>
						<input type="file" name="logo" class="form-control">
					</div>
				</div>


			</div>	
		    {{-- End first Row--}}
			
			{{--Second Row--}}
			<div class="row">

				<div class="col-md-3">
					<div class="form-group">
						<label for="">Facebook Hesabı </label>
						<input type="text" name="facebook"class="form-control" value="{{$config->facebook}}">
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label for="">Twitter Hesabı </label>
						<input type="text" name="twitter"class="form-control" value="{{$config->twitter}}">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="">İnstagram Hesabı </label>
						<input type="text" name="instagram"class="form-control" value="{{$config->instagram}}">
					</div>
				</div>

			</div>	
			{{--End Second--}}

			{{--Third Row--}}
			<div class="row">

				<div class="col-md-3">
					<div class="form-group">
						<label for="">Github Hesabı </label>
						<input type="text" name="github"class="form-control" value="{{$config->github}}">
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label for="">Linkedin Hesabı </label>
						<input type="text" name="linkedin"class="form-control" value="{{$config->linkedin}}">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="">Sekme Icon</label>
						<input type="file" name="favicon" class="form-control">
					</div>
				</div>

			</div>	
			{{--End Third Row--}}

			<button type="submit" class="btn  btn-outline-success" style="width: 250px ; margin-inline-start: 26%; margin-top: 2% ">Kaydet</button>
		</form>

	</div>

@endsection
