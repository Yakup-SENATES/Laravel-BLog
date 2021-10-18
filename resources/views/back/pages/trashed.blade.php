@extends('back.layouts.master')

@section('title',' Silinen Sayfalar')
	

@section('content')
    
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
		<h6 class="m-0 font-weight-bold float-right text-primary"><strong> {{$pages->count()}} Sayfa Bulundu </strong>
		
			
			<a href="{{route('pages.index')}}" class="btn btn-warning btn-sm"> 
				<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>  Geri
			</a>

		</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>	
						<tr>
							<th>Fotoğraf</th>
							<th>Başlık</th>														
							<th>Seçenekler</th>
						
						</tr>
						</thead>
						@foreach ($pages as $page)
						<tbody>
							<tr>
								<td>
									<img src="{{$page->image}}" width="200">
								</td>	
								<td>{{$page->title}}</td>							
								
								<td> 
									
									<div class="d-flex">
										<a href="{{route('page.recovery', $page->id)}}" title="Kurtar" class="btn btn-success m-1"><i class="fa fa-recycle"></i></a>
																			
										<a  href ="{{route('page.hard.delete', $page->id)}}" title="Sil" class="btn btn-danger py m-1" ><i class="fa fa-trash"></i></a>									
									</div>
								
								</td>

							</tr>	
						</tbody>
						@endforeach
				</table>

			</div>
		</div>
	</div>

</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<script>

    //$(function() {
	//	$('.switch').change(function() {

	//	  var  id = $(this)[0].getAttribute('page-id');
	//      var _status =  $(this).prop('checked')==true ? 'aktif' : 'pasif' ;	
	//	  $.get( "{{route('switch')}}",{id:id , _status:_status},  function( data ,status ) {
								
	//		console.log(_status);
			
	//		});
	//		console.log(id);

	//	('Toggle: ' + $(this).prop('checked'))
		
	//  })
	//})


  </script>


@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endsection
