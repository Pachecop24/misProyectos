<?php 
session_start();

require_once "../Logica/clases.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["user"];
    $pasword = $_POST["pasword"];

    $login = new Login();
    $login->loggin($user, $pasword);
} else {
    header("Location: ../Front/login.php");
    exit();
}
?>
