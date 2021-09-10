@extends('front.layouts.master')

@section('title', 'Merhaba Dünya deff')


@section('content')


<div class="col-md-9 mx-auto">


	
	@foreach ($articles as $article)
		
	<!-- Post preview-->
	<div class="post-preview">
		<a href="{{route('show', [$article->getCategory->slug,$article->slug])}}">
			<h2 class="post-title">{{$article->title}}</h2>
			
			<img src="{{$article->image}}" style="height: 400px; width: 700px" alt="">
			<h3 class="post-subtitle">{{Str::limit($article->content, 70)}}</h3>
		</a>  
		<p class="post-meta">
			Category:
			<a href="#!">{{ $article->getCategory->name}}</a>
			<span style="float: right">{{ $article->created_at->diffForHumans()}}</span>
		</p>
	</div>

	<!-- Divider-->
	@if (!$loop->last)		<!-- sonuncu döngü de yazdırmaz-->
	<hr class="my-4" />
	@endif

	@endforeach




	<!-- Pager-->
	<div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>
</div>

@include('front.widgets.categoryWidget')



@endsection