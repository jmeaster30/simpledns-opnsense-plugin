<?php
namespace syrency\simpledns;

class IndexController extends \OPNsense\Base\IndexController
{
  public function indexAction()
  {
    $this->view->pick('syrency/simpledns/index');
  }
}