<?php
	require_once './controllers/baseController.php';
  class IndexController extends BaseController
  {
   public function __construct()
   {
   	parent::__construct();
   }

   public function parseUrl($url)
   {
   	parent::parseUrl($url);
   }

  public function do()
   {
    parent::do();
   }
  }
?>
