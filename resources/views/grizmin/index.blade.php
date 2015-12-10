@extends('layout')

@section('content')
<h1>Wadapp content</h1>

	<ul id="comments">
		@foreach($posts as $post)
			<li class="cmmnt">
				<div class="avatar">
					<a href="javascript:void(0);">
						<img src="images/dark-cubes.png" width="55" height="55" alt="DarkCubes photo avatar">
					</a>
				</div>
			    <div class="cmmnt-content">
			    	<header>
			      		<a href="javascript:void(0);" class="userlink">{{ $post->user->name }}</a>
			      		- 
		      			<span class="pubdate">{{ $post->published_at->diffForHumans() }}
		      			</span>
	      		    </header>
			        <p>
			        	{{ $post->body }}
			        </p>
			    </div>
			    TODO
			</li>
		@endforeach
	</ul>

@stop