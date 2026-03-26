<?php

use Morainstein\Mvc\Controllers\RoomController;
use Morainstein\Mvc\Controllers\UserController;
use Morainstein\Mvc\RouteHandler\Router;


Router::get('/usuario', UserController::class, 'index');
Router::get('/usuario/create', UserController::class, 'create');
Router::get('/', UserController::class, 'index');
Router::get('/ProjetãoAlfa/turma25MVC/public/logout', UserController::class, 'logout');
Router::get('/ProjetãoAlfa/turma25MVC/public/RoomOut', RoomController::class, 'RoomOut');

Router::post('/usuario', UserController::class, 'store');
Router::post('/ProjetãoAlfa/turma25MVC/public/cadastro', UserController::class, 'store');
Router::post('/ProjetãoAlfa/turma25MVC/public/login', UserController::class, 'login');
Router::post('/ProjetãoAlfa/turma25MVC/public/Create', RoomController::class, 'createSala');
Router::post('/ProjetãoAlfa/turma25MVC/public/Find', RoomController::class, 'findSala');
Router::post('/ProjetãoAlfa/turma25MVC/public/sala', RoomController::class, 'sala');
Router::post('/ProjetãoAlfa/turma25MVC/public/sendMessage', RoomController::class, 'sendMessage');
Router::post('/ProjetãoAlfa/turma25MVC/public/updateProfile', UserController::class, 'updateProfile');
Router::get('/ProjetãoAlfa/turma25MVC/public/sala', RoomController::class, 'sala');
Router::get('/ProjetãoAlfa/turma25MVC/public/getMessages', RoomController::class, 'getMessagesAjax');
Router::get('/ProjetãoAlfa/turma25MVC/public/dashboard', UserController::class, 'redirectToDashboard');
Router::get('/ProjetãoAlfa/turma25MVC/public/editProfile', UserController::class, 'editProfile');
