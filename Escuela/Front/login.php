<?php 
session_start();
?>

<!DOCTYPE html> 
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styleL.css" rel="stylesheet">
</head>
<body>
    
    <h2 class="titulo">Inicia sesión</h2>

    
    <div class="form-container">
        <form action="../proceso/validacion.php" method="post">
            <label>Usuario:</label>
            <input type="text" name="user" required><br>

            <label>Contraseña:</label>
            <input type="password" name="pasword" required><br><br>

            <button type="submit">Entrar</button><br>
                <a href="registro.html">
            <button type="button">Registro</button>
                
            </a>
        </form>
    </div>
</body>
</html>
