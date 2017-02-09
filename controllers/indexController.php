<?php
require_once './controllers/baseController.php';
class IndexController extends BaseController
{
    public function __construct()
    {
        $this->__availableActions = array('index', 'get', 'send');
    }

    public function work()
    {
        parent::work();

        switch ($this->__action)
        {
            case 'get':
                header('Content-type: application/json');
                $count = $_POST['count'] ?? 'all';
                switch ($count)
                {
                    case 'new':
                        $lastTime = $_POST['lastTime'] ?? time();

                        $res = false;

                        while(!$res)
                        {
                            usleep(500);

                            $res = $this->__model->getLastMess($lastTime);
                            if ($res != false) {
                                echo json_encode($res);
                                break;
                            }
                        }
                        break;
                    default:
                        echo json_encode($this->__model->getAllMess());
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
                    if ($this->__model->pasteMess($_POST['msg']))
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
