<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Logger;
use Phalcon\Logger\Adapter\File as FileAdapter;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;

class SignupController extends Controller
{
    public function indexAction()
    {

    }

    public function sendAction()
    {
      $id = $this->request->getPost('id');

      $user = Users::findFirst($id);

      /////////////////////////////////
      $access_token = "lwWzFd/8NGcSHOZMQeXexVZB69DDK2OxjxoLmSdQPUt+RdxfK3EgJ9CHtOqlNWUNirrJPb/kEKNIkAYEUBrlT1BCFx5rUpvWNrysoA8cPpbwAgBp9ay1HSizF0RJu76avgK8okPZrIaT75g/H7assAdB04t89/1O/w1cDnyilFU=";
      $user_id = "Ue5af646e6f4c3615a5a1e34b389a1018";
      //ヘッダ設定
      $header = array(
          'Content-Type: application/json',
          'Authorization: Bearer ' . $access_token
      );
      $message = array(
          'type' => 'text',
          'text' => $user->name
          // 'text' => $post->message
      );
      $body = json_encode(array(
          'to' => $user_id,
          'messages'   => array($message)
      ));
      $options = array(
          CURLOPT_URL=> 'https://api.line.me/v2/bot/message/push',
          CURLOPT_CUSTOMREQUEST  => 'POST',
          CURLOPT_HTTPHEADER     => $header,
          CURLOPT_POSTFIELDS     => $body,
          CURLOPT_RETURNTRANSFER => true
      );
      $curl = curl_init();
      curl_setopt_array($curl, $options);
      curl_exec($curl);
      curl_close($curl);
      /////////////////////////////////

      return $this->response->redirect("/");
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
            // echo "Thanks for registering!";
            $this->response->redirect("/");
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

    public function editAction($id)
    {
      $user = Users::findFirst($id);
      $this->view->user = $user;
    }


    public function updateAction($id)
    {
      $user = Users::findFirst($id);

      $success = $user->save(
          $this->request->getPost(),
          [
              "name",
              "email",
          ]
      );
      $this->response->redirect("/");
    }

    public function deleteAction($id)
    {
      $user = Users::findFirstById($id);
      $user->delete();
      $this->response->redirect("/");
    }


}
