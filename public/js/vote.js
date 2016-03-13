Vue.component('posts', {
	template: '#posts-template',
	props: ['posts'],

	methods: {
		voteUp: function(postId) {
			this._updatePostCounter(postId, 1);
		},
		voteDown: function(postId, event) {
			this._updatePostCounter(postId, -1);
		},
		_updatePostCounter: function(postId, postVoteTypeRaw) {

			this.$http.get('post_counter/' + postId + '/' + postVoteTypeRaw)
				.then(function(responseData){
					if(responseData.data.success) {
						this.posts.forEach(function(post) {
							if(post.id == postId) {
								post.liked = responseData.data.postUpdate.liked;
								post.likeUpClass = responseData.data.postUpdate.likeUpClass;
								post.likeDownClass = responseData.data.postUpdate.likeDownClass;
								post.page_rank = responseData.data.postUpdate.page_rank;
								//TODO no break in forEach so throw exception
							}
						});
						
					} else {
						//TODO
						// show fail message
					}
				});
		},
	},

	filters: {
		diffForHumans: function(date) {
			return moment(date).fromNow();
		}
	},
	created() {
		this.posts = JSON.parse(this.posts);
	}

});

new Vue({
	el: '#w',
	http: {
		headers: {

      	}
	},
	data: {
		posts: [
			//{ 'liked' : 0 }
		],
		// crown: {
		// 	img1: "images/up_arrow_black.png"
		// },
		// postCounterImages: window.PostCounterImages
	},
	methods: {
		// crown: function() {
		// 	this.posts[0].liked = 1;
		// }
	},
});