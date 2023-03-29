<?php

namespace Lib;

class Route {
    private static $routes = [];

    public static function get($uri, $callback){

        $uri = trim($uri,'/'); // con esto elimina el / antes en caso que se coloque para dejar una url limpia.
        self:: $routes['GET'][$uri]=$callback;
    }
    public static function post($uri, $callback){

        $uri = trim($uri,'/');
        self:: $routes['POST'][$uri]=$callback;
    }

    public static function dispatch(){
        $uri=$_SERVER['REQUEST_URI'];  //con esto recupera la url
        $uri = trim($uri,'/');  // con esto elimina el / antes en caso que se coloque para dejar una url limpia.
        
        $method = $_SERVER['REQUEST_METHOD']; //con esto recupera el tipo de metodo.
        
        //en este foreach se recorre la lista de rutas y las funciones que se han creado para cada ruta
        foreach (self::$routes[$method] as $route =>$callback){
            //se cambia el metodo de verificacion de la url para poder agregar valores variables de la url
            
            if(strpos($route, ':') !==false){
                $route = preg_replace('#:[a-zA-Z]+#','([a-zA-Z]+)',$route);
            }


            //se utilizan los caracteres especiales como comodines para poder navegar por las url's
            if (preg_match("#^$route$#",$uri, $matches)){
                

                $params = array_slice($matches, 1);
                //$response = $callback(...$params);
                //verificando si la funcion es callable
                if(is_callable($callback)){
                    $response = $callback(...$params);
                }

                //si es un array lo que hace es verificar el controller, con la posicion 0
                if(is_array($callback)){
                    $controller = new $callback[0];

                    //luego de verificar el nombre del controller lo que hace es buscar el nombre del método con la posición 1, y pasarle los parametros.
                    $response = $controller->{$callback[1]}(...$params);
                }

                if(is_array($response) || is_object($response)){

                    header('Content-Type: application/json');
                } else {
                    echo $response;
                }
                return;
            }
            
        }

        echo '404 not found';
    }
}
// video 58 emepzando.
?>




