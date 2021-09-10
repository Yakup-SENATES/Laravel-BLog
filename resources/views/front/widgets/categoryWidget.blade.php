@isset($categories)
<div class="col-md-3">
	<div class="card">
		<div class="card-header">
			Kategoriler
		</div>

		<div class="list-group">

			@foreach( $categories as $cat )
			<a href="{{route('category', $cat->slug)}}" class="list-group-item">{{$cat->name}}<span class="badge bg-black" style="float: right;">{{$cat->articleCount()}}</span></a>
			@endforeach
		</div>

	</div>
</div>
@endisset