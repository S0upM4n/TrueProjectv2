<?php
if ($_SESSION['Sala'] === null) {
    header('Location: /ProjetãoAlfa/turma25MVC/public/dashboard');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="height: 95vh;background-color: rgb(24, 151, 201);;">
    <div style="display: flex; flex-direction:row; width:100%; justify-content: space-between">
        <div style="background-color: palevioletred; width:20vw; height:45vh;padding:20px;box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); box-sizing: border-box; border-radius: 10px; text-align: center; ;">
        <h1>Nome da Sala: <br> <?php echo ($_SESSION['Sala']); ?></h1>
        <p>Bem-vindo à sala, <?php echo ($_SESSION['nome']); ?>!</p>
        <p>Aqui você pode interagir com outros participantes da sala.</p>
    
        <a href="/ProjetãoAlfa/turma25MVC/public/RoomOut" style="position:relative;top:-10px"><h2>Sair da Sala</h2></a>
        </div>


        <div style="background-color:lightseagreen;width:20vw; height:25vh; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); padding-left:10px; box-sizing: border-box;">
            <h2>Informações da Sala</h2>
            <p><strong>Nome da Sala:</strong> <?php echo ($_SESSION['Sala']); ?></p>
            <p><strong>Criador da Sala:</strong> <?php echo ($_SESSION['criadorSala']); ?></p>
            <p><strong>Data de Criação:</strong> <?php echo ($_SESSION['dataCriacaoSala']); ?></p>
        </div>
    </div>

        <div style="background-color:cadetblue;width: 23vw;;display:flex; flex-direction:column;flex-wrap:wrap; height:25vh; border-radius: 10px;z-index:9; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); padding-left:10px; box-sizing: border-box;position:relative;top:150px;">
            <h2 style="padding-left: 10px;">Suas Informações:</h2>
            <div style="background: #f0f0f0; width:100px; height:100px; border-radius: 5px; padding:10px; box-sizing: border-box;border: 10px solid #5c806f; border-radius: 50%;"><img src="https://cdn-icons-png.flaticon.com/512/6716/6716646.png" width="98px" height="98px" alt="userImage" style="position: relative;top:-19px; left:-18px;">   </div>
             <div style="position: relative; top:55px; left:-70px">   
                <p><strong>Nome:</strong> <?php echo ($_SESSION['nome']); ?><a href=""> </a></p>
                <p><strong>Email:</strong> <?php echo ($_SESSION['email']); ?></p>
                <p><strong>Título:</strong> <?php echo ($_SESSION['titulo']); ?> <a href=""> </a></p>
            </div>
        </div>

        <div style="height:100vh;width:50vw;background-color:cornflowerblue; margin:auto; position:relative; top:-71.1vh; z-index:0; border: 3px solid #4588c7;border-radius: 10px;">
             <div style="background-color:aliceblue; width:90%; height:80%; margin:auto; margin-top: 40px; border-radius: 10px; padding:10px; box-sizing: border-box;overflow-y: scroll;" id="messages-container" data-current-user="<?php echo $_SESSION['nome']; ?>">

                <?php 
                if(isset($messages)){
                    echo "<h2 style='color: #333;margin-left: 10px; font-size: 1.5em; margin-bottom: 10px;'>Mensagens da Sala:</h2> <hr>";
                }
                foreach ($messages as $message): ?>
                    <p><strong><?php  if($message['nome']!==$_SESSION['nome']){echo "<div style='color: #333; font-weight: bold; background-color: #f0f0f0; padding: 5px; border-radius: 5px; width: 400px;'>" . $message['nome'] . " [$message[titulo]]". "</div>";}else {echo "<div style='margin-left: 45%;color: #ffffff; font-weight: bold; background-color: #3a504b; padding: 5px; border-radius: 5px; width: 400px;'>" . $message['nome'] . " [$message[titulo]]". "</div>";} ?>
                </strong> <?php if($message['nome']!==$_SESSION['nome']){echo "<div style='background-color: #f9f9f9; padding: 5px; border-radius: 5px; width: 400px; margin-bottom: 10px;position:relative;bottom: -10px;'>" . $message['mensagem'] . "</div><br><br>";}else{echo "<div style='margin-left: 45%;background-color: #838a88; color: #ffffff; padding: 5px; border-radius: 5px; width: 400px;position:relative;bottom: -10px;'>" . $message['mensagem'] . "</div><br><br>";} ?></p>
                <?php endforeach;  ?>
            </div>
        </div>

        <div style="border-bottom:darkblue 5px solid;background-color:cornflowerblue;width:40vw; height:13vh;  box-shadow: 0px 4px 8px rgba(-5px, 0, 0, 0.2); padding-left:10px; box-sizing: border-box;position:relative;top:-89vh;left:30vw">
            <h4 style="position: relative;top:10px">Mande mensagens por aqui</h4>

            <form action="/ProjetãoAlfa/turma25MVC/public/sendMessage" method="POST" id="message-form">
                <input type="text" name="message" placeholder="Digite sua mensagem..." style="width:80%; padding:10px; border-radius: 5px; border:1px solid #ccc;">
                <button type="submit" style="padding:10px 20px; border:none; border-radius: 5px; background-color: #4CAF50; color:white;">Enviar</button>
            </form>


            <div style="width: 21vw;height:60vh; background-color: white; border: 1px solid #929292; padding: 10px; box-sizing: border-box; position:relative;top:-30vw;left:47vw;border-radius: 10px;">

                    <?php $add=rand(1, 3);
                    switch($add){ 
                    case 1: echo "<img src='/images/hds.jpg' alt='Anúncio 1' style='width: 100%; height: auto;'>"; break; 
                    case 2: echo "<img src='/images/lulu.jpg' alt='Anúncio 2' style='width: 100%; height: auto;'>"; break; 
                    case 3: echo "<img src='/images/guizao.jpg' alt='Anúncio 3' style='width: 100%; height: auto;'>"; break; 
                     } ?>
                    <!-- Lista de anuncios checks-->
                </ul>
            </div>

        
</div>
<script>
function loadMessages() {
    fetch('/ProjetãoAlfa/turma25MVC/public/getMessages')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('messages-container');
            const currentUser = container.dataset.currentUser;

            // ✅ Check if user is near bottom BEFORE update
            const isAtBottom = container.scrollTop + container.clientHeight >= container.scrollHeight - 10;

            // ✅ Save scroll position
            const scrollOffset = container.scrollHeight - container.scrollTop;

            let html = '<h2 style="color: #333;margin-left: 10px; font-size: 1.5em; margin-bottom: 10px;">Mensagens da Sala:</h2><hr><br>';

            data.forEach(msg => {
                if (msg.nome !== currentUser) {
                    html += `
                    <div style="color: #333; font-weight: bold; background-color: #f0f0f0; padding: 5px; border-radius: 5px; width: 400px;">
                        ${msg.nome} [${msg.titulo}]
                    </div>
                    <div style="background-color: #f9f9f9; padding: 5px; border-radius: 5px; width: 400px; margin-bottom: 10px;">
                        ${msg.mensagem}
                    </div><br><br>
                    `;
                } else {
                    html += `
                    <div style="margin-left: 45%; color: #ffffff; font-weight: bold; background-color: #3a504b; padding: 5px; border-radius: 5px; width: 400px;">
                        ${msg.nome} [${msg.titulo}]
                    </div>
                    <div style="margin-left: 45%; background-color: #838a88; color: #ffffff; padding: 5px; border-radius: 5px; width: 400px;">
                        ${msg.mensagem}
                    </div><br><br>
                    `;
                }
            });

            // ✅ Update messages
            container.innerHTML = html;

            // ✅ Smart scroll behavior
            if (isAtBottom) {
                container.scrollTop = container.scrollHeight; // stay at bottom
            } else {
                container.scrollTop = container.scrollHeight - scrollOffset; // keep position
            }
        })
        .catch(error => console.error('Error loading messages:', error));
}


// ✅ Send message without reloading page
document.getElementById('message-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            this.querySelector('input[name="message"]').value = '';
            loadMessages(); // reload messages after sending
        }
    })
    .catch(error => console.error('Error sending message:', error));
});


// ✅ Auto refresh every 3 seconds
setInterval(loadMessages, 3000);


// ✅ Load messages when page opens
window.onload = loadMessages;
</script>

</body>
</html>