<?php
namespace App\Controllers;

class Controller{
    public function view($route, $data=[]){

        //Destructurar el array que se pasó para pasar parametros en las vistas
        extract($data);
        
        //se modifica la variable ruta para poder indicar cuando el archivo se encuentra dentro de otra carpeta
        $route = str_replace('.', '/', $route);
        //método para verificar si existe el archivo de la vista
        if (file_exists("../resources/views/{$route}.php")) {

            ob_start();//este metodo permite cargar la vista 
            include "../resources/views/{$route}.php"; //se carga la vista pero no se muestra, se almacena en una variable
            $content = ob_get_clean(); //se limpia el objeto con el fin de evitar mostrar lo pedido aunque se tiene almacenado

            return $content; // se retorna lo pedido

        } else {
            return "el archivo no existe";
        }
    }
}