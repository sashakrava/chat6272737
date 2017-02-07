<?php
require_once './controllers/baseController.php';
class IndexController extends BaseController
{
    public function __construct()
    {
        $this->__availableActions = array('index', 'get', 'send');
    }

    public function parseUrl($url)
    {
        //BaseTrait::parseUrl($url);
        parent::parseUrl($url);
        
    }

    public function work()
    {
        parent::work();
//        var_dump($_COOKIE);
        if (isset($_COOKIE['id']) and isset($_COOKIE['token']))
        {
//            echo('id : ' . $_COOKIE['id'] . '<br>');
//            echo('token : ' . $_COOKIE['token'] . '<br>');
            $this->__model->userAuth($_COOKIE['id'], $_COOKIE['token']);
        }
        switch ($this->__action) {
            case 'get':
                header('Content-type: application/json');
                $count = $_POST['count'] ?? 'all';
                switch ($count) {
                    case 'new':

                        break;
                    default:
                        echo json_encode($this->__model->getDataLast());
                }
                break;
            case 'send':
                header('Content-type: application/json');

                if($this->__model->getUserId() > 0)
                {
                    if (empty($_POST['msg']))
                    {
                        echo('{"code": "nomsg"}');
                        return;
                    }

                    if ($this->__model->pasteMess($this->__model->getId(), $_POST['msg']))
                        echo ('{"code": "success"}');
                    else
                        echo ('{"code": "nopaste"}');
                }
                else
                    echo('{"code": "nologin"}');

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
