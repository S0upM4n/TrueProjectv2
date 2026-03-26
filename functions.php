<?php

function dd($data, ...$values)
{
    echo '<pre>';
    var_dump($data,...$values);
    exit;
}

function view(string $view, array $data = [])
{
    extract($data);
    $path = __DIR__ . "/views/{$view}.php";
    include_once $path;
}

function redirectTo(string $path){

    header("location: $path");
}

function redirectBack(){

    header('location:'. $_SERVER['HTTP_REFERER']);
}

function headerHTML(string $tittle)
{
    extract([$tittle]);
    include_once __DIR__ . "/views/components/header.php";
}

function footerHTML()
{
    include_once __DIR__ . "/views/components/footer.php";
}

