@isset($categories)
<div class="col-md-3 float-end ">
	<div class="card">
		<div class="card-header">
			Kategoriler
		</div>

		<div class="list-group">

			@foreach( $categories as $cat )
			<li class="list-group-item  @if (Request::segment(2)==$cat->slug)
				active @endif">
			<a @if (Request::segment(2)!=$cat->slug) href="{{route('category', $cat->slug)}}" @endif> {{$cat->name}} <span class="badge bg-black" style="float: right;">{{$cat->articleCount()}}
			</span></a>
			</li>
			@endforeach
		</div>

	</div>
</div>
@endisset