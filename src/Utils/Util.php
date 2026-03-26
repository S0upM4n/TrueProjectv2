<?php

namespace Morainstein\Mvc\Utils;

use PDO;


define("DB_HOST","localhost");
define("DB_NAME","Projeto");
define("DB_USER","root");
define("DB_PASS","");

class Util
{
  static public function generateConn() : PDO
  {


    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASS);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

    return $pdo;
  }

}