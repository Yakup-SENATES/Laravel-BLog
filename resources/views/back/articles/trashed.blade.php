@extends('back.layouts.master')

@section('title','Silinen Makaleler')
	

@section('content')
    
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
		<h6 class="m-0 font-weight-bold float-right text-primary"><strong> {{$articles->count()}} Makale Bulundu </strong>
			
			<a href="{{route('makaleler.index')}}" class="btn btn-warning btn-sm"> 
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
							<th>Kategory</th>
							<th>Tıklanma</th>												
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
								
								<td> {{$article->created_at}}</td>
								<td> 
									<div class="d-flex">
									<a href="{{route('recovery', $article->id)}}" title="Kurtar" class="btn btn-success m-1"><i class="fa fa-recycle"></i></a>
																		
									<a  href ="{{route('hard.delete', $article->id)}}" title="Sil" class="btn btn-danger py m-1" ><i class="fa fa-trash"></i></a>									

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
