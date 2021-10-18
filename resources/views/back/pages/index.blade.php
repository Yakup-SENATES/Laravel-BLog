@extends('back.layouts.master')

@section('title','Sayfalar')
	

@section('content')
    
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
		<h6 class="m-0 font-weight-bold float-right text-primary"><strong> {{$pages->count()}} Sayfa Bulundu </strong>
		
			<a href="{{route('pages.deleted')}}" class="btn btn-warning btn-sm"> 
					<i class="fa fa-trash"> Silinen Sayfalar</i>
			</a>

		</h6>
	</div>
	<div class="card-body">
		<div id="orderSuccess" style="display: none" class="alert alert-success">
			Başarıyla Güncellendi
		</div>
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>	
						<tr>
							<th>Hareket</th>
							<th>Fotoğraf</th>
							<th>Başlık</th>						
							<th>Durum</th>							
							<th>Seçenekler</th>
						
						</tr>
						</thead>
					
						@foreach ($pages as $page)
						<tbody id="page_{{$page->id}}" class="order">
							<tr>
								<td class="handle" style="cursor: move ; width:8px">
									<i class="fas fa-2x fa-arrows-alt container py-5"></i>
								</td>

								<td>
									<img src="{{$page->image}}" width="200">
								</td>	
								<td>{{$page->title}}</td>							
								<td>
									<input class="switch" page-id="{{$page->id}}" type="checkbox" @if ($page->status=='aktif') checked @endif data-toggle="toggle" data-onstyle="outline-success" data-offstyle="outline-danger" name='switch_status'>

									{{--<input class="_switch" data-id="{{$page->id}}" type="checkbox" @if ($page->status=='aktif') checked @endif  data-toggle="toggle" data-onstyle="success" data-on="<i class='fa fa-thumbs-up'></i>" data-offstyle="danger" data-off="<i class='fa fa-thumbs-down'></i>">--}}
									
								</td>							
								<td> 
									
									<div class="d-flex">
										<a href="{{route('pages.edit',$page->id)}}" title="düzenle" class="btn btn-primary m-1"><i class="fa fa-pen"></i></a>
										
										<form action="{{route('pages.destroy', $page->id)}}" method="post">
											@csrf
											@method('DELETE')
											<button type="submit" title="Sil" class="btn btn-danger py m-1" ><i class="fa fa-trash"></i></button>
										</form>
									</div>
								
								</td>

							</tr>	
						</tbody>
						@endforeach
				</table>

			</div>
		</div>
	</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
	$('.table').sortable({	
		handle:'.handle',

		update:function(){
			var sıralama = $('.table').sortable('serialize');
			console.log(sıralama);
			$.get("{{route('page.order')}}?"+sıralama ,function (data,status) { 
				console.log(status);
				console.log(data);
				$("#orderSuccess").show().delay(1000).fadeOut();
			 })
		}


	});

</script>


<script>

    $(function() {
		$('.switch').change(function() {

		  var  id = $(this)[0].getAttribute('page-id');
	      var _status =  $(this).prop('checked')==true ? 'aktif' : 'pasif' ;	
		  $.get( "{{route('page.switch')}}",{id:id , _status:_status},  function( data ,status ) {
								
			console.log(_status);
			
			});
			console.log(id);

		('Toggle: ' + $(this).prop('checked'))
		
	  })
	})


  </script>
  


@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endsection
