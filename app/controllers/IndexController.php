<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    /**
     * Welcome and user list
     */
    public function indexAction()
    {
      //usersにある全てのuserを取得し、usersに入れる。index.phtmlでは$usersで参照可能に
        $this->view->users = Users::find();
        
    }
}
