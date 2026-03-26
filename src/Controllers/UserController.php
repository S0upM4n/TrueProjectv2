<?php

namespace Morainstein\Mvc\Controllers;

use Morainstein\Mvc\Models\Entities\User;
use Morainstein\Mvc\Models\Entities\EntityException;
use Morainstein\Mvc\Models\Repositories\UserRepository;


class UserController extends Controller
{
    private UserRepository $repository;

    public function __construct() {
        $this->repository = new UserRepository();
    }


    public function index()
    {
        $users = $this->repository->all();        
        
        view('home',['users' => $users]);
    }

    public function create()
    {
        view('formCreateUser');
    }

    public function store()
    {   session_start();
        try {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $titulo = $_POST['titulo'] ?? null;
            
            // Check if user already exists
            if ($this->repository->userExistsByEmail($email)) {
                throw new EntityException(EntityException::USER_EXISTS);
            }
            $_SESSION['nome'] = $nome;
            $_SESSION['titulo'] = $titulo;
            $_SESSION['email'] = $email;
            
            $user = new User($nome, $email, $senha, $titulo);
            $this->repository->addUser($user);
            
            redirectTo('/ProjetãoAlfa/turma25MVC/public/dashboard');

        } catch (EntityException $e) {
            // Pass error message and submitted data back to home view
            $users = $this->repository->all();
            view('home', [
                'users' => $users,
                'error' => $e->getMessage(),
                'errorType' => 'cadastro',
                'nome' => $_POST['nome'] ?? '',
                'email' => $_POST['email'] ?? '',
                'titulo' => $_POST['titulo'] ?? ''
            ]);
        }
    }public function redirectToDashboard()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            redirectTo('/ProjetãoAlfa/turma25MVC/public/index.php/');
            return;
        }
        view('dashboard');
    }public function login()
    {
        session_start();
        
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        try {
            $user = $this->repository->checkForUserWithEmailAndPassword($email, $senha);
            if (isset($user)) {
                $_SESSION['email'] = $user->email;
                $_SESSION['nome'] = $user->nome;
                $_SESSION['titulo'] = $user->titulo;
                redirectTo('/ProjetãoAlfa/turma25MVC/public/dashboard');
                return;
            }

            // If login fails, show error on home page
                // $users = $this->repository->all();
                // view('home', [
                //     'users' => $users,
                //     'error' => 'Email ou senha inválidos.',
                //     'errorType' => 'login',
                //     'loginEmail' => $email
                // ]);
                throw new \Exception('Email ou senha inválidos.');
        } catch (\Exception $e) {
            // If an exception occurs, show error on home page
            $users = $this->repository->all();
            view('home', [
                'users' => $users,
                'error' => 'Erro ao autenticar. Tente novamente.',
                'errorType' => 'login',
                'loginEmail' => $email
            ]);
        }
    }public function logout()
    {
        session_start();
        session_destroy();
        redirectTo('/');
    }
    public function editProfile()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            redirectTo('/');
            return;
        }
        view('editProfile');
    }
    public function updateProfile()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            redirectTo('/');
            return;
        }

        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $titulo = $_POST['titulo'] ?? '';

        try {
            $this->repository->updateProfile($_SESSION['email'], $nome, $email, $titulo);
            // Update session data
            $_SESSION['nome'] = $nome;
            $_SESSION['email'] = $email;
            $_SESSION['titulo'] = $titulo;

            redirectTo('/ProjetãoAlfa/turma25MVC/public/dashboard');
        } catch (EntityException $e) {
            // Pass error message and submitted data back to edit profile view
            view('editProfile', [
                'error' => $e->getMessage(),
                'nome' => $nome,
                'email' => $email,
                'titulo' => $titulo
            ]);
        }
    }
}