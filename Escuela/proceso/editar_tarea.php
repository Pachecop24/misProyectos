<?php
session_start();
require_once("../Logica/clases.php");

if (!isset($_SESSION["idusuario"])) {
    header("Location: ../Front/login.php");
    exit();
}

$idusuario = $_SESSION["idusuario"];
$tareaObj = new Tarea();

if (!isset($_GET["id"])) {
    header("Location: ../Front/inicio.php");
    exit();
}

$idtarea = intval($_GET["id"]);
$tarea = $tareaObj->obtenerPorId($idtarea, $idusuario);

if (!$tarea) {
    echo "⚠️ Tarea no encontrada o no tienes permiso para editarla.";
    exit();
}

$mensaje = "";

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descripcion = trim($_POST["descripcion"]);
    $estado = trim($_POST["estado"]);
    $notarea = trim($_POST["notarea"]);

    if (!empty($descripcion) && !empty($estado) && !empty($notarea)) {
        if ($tareaObj->editarTarea($idtarea, $idusuario, $descripcion, $estado, $notarea)) {
            header("Location: ../Front/inicio.php");
            exit();
        } else {
            $mensaje = "❌ Error al actualizar la tarea.";
        }
    } else {
        $mensaje = "⚠️ Todos los campos son obligatorios.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Tarea</title>
  <link rel="stylesheet" href="../Front/inicio.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container">
    <header class="header">
      <h2>✏️ Editar tarea</h2>
    </header>

    <?php if ($mensaje): ?>
      <p style="color:red; text-align:center;"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <form method="POST" class="form-tarea">
      <label>Descripción:</label>
      <textarea name="descripcion" required><?php echo htmlspecialchars($tarea["descripcion"]); ?></textarea>

      <label>Estado:</label>
      <select name="estado" required>
        <option value="Pendiente" <?php if($tarea["estado"]=="Pendiente") echo "selected"; ?>>Pendiente</option>
        <option value="En progreso" <?php if($tarea["estado"]=="En progreso") echo "selected"; ?>>En progreso</option>
        <option value="Completada" <?php if($tarea["estado"]=="Completada") echo "selected"; ?>>Completada</option>
      </select>

      <label>N° Tarea:</label>
      <input type="number" name="notarea" min="1" required value="<?php echo htmlspecialchars($tarea["Notarea"]); ?>">

      <button type="submit" class="btn-agregar">Actualizar tarea</button>
      <a href="../Front/inicio.php" class="btn-cancelar">Cancelar</a>
    </form>
  </div>
</body>
</html>
