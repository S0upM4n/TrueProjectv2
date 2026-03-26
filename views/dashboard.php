<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background-color: rgb(128, 187, 189);margin: 0;
    padding: 0;">
    


    
<header style="width: 100%; height: 50%; background-color: #80bfff;position:relative;top: -20px; left: 0; padding: 0;">
        <h1 style="font-family: Geneva, Tahoma, sans-serif; text-align: center;">Dashboard</h1><br><br>
   <div style="position: relative;top:-40px">
        <h1>Bem-vindo ao Dashboard, <?php echo htmlspecialchars($_SESSION['nome'] ?? 'Usuário'); ?>!</h1>
        <p>Este é o seu painel de controle. Aqui você pode acessar suas informações e e entrar ou criar salas.</p>
        <p>Email: <?php echo htmlspecialchars($_SESSION['email'] ?? 'N/A'); ?></p>
        <p>Título: <?php echo htmlspecialchars($_SESSION['titulo'] ?? 'N/A'); ?></p>
        <a href="/ProjetãoAlfa/turma25MVC/public/logout">Sair</a>



    </div>
</header>


        <div style="background-color:lightgray;width: 23vw;;display:flex; flex-direction:column;flex-wrap:wrap; height:25vh; border-radius: 10px;z-index:9; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); padding-left:10px; box-sizing: border-box;position:relative;top:-280px;left:70vw">
            <h2 style="padding-left: 10px;">Suas Informações:</h2>
            <div style="background: #f0f0f0; width:100px; height:100px; border-radius: 5px; padding:10px; box-sizing: border-box;border: 10px solid #34463d; border-radius: 50%;"><img src="https://cdn-icons-png.flaticon.com/512/6716/6716646.png" width="98px" height="98px" alt="userImage" style="position: relative;top:-19px; left:-18px;">   </div>
             <div style="position: relative; top:55px; left:-70px">   
                <p><strong>Nome:</strong> <?php echo ($_SESSION['nome']); ?><a href=""> </a></p>
                <p><strong>Email:</strong> <?php echo ($_SESSION['email']); ?></p>
                <p><strong>Título:</strong> <?php echo ($_SESSION['titulo']); ?> <a href=""> </a></p>

                <h2><a href="/ProjetãoAlfa/turma25MVC/public/editProfile">editar dados</a></h2>
            </div>
        </div>




<div style="display: flex; flex-direction: row; gap: 5%; justify-content: center; margin-top: -90px;">
     <div style="background-color: whitesmoke; height: 350px; width: 45%;">
        <h2 style="margin-left: 50px;font-size: 34px;">Criar uma Sala</h2>
        <br>
        <form style="text-align: center;" action="/ProjetãoAlfa/turma25MVC/public/Create" method="POST">
            <label for="salaNome">NOME da Sala:</label>
            <input type="text" id="salaNome" name="nome" required>
            <input type="submit" value="Criar">
        </form>
            <p style="text-align: center;">
                <?php
                if (isset($error) && $errorType === 'criarSala') {
                    echo $error;
                } elseif (isset($_SESSION['idsala'])) {
                    echo "sala criada com sucesso! <br> Entre na Sala com o seguinte ID: <br>" . $_SESSION['idsala'];
                    unset($_SESSION['idsala']);
                }
                ?>
            </p>
        <br>
       <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSwVSFao182UL5UjO89L2TXwxHU_oCJfLeTJg&s"width="150" height="100" alt="" style="position: relative; left: 40%;">
     </div>


     <div style="background-color: whitesmoke; height: 350px; width: 45%;">
        <h2 style="margin-left: 50px;font-size: 34px;">Entrar em uma Sala</h2>
        <br>
        <form style="text-align: center;" action="/ProjetãoAlfa/turma25MVC/public/Find" method="POST">
            <label for="ID">ID sa Sala:</label>
            <input type="text" id="ID" name="ID" required>
            <input type="submit" value="Entrar">
        </form>
        <p style="text-align: center;"><?php if (isset($error) && $errorType === 'entrarSala') { echo $error; } ?></p>
         <img src="https://thumbs.dreamstime.com/b/wooden-dice-join-business-word-close-up-concept-supports-png-files-transparent-backgrounds-403437195.jpg"width="150" height="100" alt="" style="position: relative; left: 40%;top:20px">
     </div>
     

</div>
</body>
</html>