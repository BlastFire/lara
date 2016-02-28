Vue.component('posts', {
	template: '#posts-template',
	props: ['posts'],

	methods: {
		voteUp: function(postId) {
			this._updatePostCounter(postId, 1);
		},
		voteDown: function(postId, event) {
			this._updatePostCounter(postId, 0);
		},
		_updatePostCounter: function(postId, pageRankValue) {
			this.$http.get('post_counter/' + postId + '/' + pageRankValue)
				.then(function(rData){
					if(rData.data.success) {
						var page_rank = rData.data.message;
						for(var i=0;i<this.posts.length;i++) {
							if(this.posts[i].id == postId) {
								this.posts[i].page_rank = page_rank;
								break;
							}
						}
					} else {
						//TODO
						// show fail message
					}
				//this.$set('vuePostCounter', rData.data);
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
		posts: [],
		// crown: {
		// 	img1: "images/up_arrow_black.png"
		// },
		// postCounterImages: window.PostCounterImages
	},
	methods: {
	},
});