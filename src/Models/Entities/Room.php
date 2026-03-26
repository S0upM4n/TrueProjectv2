<?php

namespace Morainstein\Mvc\Models\Entities;

class Room implements Entity
{

    public readonly int $id;
    public readonly string $nome;
    public readonly string $criador;
    public readonly string $data;

    public function __construct($nome,$id,$criador)
    {
        if(!is_null($nome)){
            $this->setNome($nome);
        }
        if(!is_null($id)){
            $this->setId($id);
        }
        if(!is_null($criador)){
            $this->setCriador($criador);
        }

            $this->data=date("Y-m-d");
        


    }
    public function setNome(string $nome) : void
    {
        $this->nome = $nome;
    }
    public function setId(int $id) : void
    {
        $this->id = $id;
    }
    public function setCriador(string $criador) : void
    {
        $this->criador = $criador;
    }

}