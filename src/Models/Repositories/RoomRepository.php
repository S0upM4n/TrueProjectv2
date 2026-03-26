<?php

namespace Morainstein\Mvc\Models\Repositories;

use Morainstein\Mvc\Models\Entities\User;
use Morainstein\Mvc\Models\Entities\Entity;
use Morainstein\Mvc\Models\Entities\EntityException;
use Morainstein\Mvc\Models\Entities\Room;
use Morainstein\Mvc\Models\Entities;
use Morainstein\Mvc\Utils\Util;
use PDO;
use Ramsey\Uuid\Uuid;

class RoomRepository extends PdoRepository
{

  public PDO $conn;
  protected string $table = "salas";

  public function __construct()
  {
    parent::__construct();

  }
  public function addSala(Entity $entity) : bool
  {
    try {
        session_start();
            $salaNome = $_POST['nome'];
           $query = "INSERT INTO {$this->table} (id,nome,criador,data) VALUES (?,?,?,?);";
           $pdoStatment = $this->conn->prepare($query);
              $salaId = str_replace('-','',Uuid::uuid4()->toString());
            $_SESSION['idsala'] = $salaId;
              $pdoStatment->execute([$salaId, $salaNome, $_SESSION['nome'] ?? 'N/A', date("Y-m-d")]);
              $qry="create table if not exists {$salaId} (id_user varchar(255) , nome varchar(255), mensagem text, titulo varchar(255), msgtime DATETIME DEFAULT NOW()) ;";
                $this->conn->exec($qry);
            
              redirectTo('/ProjetãoAlfa/turma25MVC/public/dashboard');
        } catch (EntityException $e) {
            // Pass error message and submitted data back to home view
            $users = (new UserRepository())->all();
            view('home', [
                'users' => $users,
                'error' => $e->getMessage(),
                'errorType' => 'criarSala',
                'nome' => $_POST['nome'] ?? '',
                'email' => $_POST['email'] ?? '',
            ]);
        }
    return $this->add($entity);
    
  }public function findSalaById(string $idSala) : ?array
  {
    $result = $this->findById($idSala);
    return $result;
  }public function getTableName() : string
  {
    return $this->table;
} public function getMessagesByTime(string $roomId) : array
{
    $query = "SELECT id_user, nome, mensagem, titulo, msgtime FROM {$roomId} ORDER BY msgtime asc;";
    $result = $this->conn->query($query)->fetchAll();
    return $result;
}
}