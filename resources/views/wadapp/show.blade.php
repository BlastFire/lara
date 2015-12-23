@extends('layout')

@section('content')
<h1>Wadapp content</h1>
	<br />
	{!! link_to_route('addCommentRoute', 'Create comment for this post', [
		$post->id
	])!!}
	<br />
	{{ $post->body }}
	<hr />
	@foreach($comments as $comment)
		@include('wadapp.comments', ['comment' => $comment])
	@endforeach
@stop