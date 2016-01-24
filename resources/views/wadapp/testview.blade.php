@extends('layout')

@section('content')

<h1>Test view env</h1>
<div id="testcontainer">
	<ul class="list-group">
		@foreach(json_decode($testdata) as $v)
		<li class="list-group-item">
			{{ $v->firstname }}
		</li>
		@endforeach
	</ul>
</div>
@stop

@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.14/vue.js"></script>
<script type="text/javascript" src="/js/testjs.js"></script>
@stop
