//////////////////////////////////////////////////////////////////////////////////////////////////////

        $name = $_POST["name"];

        // $post = Post::find($request->id);
        $access_token = "lwWzFd/8NGcSHOZMQeXexVZB69DDK2OxjxoLmSdQPUt+RdxfK3EgJ9CHtOqlNWUNirrJPb/kEKNIkAYEUBrlT1BCFx5rUpvWNrysoA8cPpbwAgBp9ay1HSizF0RJu76avgK8okPZrIaT75g/H7assAdB04t89/1O/w1cDnyilFU=";
        $user_id = "Ue5af646e6f4c3615a5a1e34b389a1018";
        //ヘッダ設定
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $access_token
        );
        $message = array(
            'type' => 'text',
            'text' => $name
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
        // return redirect('/post');



//////////////////////////////////////////////////////////////////////////////////////////////////////

$app->post(
    '/send',
    function () {

        $robot = $app->request->getJsonRawBody();
        $phql = 'SELECT * FROM users WHERE id = :id:';

        $status = $app->modelsManager->executeQuery(
              $phql,
              [
                  'id' => $robot->id,
              ]
          );

        // $response = new Response();
        // return $response;

    }
);
