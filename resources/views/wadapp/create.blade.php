@extends('layout')

@section('content')
<h1>Create a post</h1>
<br />

{!! Form::open(['url' => 'post']) !!}
	@include('wadapp.form', ['submitButtonText' => 'Add Post'])
{!! Form::close() !!}

@include('errors.list')

@stop