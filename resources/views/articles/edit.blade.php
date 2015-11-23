@extends('app')

@section('content')
	<h1>Edit: {!! $article->title !!}</h1>

	{!! Form::model($article, ['model' => 'PATCH', 'action' => ['ArticlesController@update', $article->id]]) !!}
		@include('articles.form', ['submitButtonText' => 'Update Article'])
	{!! Form::close() !!}

	 @include('errors.list')

@stop