<?php

use Phalcon\Mvc\Controller;

class SignupController extends Controller
{
    public function indexAction()
    {

    }

    public function registerAction()
    {
      //Userクラスの空のオブシェクト作成
        $user = new Users();

        // Store and check for errors。save()は真偽値を返す
        $success = $user->save(
          //リクエストをpostで受け取る
            $this->request->getPost(),
            [
                "name",
                "email",
            ]
        );
        //database作成の時に適応したvalidation(今回の場合はnot null)が働く
        if ($success) {
            echo "Thanks for registering!";
        } else {
            echo "Sorry, the following problems were generated: ";

            $messages = $user->getMessages();

            foreach ($messages as $message) {
                echo $message->getMessage(), "<br/>";
            }
        }
        //registerアクションに対応するview(signuup/register.phtml)を表示しない(レンダリングさせない)という意味
        $this->view->disable();
    }
}
