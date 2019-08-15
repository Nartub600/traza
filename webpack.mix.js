const mix = require('laravel-mix')

mix
    .js('resources/js/estilos.js', 'public/js')
    .postCss('resources/css/estilos.css', 'public/css', [
      require('tailwindcss'),
    ])
    .copyDirectory('resources/images', 'public/images')
    .browserSync('autopartes.test')
