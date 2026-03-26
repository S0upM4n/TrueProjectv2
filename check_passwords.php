<?php
require 'turma25MVC/config.php';
require 'turma25MVC/vendor/autoload.php';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=Projeto", "root", "");
    $stmt = $pdo->query("SELECT id, nome, email, CHAR_LENGTH(senha) as senha_length, SUBSTR(senha, 1, 30) as preview FROM usuarios LIMIT 5;");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($results)) {
        echo "Nenhum usuário encontrado.\n";
    } else {
        echo "Users in database:\n";
        echo str_pad("ID", 37) . " | " . str_pad("Nome", 15) . " | " . str_pad("Email", 25) . " | " . str_pad("Senha Length", 12) . " | Preview\n";
        echo str_repeat("-", 120) . "\n";
        foreach ($results as $user) {
            echo str_pad($user['id'], 37) . " | " . 
                 str_pad($user['nome'] ?? 'N/A', 15) . " | " . 
                 str_pad($user['email'] ?? 'N/A', 25) . " | " . 
                 str_pad($user['senha_length'], 12) . " | " . 
                 ($user['preview'] ?? 'N/A') . "\n";
        }
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage() . "\n";
}
?>
