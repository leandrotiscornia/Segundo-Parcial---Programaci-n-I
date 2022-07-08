<?php 
    require "../utils/autoload.php";

     if(isset($_SESSION['autenticado']))
        header("Location: /");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Fabrica de Chacinados - Bienvenido</h1>
    
    <form action="/login" method="post">
        Usuario <input type="text" name="usuario"> <br />
        Password <input type="password" name="password"> <br />
        <input type="submit" value="Iniciar Sesión">
    </form>

    <a href="/usuarios/alta">Crear Usuario</a> <br /><br />
    
    <?php if(isset($parametros['error']) && $parametros['error'] === true ) :?>
        <div style="color: red;">Credenciales invalidas.</div>
    <?php endif;?>

    
</body>
</html>