<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php if (isset($error)): ?>
    <div style="color: red; margin-bottom: 20px;">
        <strong>Erro:</strong> <?php echo htmlspecialchars($error); ?>
    </div>
<?php endif; ?>
<div style="border: 2px solid black; width:40vw;height:50vh;background-color: lightgray; margin: auto; margin-top: 50px; border-radius: 10px; padding: 20px; box-sizing: border-box;">
    <form action="/ProjetãoAlfa/turma25MVC/public/updateProfile" method="post">

        <label>Nome: <input type="text"  style="width: 100%;height:5vh;" name="nome" value="<?php echo htmlspecialchars($_SESSION['nome'] ?? ''); ?>" required></label><br><br>
        <label>Email: <input type="email"  style="width: 100%; height:5vh;" name="email" value="<?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>" required></label><br><br>
        <label>Título: <input type="text"  style="width: 100%; height:5vh;" name="titulo" value="<?php echo htmlspecialchars($_SESSION['titulo'] ?? ''); ?>" required></label><br> <br>
        <input type="submit" style="width: 10vh; height: 5vh;" value="Inserir dados">

    </form>
</div>
    
</body>
</html>