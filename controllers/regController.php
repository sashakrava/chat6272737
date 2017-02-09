<?php
require_once './controllers/baseController.php';
class RegController extends BaseController
{
    public function __construct()
    {
        $this->__availableActions = array('index', 'add');
    }

    public function work()
    {
        parent::work();

        switch ($this->__action)
        {
            case 'add':
                header('Content-type: application/json');

                if ($this->__model->getUserId() > 0)
                    echo ('{"code": "auth"}');
                else
                {
                    if ($this->__model->reg($_POST['login'], $_POST['password']))
                        echo ('{"code": "success"}');
                    else
                        echo ('{"code": "noreg"}');
                }

                break;

            default:
                //index
                require_once './view/header.php';
                require_once './view/' . $this->__controller.  'View.php';
                require_once './view/footer.php';
                break;

        }
    }
}

