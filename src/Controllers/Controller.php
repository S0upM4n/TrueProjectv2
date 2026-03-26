<?php

namespace Morainstein\Mvc\Controllers;

use Morainstein\Mvc\Utils\IncludeViewTrait;

class Controller
{
    protected function redirectTo(string $path){

        header("location: $path");
    }

    protected function redirectBack(){

        header('location:'. $_SERVER['HTTP_REFERER']);
    }

}