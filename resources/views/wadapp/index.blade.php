@extends('layout')

@section('content')
<h1>Wadapp content</h1>

	<a href="{{ url('/post/create') }}">Create post</a>

	<posts posts="{{ json_encode($posts) }}"></posts>

	<template id="posts-template">
		<ul id="comments">
				<li class="cmmnt" v-for="post in posts" >
						<div class="votecounter">@{{ post.page_rank }}</div>
						<div class="votebuttons">
							<div class="@{{ post.likeUpClass }}"
								id="@{{ post.id }}"  @click="voteUp(post.id)"></div>
							<div class="@{{ post.likeDownClass }}"
								id="@{{ post.id }}"  @click="voteDown(post.id)"></div>
						</div>

						<div class="avatar">
							<a href="javascript:void(0);">
								<img src="images/user-avatar.png" width="55" height="55" alt="Photo avatar">
							</a>
						</div>
					    <div class="cmmnt-content">
					    	<header>
					      		<a href="post/@{{ post.id }}" class="userlink">@{{ post.title }}</a>
					      		- 
				      			<span class="pubdate">@{{ post.published_at | diffForHumans }}
				      			</span>
			      		    </header>
			      		    <a href="javascript:void(0);" class="userlink">@{{ post.user.name }}</a>
					    </div>
				</li>
		</ul>
	</template>		

	<!-- showing the paginator for the posts  -->
	<!-- cant use vue with pagination.-->
	<!-- comments from html -->
	{{-- {!! $posts->render() !!} --}}
@stop

@section('javascript')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.14/vue.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.6.0/vue-resource.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
	
	<script type="text/javascript" src="/js/vote.js"></script>
@stop