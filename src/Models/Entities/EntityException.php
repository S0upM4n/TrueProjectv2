<?php

namespace Morainstein\Mvc\Models\Entities;

class EntityException extends \Exception
{
  const INVALID_TIPO = ["'Tipo' de divida inválido. Tipos devem ser 'PAGAR' ou 'RECEBER'",1001];
  const INVALID_STATUS = ["'Tipo' de divida inválido. Tipos devem ser 'PAGAR','PAGO' ou 'ATRASADO'",1002];
  const INVALID_PESSOA_NOME = ["O campo 'nome' é obrigatório",1003];
  const USER_EXISTS = ["O usuário já existe",1004];
  CONST INVALID_USUARIO_NOME = ["Nome de usuário inválido",1005];
  CONST INVALID_USUARIO_EMAIL = ["Email inválido",1006];
  CONST INVALID_USUARIO_SENHA = ["Senha inválida",1007];

  public function __construct($ERROR_CONSTANT)
  {
    parent::__construct($ERROR_CONSTANT[0],$ERROR_CONSTANT[1]);
  }
}