<?php

namespace Morainstein\Mvc\Models\Entities;

class User implements Entity
{

    public readonly ?string $id;
    public readonly ?string $nome;
    public readonly ?string $email;
    public readonly ?string $senha;
    public readonly ?string $titulo;

    public function __construct($nome,$email,$senha,$titulo)
    {
        if(!is_null($nome)){
            $this->setNome($nome);
        }
        if(!is_null($email)){
            $this->setEmail($email); 
        }
        if(!is_null($senha)){
            $this->setSenha($senha); 
        }
        if(!is_null($titulo)){
            $this->setTitulo($titulo);
        }

    }
    public function setTitulo(string $titulo) : void
    {
        $this->titulo = $titulo;
    }
    public function setId(string $id) : void
    {
        $this->id = $id;
    }

    public function setNome(string $nome) : void
    {
        if(empty($nome)){
            throw new EntityException(EntityException::INVALID_USUARIO_NOME);
        }
        $this->nome = $nome;
    }

    public function setEmail(string $email) : void
    {
        $validEmail = filter_var($email,FILTER_VALIDATE_EMAIL) ? true : false;

        if(!$validEmail){
            throw new EntityException(EntityException::INVALID_USUARIO_EMAIL);
        }
        $this->email = $email;
    }

    public function setSenha(string $senha) : void
    {
        if(empty($senha)){
            throw new EntityException(EntityException::INVALID_USUARIO_SENHA);
        }
        $this->senha = password_hash($senha,PASSWORD_ARGON2I);
    }
}