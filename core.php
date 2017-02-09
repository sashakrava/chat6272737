<?php

/**
 * Created by PhpStorm.
 * User: Vyacheslav
 * Date: 30/01/2017
 * Time: 03:25
 */
class Core
{
    static private $__mysqliHandler;
    static public function getMysqli()
    {
        return self::$__mysqliHandler;
    }
    static public function work()
    {
        self::$__mysqliHandler = mysqli_connect('localhost', 'root', '', 'test');

        if (!self::$__mysqliHandler) {
            printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
            exit;
        }

        self::$__mysqliHandler->set_charset('utf-8mb4');

        $url = $_GET['url'] ?? 'index';

        $controllerName = mb_strtolower(explode('/', $url)[0]).'Controller';
        if (!is_file('./controllers/'.$controllerName.'.php'))
            $controllerName = 'indexController';
        require_once ('./controllers/'.$controllerName.'.php');

        $controller = new $controllerName;
        $controller->parseUrl($url);
        $controller->work();

        mysqli_close(self::$__mysqliHandler);
    }
}