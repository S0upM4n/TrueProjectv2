<?php
namespace Morainstein\Mvc\Controllers;

use Morainstein\Mvc\Models\Entities\User;
use Morainstein\Mvc\Models\Entities\EntityException;
use Morainstein\Mvc\Models\Repositories\UserRepository;
use Morainstein\Mvc\Controllers\UserController;
use Morainstein\Mvc\Models\Entities\Entity;
use Morainstein\Mvc\Models\Entities\Room;
use Morainstein\Mvc\Models\Entities\Room as RoomEntity;
use Morainstein\Mvc\Models\Repositories\RoomRepository;
use Morainstein\Mvc\Utils\Util;
use PDO;
use Ramsey\Uuid\Uuid;

class RoomController extends Controller
{
    private RoomRepository $repository;

    public function __construct() {
         $this->repository = new RoomRepository();
    }
    public function createSala()
    {
        session_start();
        try {
            $nome = $_POST['nome'];
            $criador = $_SESSION['nome'] ?? 'N/A';

            $room = new Room($nome, null, $criador);
            $this->repository->addSala($room);
                        
            redirectTo('/ProjetãoAlfa/turma25MVC/public/dashboard');

        } catch (EntityException $e) {
            // Pass error message and submitted data back to home view
            $users = (new UserRepository())->all();
            view('dashboard', [
                'users' => $users,
                'error' => $e->getMessage(),
                'errorType' => 'criarSala',
                'nome' => $_POST['nome'] ?? '',
            ]);
        }
        
    }

    public function findSala()
    {
        session_start();
        $salaId = $_POST['ID'] ?? '';
        if(strlen($salaId) !== 32){
            $users = (new UserRepository())->all();
            view('dashboard', [
                'users' => $users,
                'error' => "ID de sala inválido.",
                'errorType' => 'entrarSala',
                'nome' => $_POST['ID'] ?? '',
            ]);
            return;
        }
        $sala = $this->repository->findSalaById($salaId);
        if(!$sala){ 
            $users = (new UserRepository())->all();
            view('dashboard', [
                'users' => $users,
                'error' => "Sala não encontrada.",
                'errorType' => 'entrarSala',
                'nome' => $_POST['ID'] ?? '',
            ]);
            return;
        } else {
            $_SESSION['idsala'] = $salaId;
                $this->grabRoomInfo();
            //grab room info and pass to session
            redirectTo('/ProjetãoAlfa/turma25MVC/public/sala');
        }

    }public function grabRoomInfo()
    {
        session_start();
        $query="SELECT * FROM {$this->repository->getTableName()} WHERE id = ?;";
        $pdoStatment = $this->repository->conn->prepare($query);
        $pdoStatment->execute([$_SESSION['idsala']]);
        $result = $pdoStatment->fetch(PDO::FETCH_ASSOC);

        if($result){
            $_SESSION['Sala'] = $result['nome'];
            $_SESSION['criadorSala'] = $result['criador'];
            $_SESSION['dataCriacaoSala'] = $result['data'];
        }  
    }

    public function sala()
    {
        session_start();

        $salaId = $_SESSION['idsala'];
        $sala = $this->repository->findSalaById($salaId);
        if (!$sala) {
            redirectTo('/ProjetãoAlfa/turma25MVC/public/index.php/dashboard');
            return;
        }

        //get messages from database and pass to view
        $messages = $this->repository->getMessagesByTime($salaId);
         view('sala', ['sala' => $sala, 'messages' => $messages]);

    } public function sendMessage()
    {
        session_start();
        $salaId = $_SESSION['idsala'] ?? null;
        if (!$salaId) {
            redirectTo('/ProjetãoAlfa/turma25MVC/public/dashboard');
            return;
        }

        $message = $_POST['message'] ?? '';
        if (trim($message) === '') {
            redirectTo('/ProjetãoAlfa/turma25MVC/public/sala');
            return;
        }

        $userId = $_SESSION['email'] ?? 'N/A';
        $userName = $_SESSION['nome'] ?? 'N/A';
        $userTitle = $_SESSION['titulo'] ?? 'N/A';

        $query = "INSERT INTO {$salaId} (id_user, nome, mensagem, titulo) VALUES (?, ?, ?, ?);";
        $stmt = $this->repository->conn->prepare($query);
        $stmt->execute([$userId, $userName, $message, $userTitle]);

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success']);
        } else {
            redirectTo('/ProjetãoAlfa/turma25MVC/public/sala');
        }
    }

    public function getMessagesAjax()
    {
        session_start();
        $salaId = $_SESSION['idsala'];
        $messages = $this->repository->getMessagesByTime($salaId);
        header('Content-Type: application/json');
        echo json_encode($messages);
    }
    public function RoomOut()
    {
        session_start();
        $_SESSION['Sala'] = null;
        $_SESSION['idsala'] = null;
        redirectTo('/ProjetãoAlfa/turma25MVC/public/dashboard');
    }
}