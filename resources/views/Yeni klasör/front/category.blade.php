@extends('front.layouts.master')

@section('title', $category->name . '  Kategorisinde '. count($articles) . ' makale bulundu')


@section('content')

@include('front.widgets.article')
	<!-- Pager-->
	{{--<div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>--}}

@include('front.widgets.categoryWidget')

@endsection