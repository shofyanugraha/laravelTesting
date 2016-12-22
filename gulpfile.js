var elixir = require('laravel-elixir');
// require('laravel-elixir-browser-sync');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix
    .sass(['themes/admin/app.scss'],'public/themes/admin/assets/css/app.css')
    .scripts(
    	[ 
	    	'../../../node_modules/admin-lte/plugins/jQuery/jquery-2.2.3.min.js', 
	    	'../../../node_modules/admin-lte/bootstrap/js/bootstrap.min.js',
	    	'../../../node_modules/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js',
	    	'../../../node_modules/admin-lte/plugins/fastclick/fastclick.js',
	    	'../../../node_modules/admin-lte/plugins/colorpicker/bootstrap-colorpicker.min.js',
	    	'../../../node_modules/admin-lte/plugins/select2/select2.full.min.js',
	    	'../../../node_modules/bootbox/bootbox.min.js',
	    	'../../../node_modules/admin-lte/plugins/datepicker/bootstrap-datepicker.js',
	    	'../../../node_modules/mustache/mustache.min.js',
	    	'../../../node_modules/admin-lte/dist/js/app.min.js',
	    	'../../../node_modules/parsleyjs/dist/parsley.min.js',
	    	'app.js',
	    ], 
	    'public/themes/admin/assets/js/app.js')
    .browserSync({
    	files: [
	    		'app/**/*',
			    'themes/**/*',
			    'public/themes/**/*',
    		],
	    proxy: 'admin.blazbluz.app',
	    logPrefix: 'admin.bb',
	    logConnections: false,
        reloadOnRestart: false,
        notify: true,
        open: false

		
	});
});