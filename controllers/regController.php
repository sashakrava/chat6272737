<?php
require_once './controllers/baseController.php';
class RegController extends BaseController
{
    public function __construct()
    {
        $this->availableActions = array('index', 'add');
    }

    public function parseUrl($url)
    {
        BaseTrait::parseUrl($url);
    }

    public function work()
    {
        BaseTrait::work();
        echo ($this->action);
        /*if ($this->action)
        require_once './view/header.php';
        require_once './view/' . $this->controller.  'View.php';
        require_once './view/footer.php';*/
    }
}

