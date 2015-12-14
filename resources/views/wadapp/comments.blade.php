	<ul id="comments">
		<li class="cmmnt">
		    <div class="cmmnt-content">
      		    <a href="javascript:void(0);" class="userlink">Username</a>
		        <p>
		        	{{ $comment->body }}
		        </p>
		    </div>
		</li>
		@if ($comment->children->count() > 0)
   			@foreach ($comment->children as $comment)
				<div style="margin-left: 30px">
        			@include('wadapp.comments', ['comment' => $comment])
        		</div>
    		@endforeach
		@endif
	</ul>


