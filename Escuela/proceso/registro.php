<?php
    require_once("../Logica/clases.php");
  

    $user=$_POST["user"] ?? '';
    $pasword=$_POST["pasword"] ??'';

    if($user && $pasword){
        $registro = new registro();
        $registro->agregar($user, $pasword);

    }

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Front/styleL.css" rel="stylesheet">
    <div class="form-container">
        <form action="../Front/login.php" method="post">
            <label>Usuario registrado</label>
            <button type="submit">Iniciar sesion</button> 


        </form>

    </div>                
    </head>
</html>