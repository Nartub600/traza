const mix = require('laravel-mix')

mix
    .js('resources/js/estilos.js', 'public/js') // esto es para que levante las fuentes desde node_modules
    .js('resources/js/scripts.js', 'public/js')
    .postCss('resources/css/estilos.css', 'public/css', [
      require('tailwindcss'),
    ])
    .copyDirectory('resources/images', 'public/images')
    .copyDirectory('resources/templates', 'public/plantillas')
    .browserSync('autopartes.test')
