

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ultra team Communications+</title>

    </style>
</head>
<body style="background-color: rgb(128, 187, 189);">
<div style="width: 100%; height: 200px; background-color: #80bfff; display: flex;flex-direction: column; align-items: center; justify-content: center;">
    <h1 style="font-family: Geneva, Tahoma, sans-serif; text-align: center; margin-top:40px">Ultra team Communications plus</h1><br><br>
    <h3>Sua segurança <del>NÃO</del> é nossa prioridade
    </h3>
</div>

<div style="background-color: #104b86; height: 100px; display: flex; align-items: center; justify-content: center;">
    <h2 style="margin: auto; text-align: center; font-size: 30px; font-family: Tahoma, sans-serif;">Gostaria de estabelecer uma linha de comunicação com o seu time?</h2>
</div><br><br>
<div style="display: flex; justify-content: center;">
    <div style="width: 100%; display: flex; justify-content: space-around;">
        <div style="background-color: whitesmoke; height: 350px; width: 45%;">

        <h2 style="margin-left: 50px;font-size: 34px;">Como utilizar?</h2>

        <ol style="padding-top:5px">
            <li style="padding-top:20px; font-size: 22px;">Faça Login ou cadastre-se</li>
            <li style="padding-top:20px; font-size: 22px;">Crie uma sala para a Comunicação</li>
            <li style="padding-top:20px; font-size: 22px;">Compartilhe o código gerado com seus colegas para participarem</li>
            <li style="padding-top:20px; font-size: 22px;">Inicie a comunicação!</li>
        </ol>

        </div>


            <div style="background-color: whitesmoke; height: 350px; width: 35%;overflow:scroll;display: flex; flex-direction: row; justify-content: center;gap:20px">
                <!-- <h2 style="margin-left: 10px;">Criação e Acesso à Sala</h2> -->
<br>
                <!-- <form style="text-align: center;" action="/ProjetãoAlfa/turma25MVC/public/index.php/form" method="POST">
                    <label for="nome">CRIAR Sala:</label>
                    <input type="text" id="nome" name="nome" placeholder="Nome da sala">
                    <button type="submit">Criar Sala</button>
                </form>


                <p style="text-align: center;"><?php if ($_SERVER["REQUEST_METHOD"] === "POST") { /* echo "$mensagem <b>$salaId</b>"; */ } ?></p>
                <hr><br>
                
                <form style="text-align: center;" action="/ProjetãoAlfa/turma25MVC/public/index.php/form" method="POST">
                    <label for="nome">ENTRAR na Sala:</label> <!-- rever o action desse e dos próximos forms-->
                    <!-- <input type="text" id="nome" name="nome" placeholder="Nome da sala" required>
                    <button type="submit">Entrar na Sala</button>
                </form>
                <br> --> 
            <!-- <hr> -->
                <!-- <form style="text-align: center;" action="/ProjetãoAlfa/turma25MVC/public/index.php/form" method="POST">
                    <label for="nome">LOGIN do USUARIO:</label>
                    <input type="text" id="nome" name="nome" placeholder="Nome da sala" required><br>
                    <label for="senha">SENHA do USUARIO:</label>
                    <input type="password" id="senha" name="senha" placeholder="Senha" required><br><br>
                    <button type="submit">Logar</button>
                </form>

<hr>
                <form style="text-align: center;" action="/ProjetãoAlfa/turma25MVC/public/index.php/form" method="POST">
                    <label for="nome">CADASTRO do USUARIO:</label>
                    <input type="text" id="nome" name="nome" placeholder="Nome da sala" required><br>
                    <label for="email">EMAIL do USUARIO:</label>
                    <input type="email" id="email" name="email" placeholder="Email" required><br>
                    <label for="senha">SENHA do USUARIO:</label>
                    <input type="password" id="senha" name="senha" placeholder="Senha" required><br><br>
                    <button type="submit">Cadastrar</button>
            </div> -->

        <div style="height: 100%;width:55%">
        <h2 style="margin-left:  10px;">Cadastro de Usuário</h2>
        
        <?php if (isset($error) && ($errorType ?? '') === 'cadastro'): ?>
            <div style="color: red; margin: 10px; padding: 10px; background-color: #ffe6e6; border-left: 4px solid red;">
                <strong>Erro:</strong> <?php echo ($error); ?>
            </div>
        <?php endif; ?>
        
        <form action="/ProjetãoAlfa/turma25MVC/public/cadastro" method="POST" style="padding: 10px;">
                    <label for="nome">CADASTRO do USUARIO:</label><br>
                    <input type="text" id="nome" name="nome" placeholder="Nome do usuario" value="<?php echo htmlspecialchars($nome ?? ''); ?>" required><br>
                    <label for="titulo">TÍTULO do USUARIO:</label><br>
                    <input type="text" id="titulo" name="titulo" placeholder="Título do usuario" value="<?php echo htmlspecialchars($titulo ?? ''); ?>"><br>

                    <label for="email">EMAIL do USUARIO:</label><br>
                    <input type="email" id="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required><br>
                    <label for="senha">SENHA do USUARIO:</label><br>
                    <input type="password" id="senha" name="senha" placeholder="Senha" required><br><br>
                    <button type="submit">Cadastrar</button>
        </form>
        </div>
        <div style="border-left: 2px solid black; height: 100%;"></div>

        <div>
        <h2>Login do Usuário</h2>
        
        <?php if (isset($error) && ($errorType ?? '') === 'login'): ?>
            <div style="color: red; margin: 10px; padding: 10px; background-color: #ffe6e6; border-left: 4px solid red;">
                <strong>Erro:</strong> <?php echo ($error); ?>
            </div>
        <?php endif; ?>
        
        <form style="text-align: center;padding-top: 50px;height: 10%;" action="/ProjetãoAlfa/turma25MVC/public/login" method="POST">
                    <label for="email">EMAIL do USUARIO:</label>
                    <input type="email" id="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($loginEmail ?? ''); ?>" required><br>
                    <label for="senha">SENHA do USUARIO:</label>
                    <input type="password" id="senha" name="senha" placeholder="Senha" required><br><br>
                    <button type="submit">Logar</button>
                </form>
        </div>

    </div>

    
    
</body>
</html>