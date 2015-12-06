var elixir = require('laravel-elixir');

elixir(function(mix) {
    //mix.sass('app.scss');
    mix.styles([
    	'../sass/app.scss',
    	'../css/styles.css'
    ]);
});
