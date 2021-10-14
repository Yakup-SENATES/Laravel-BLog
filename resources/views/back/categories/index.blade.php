@extends('back.layouts.master')

@section('title','Tüm Kategoriler')
	

@section('content')

<div class="row">

	<div class="col-md-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
					<h4 class="m-0 font-weight-bold text-danger">
						@yield('title')
					</h4>			
			</div>

				<div class="card-body">

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">				
								<thead>	
										<tr>
											<th>Kategory Adı</th>
											<th>Makale sayısı</th>
											<th>İşlemler</th>										
										</tr>
								</thead>
								
										@foreach ($categories as $category)
										<tbody>
											<tr>
												<td>{{$category->name}}</td>	
												<td>{{$category->articleCount()}}</td>	
												<td>
													<div class="d-flex">
														<a title="Düzenle" cat-id='{{$category->id}}' name='{{$category->name}}' class="btn btn-success m-1 edit-click"><i class="fa fa-pen"></i></a>
																							
														<a  href ="{{ route('delete.category', $category->id) }}" title="Sil" class="btn btn-danger py m-1" ><i class="fa fa-trash"></i></a>			

												</td>

											</tr>	
										</tbody>
										@endforeach
							</table>
				
						</div>
					</div>
				</div>

		</div>
	</div>

	<div class="col-md-4">	
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h4 class="m-0 font-weight-bold text-danger">
					Yeni Kategory Oluştur
				</h4>			
			</div>

			<div class="card-body">

				<form action="{{ route('category.store')}}" method="post">
					@csrf
					<div class="form-group">
					<label for="category">Kategory Adı</label>
					<input type="text" name="category" id="category" class="form-control">				  
					</div>
					<button type="submit" class="btn btn-warning float-right"><i class="fa fa-check" aria-hidden="true"></i> Kaydet</button>
				</form>

			</div>
		</div>



  
  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLabel">Kategoriyi Düzenle</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">

			<form action="{{ route('update.category') }}" method="GET">
				@csrf
				<div class="form-group">
				<label for="">Kategory Adı</label>
				<input type="text" name="category_edit" id="category_edit" class="form-control" value="">
				<input type="hidden" name="id" data-category="" id="category_new" value=""> 
				</div>

			 </div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Kaydet</button>		
				<button type="button" class="btn btn-warning" data-dismiss="modal">Kapat</button>		
				</div>
			</form>			
	  </div>
	</div>
  </div>

  
  {{--yukarıya ait--}}
</div>
</div>

@endsection



@section('js')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<script>


	$(function() {
		$('.edit-click').click(function() {
			
			id = $(this)[0].getAttribute('cat-id');	
			console.log('id : '+id);			
			$.get('category/edit',{id:id}, function (data) { 
				console.log(data);				

  				$( "input" ).val( data.name );
  				//$( ".category_new" ).val( data.id );
				 
				$('#editModal').modal();

			 });

			
			
		});
		
	  })
  </script>

@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endsection



