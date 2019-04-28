<?php

use Phalcon\Mvc\Model;

class Users extends Model
{
  //publicプロパティはUserテーブルのカラムである。
    public $id;
    public $name;
    public $email;
}
