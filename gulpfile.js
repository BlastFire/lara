var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.sass('app.scss')
    	.styles([
    		//'styles.css'
    		'stylecustom.css'
    	 ]);
});
