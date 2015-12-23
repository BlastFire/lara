@extends('layout')

@section('content')
	<h1>Create a comment</h1>
	<br />

	{!! Form::open() !!}
		@include('wadapp.comment_form', ['submitButtonText' => 'Add Comment'])
	{!! Form::close() !!}

	@include('errors.list')
@stop