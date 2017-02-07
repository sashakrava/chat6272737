<?php

interface Controller
{
    public function parseUrl($url);
    public function work();

}

class BaseController implements Controller
{
    protected $__controller;
    protected $__action;
    protected $__params;
    protected $__availableActions;
    protected $__model;
    protected $__title;

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->__controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->__action;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->__params;
    }

    /**
     * @return mixed
     */
    public function getAvailableActions()
    {
        return $this->__availableActions;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->__model;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->__title;
    }


    public function parseUrl($url)
    {
        $urlSpl = explode('/', $url);

        $this->__controller = mb_strtolower($urlSpl[0] ?? 'index');

        $this->__action = mb_strtolower($urlSpl[1] ?? $this->__availableActions[0]);

        if (!in_array($this->__action, $this->__availableActions))
            $this->__action = $this->__availableActions[0];

        if (count($urlSpl) < 3)
            return;
        echo(count($urlSpl));
    }

    public function work()
    {
        //var_dump('./model/' . $this->controller . '/' . $this->action . 'Model.php');
        require_once './model/' . $this->__controller . 'Model.php';
        $modelClassName = $this->__controller . 'Model';
        $this->__model = new $modelClassName;
    }

}