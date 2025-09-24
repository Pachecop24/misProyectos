<?php
session_start();
require_once("../Conexion.php");

// Verificar si el usuario está logueado
if (!isset($_SESSION["idusuario"])) {
    header("Location: ../Front/login.php");
    exit();
}

$idusuario = $_SESSION["idusuario"];
$mensaje = "";

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descripcion = trim($_POST["descripcion"]);
    $estado = trim($_POST["estado"]);
    $notarea = trim($_POST["notarea"]);

    if (!empty($descripcion) && !empty($estado) && !empty($notarea)) {
        try {
            $db = new Conexion();
            $conexion = $db->obtenerConexion();

            $sql = "INSERT INTO tarea (idusuario, descripcion, estado, Notarea) 
                    VALUES (:idusuario, :descripcion, :estado, :notarea)";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":idusuario", $idusuario, PDO::PARAM_INT);
            $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
            $stmt->bindParam(":notarea", $notarea, PDO::PARAM_INT);

            if ($stmt->execute()) {
                // Redirigir de nuevo al panel
                header("Location: ../Front/inicio.php");
                exit();
            } else {
                $mensaje = "❌ Error al guardar la tarea.";
            }
        } catch (PDOException $e) {
            $mensaje = "❌ Error en la base de datos: " . $e->getMessage();
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
    <title>Agregar Tarea</title>
    <link rel="stylesheet" href="../Front/inicio.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <header class="header">
      <h2>➕ Agregar nueva tarea</h2>
    </header>

    <?php if ($mensaje): ?>
      <p style="color:red; text-align:center;"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <form method="POST" class="form-tarea">
      <label>Descripción:</label>
      <textarea name="descripcion" required></textarea>

      <label>Estado:</label>
      <select name="estado" required>
        <option value="Pendiente">Pendiente</option>
        <option value="En progreso">En progreso</option>
        <option value="Completada">Completada</option>
      </select>

      <label>N° Tarea:</label>
      <input type="number" name="notarea" min="1" required>

      <button type="submit" class="btn-agregar">Guardar tarea</button>
      <a href="../Front/inicio.php" class="btn-cancelar">Cancelar</a>
    </form>
  </div>
</body>
</html>
