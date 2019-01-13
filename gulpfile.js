const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    //mix.sass('app.scss')
    //   .webpack('app.js');
    //mix.styles(['/admin/bootstrap.min.css', '/admin/custom.css', '/admin/main.css', '/admin/plugins.css', '/admin/themes.css'])
    //    .version(['/css/admin.min.css']);

    //mix.scripts(['/admin/jquery-2.1.4.min.js', '/admin/bootstrap.min.js', '/admin/compNestable.js', '/admin/plugins.js', '/admin/readyLogin.js', '/admin/general.js', '/admin/app.js'])
    //.version(['/js/admin.min.js']);

});
