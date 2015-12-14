@extends('layout')

@section('content')
<h1>Wadapp content</h1>
	<br />
	{{ $post->body }}
	<hr />
	@foreach($comments as $comment)
		@include('wadapp.comments', ['comment' => $comment])
	@endforeach
@stop