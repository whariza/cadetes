<?php

use Lib\Route;

use App\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/contact', function(){
    return 'Hola desde la página de contacto';
});
Route::get('/about', function(){
    return  'Hola desde la página acerca de';
});

// en la definicón de rutas importa el orden que se le coloque.
Route::get('/courses/prueba',function($slug){
    return 'Hola desde la página cursos de prueba';
});


//en esta parte se esta difiendo a modo de ejemplo una ruta con parametros para pasarlo por la url
Route::get('/courses/:slug',function($slug){
    return 'El curso es: '.$slug;
});

Route::dispatch();
?>