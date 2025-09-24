<?php
session_start();
require_once("../Logica/clases.php");

if (!isset($_SESSION["idusuario"])) {
    header("Location: ../Front/inicio.php");
    exit();
}

if (isset($_GET["id"])) {
    $idtarea = intval($_GET["id"]);
    $idusuario = $_SESSION["idusuario"];

    $tareaObj = new Tarea();
    if ($tareaObj->eliminarTarea($idtarea, $idusuario)) {
        header("Location: ../Front/inicio.php");
        exit();
    } else {
        echo "❌ Error al eliminar la tarea.";
    }
} else {
    header("Location: ../Front/inicio.php");
    exit();
}
?>
