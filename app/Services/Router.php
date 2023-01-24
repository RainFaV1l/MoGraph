<?php

namespace App\Services;


class Router
{
    private static $list = [];

    /**
     * Метод регистрирует rout для страниц
     * @param $uri
     * @param $page_name
     */

    public static  function page($uri, $page_name) {
        self::$list[] = [
            "uri" => $uri,
            "page" => $page_name,
            "list" => explode('/', $uri)
        ];
    }

    public static function post($uri, $class, $method, $formdata = false, $files = false) {
        self::$list[] = [
            "uri" => $uri,
            "class" => $class,
            "method" => $method,
            "post" => true,
            "formdata" => $formdata,
            "files" => $files

        ];
    }

    public static function enable() {
        if(isset($_GET['q'])) $query = $_GET['q'];
        else $query = NULL;
        foreach (self::$list as $route) {
            if($route["uri"] === '/' . $query) {
                if(!isset($route["post"])) $route["post"] = NULL;
                if($route["post"] === true && $_SERVER["REQUEST_METHOD"] === "POST") {
                    $action = new $route["class"];
                    $method = $route["method"];
                    if($route["formdata"] && $route["files"]) {
                        $action->$method($_POST, $_FILES);
                    } else if($route["formdata"] && !$route["files"]) {
                        $action->$method($_POST, NULL);
                    } else {
                        $action->$method(NULL, NULL);
                    }
                    die();
                } else {
                    require_once "views/pages/" . $route['page'] . ".php";
                    die();
                }
            }
        }

        self::error('404');
    }

    public static function error($error) {
        require_once "views/errors/" . $error . ".php";
    }

    public static function redirect($uri) {
        header('Location: ' . $uri);
    }
}