<?php
// ルーディングの作成
//指定したurlにくると、handlerを呼び出して任意の処理を行う
// $app->HTTP method(get/post/put/delete)(
//     'URLパターン',
//     function () {
//         // handler.ここは無名関数
//     }
// );

use Phalcon\Mvc\Micro;
use Phalcon\Logger;
use Phalcon\Logger\Adapter\File as FileAdapter;

$app = new Micro();

// Retrieves all robots
$app->get(
    '/api/robots',
    function () {
        echo '<h1>Welcome!</h1>';
    }
);

// Searches for robots with $name in their name
$app->get(
    '/api/robots/search/{name}',
    function ($name) {
        // Operation to fetch robot with name $name
    }
);

// Retrieves robots based on primary key
$app->get(
  //idは数字でなければならないということ
    '/api/robots/{id:[0-9]+}',
    function ($id) {
        // Operation to fetch robot with id $id
    }
);

// Adds a new robot
$app->post(
    '/api/robots',
    function () {
        // Operation to create a fresh robot
    }
);

// Updates robots based on primary key
$app->put(
    '/api/robots/{id:[0-9]+}',
    function ($id) {
        // Operation to update a robot with id $id
    }
);

// Deletes robots based on primary key
$app->delete(
    '/api/robots/{id:[0-9]+}',
    function ($id) {
        // Operation to delete the robot with id $id
    }
);

$app->handle();
