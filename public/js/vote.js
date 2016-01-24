Vue.component('posts', {
	template: '#posts-template',
	props: ['list']

});
new Vue({
	el: '#w',
	http: {
		headers: {
        	//"Authorization": "p85aDFt4bu1P1pqpaMJYDrohG6i+nqXR/XDl51/l5QeIGtJJq1Fu4gLTPxrbIgAJPaXSFCLopMhx3q/MbQDgiXRJGjBw9uEDTRuOowFJdaoDI7eJRQLIGAa3SrolNuCJB9hzp9u//N69jDWj826WjAArlolxyB1x6AHEku6f2IBQelwY9SzvFQpCu62dJaxq1XcpKbEl+jodWoOoeFBJvr8Jow/lfO4sCex5jm4L8U0D0bqGk8A9mMginxIsDyZTS9coG4DlnwJqbK2Zu9Oug8J/8IoZyYB2qfyute1O4+W9MNy+k1gpHMhoc7jWSGJ5Ps0Q5oZsW39KdMNRntjv3WzGGbDftBC0OfUWBciNUxc=",
        	//"Access-Control-Allow-Origin": "https://maxcvservices.dnb.com"
      	}
	},
	data: {

	},
	methods: {
		voteUp: function() {
			this._fetchdnb(1);
		},
		voteDown: function() {
			this._fetchdnb(0);
		},
		_fetchdnb: function(vote) {
			//this.$http.get('https://maxcvservices.dnb.com/V5.0/organizations/804735132/products/DCP_STD', function(rData) {
			//	console.log(rData);
			//}.bind(this));
			this.$http.get('crown').then(function(rData){
				this.$set('someData', rData.data);
			});
			
		}
	}
});