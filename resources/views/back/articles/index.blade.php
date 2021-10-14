@extends('back.layouts.master')

@section('title','Makaleler')
	

@section('content')
    
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
		<h6 class="m-0 font-weight-bold float-right text-primary"><strong> {{$articles->count()}} Makale Bulundu </strong>
		
			<a href="{{route('makaleler.silinenler')}}" class="btn btn-warning btn-sm"> 
					<i class="fa fa-trash"> Silinen Makaleler</i>
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
							<th>Kategory</th>
							<th>Tıklanma</th>
							<th>Durum</th>							
							<th>Oluşturulma Tarihi</th>
							<th>Seçenekler</th>
						
						</tr>
						</thead>
						@foreach ($articles as $article)
						<tbody>
							<tr>
								<td>
									<img src="{{$article->image}}" width="200">
								</td>	
								<td>{{$article->title}}</td>								
								<td>{{$article->getCategory->name}}</td>
								<td>{{$article->hit}}</td>
								<td>
									<input class="_switch" data-id="{{$article->id}}" type="checkbox" @if ($article->status=='aktif') checked @endif data-toggle="toggle" data-onstyle="outline-success" data-offstyle="outline-danger">

									{{--<input class="_switch" data-id="{{$article->id}}" type="checkbox" @if ($article->status=='aktif') checked @endif  data-toggle="toggle" data-onstyle="success" data-on="<i class='fa fa-thumbs-up'></i>" data-offstyle="danger" data-off="<i class='fa fa-thumbs-down'></i>">--}}
									
								</td>
								<td> {{$article->created_at}}</td>
								<td> 
									
									<a target="_blank" href="{{ route('show',[$article->getCategory->slug, $article->slug ] ) }}" title="Görüntüle" class="btn btn-success m-1"><i class="fa fa-eye"></i></a>
									<a href="{{route('makaleler.edit',$article->id)}}" title="düzenle" class="btn btn-primary m-1"><i class="fa fa-pen"></i></a>
									
									<form action="{{route('makaleler.destroy', $article->id)}}" method="post">
										@csrf
										@method('DELETE')
									<button type="submit" title="Sil" class="btn btn-danger py m-1" ><i class="fa fa-trash"></i></button>
									</form>
								
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
	$(function() {
		$('._switch').change(function() {

		  id = $(this)[0].getAttribute('data-id');
		var _status =  $(this).prop('checked')==true ? 'aktif' : 'pasif' ;	
		  $.get( "http://127.0.0.1:8000/admin/switch",{id:id , _status:_status},  function( data ,status ) {
				

			alert( "Load was performed." );
			console.log(_status);
			
			});
			console.log(id);

		('Toggle: ' + $(this).prop('checked'))
		
	  })
	})
  </script>


{{--
<script>
	$(function() {
	  $('.switch').change(function() {
		//  alert($(this)[0].getAttribute('data-id') );		
	 		//id = $(this)[0].getAttribute('data-id') ;
			var id =  $(this).data('id');
			var _status =  $(this).prop('checked')==true ? 'aktif' : 'pasif' ;					
			 $.get("{{ route('switch') }}", {id:id , _status:_status} , function(data, status){
    		console.log('Başarılı');
    		console.log(id);
    	//	console.log(status);
    	//	console.log(_status);

  });
	  })
	})
</script>
  
		<script>
			$(function () {   
				$('.switch').on('change' , function () {

					var status =  $(this).prop('checked')==true ? 1 : 0 ;				
					var id = $(this).data('id');
				
					$.ajax({
						type: "GET",
						url: "{{ route('switch') }}",
						data: { id: id},
						dataType: "JSON",
						success:function (data) {
							console.log('Success');
						}
					});
				
			  })

			})

		</script>  --}}
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endsection
