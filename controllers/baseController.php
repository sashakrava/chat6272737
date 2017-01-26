<?php
class BaseController
{
  private $controller;
  protected $action;
  protected $params;
  protected $avaibleActions;
  protected $model;

  public function __construct()
  {
    $this->action;
    $this->params = array();
    $this->avaibleActions = array('index');
  }

  public function parseUrl($url)
  {
    //echo("Base parseUrl<br />");

    $urlSpl = explode('/', $url);

    //var_dump($urlSpl);
    $this->controller = mb_strtolower($urlSpl[1] ?? 'index');

    $this->action = mb_strtolower($urlSpl[1] ?? $this->avaibleActions[0]);

    if (!in_array($this->action, $this->avaibleActions))
     $this->action = $this->avaibleActions[0];	

   //echo ('<br />');
   //echo ('action = ' . $this->action . '<br />');

   if (count($urlSpl) < 3)
    return;
  echo(count($urlSpl));

}
public function do()
{
  //echo('./model/' . $this->controller.  '/' . $this->action . 'Model.php');
  require_once './model/' . $this->controller .  '/' . $this->action . 'Model.php';
  $modelClassName = $this->action . 'Model';
  $this->model = new $modelClassName;
  require_once './view/header.php';
  require_once './view/' . $this->controller.  'View.php';
  require_once './view/footer.php';

}
}
?>