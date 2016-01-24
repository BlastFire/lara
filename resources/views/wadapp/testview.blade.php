@extends('layout')

@section('content')

<h1>Test view env</h1>
<div id="testcontainer">
	<tdata :list="{{ $testdata }}"></tdata>
</div>

<template id="testsdataid">
	<pre>{{ $testdata }}</pre>
	<ul class="list-group">
		<li class="list-group-item" v-for="task in list">
			@{{ task.firstname }}
		</li>
	</ul>
</template>
@stop

@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.14/vue.js"></script>
<script type="text/javascript" src="/js/testjs.js"></script>
@stop
