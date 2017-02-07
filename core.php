<?php

/**
 * Created by PhpStorm.
 * User: Vyacheslav
 * Date: 30/01/2017
 * Time: 03:25
 */
class Core
{
    static private $mysqliHandler;
    static public function getMysqli()
    {
        return self::$mysqliHandler;
    }
    static public function work()
    {
        session_start();

        self::$mysqliHandler = mysqli_connect('localhost', 'root', '', 'test');

        if (!self::$mysqliHandler) {
            printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
            exit;
        }

        $url = $_GET['url'] ?? 'index';

        $controllerName = mb_strtolower(explode('/', $url)[0]).'Controller';
        if (!is_file('./controllers/'.$controllerName.'.php'))
            $controllerName = 'indexController';
        require_once ('./controllers/'.$controllerName.'.php');

        $controller = new $controllerName;
        $controller->parseUrl($url);
        $controller->work();

        mysqli_close(self::$mysqliHandler);
    }
}