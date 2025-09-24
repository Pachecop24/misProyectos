<?php
session_start();
require_once("../Conexion.php");
require_once("../Logica/clases.php");



if (!isset($_SESSION["idusuario"])) {
    header("Location: login.php");
    exit();
}

$idusuario = $_SESSION["idusuario"];
$nombre = $_SESSION["Nombre"];


$db = new Conexion();
$conexion = $db->obtenerConexion();


try {
    $sql = "SELECT idtarea, descripcion, estado, Notarea 
            FROM tarea 
            WHERE idusuario = :idusuario";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(":idusuario", $idusuario, PDO::PARAM_INT);
    $stmt->execute();
    $tareas = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error al obtener tareas: " . $e->getMessage());
}
$fraseObj = new Frase();
$frase = $fraseObj->obtenerAleatoria();

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Tareas</title>
  <link rel="stylesheet" href="inicio.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container">
    <header class="header">
  <div class="logo">
    <img src="./imagen/L.jpg" alt="L">
  </div>
  <div class="username">
    <?php echo htmlspecialchars($nombre); ?>
  </div>
</header>


    <div class="frase-motivacional" style="margin:20px; padding:15px; background:#f0f0f0; border-radius:8px;">
      <blockquote>
          "<?php echo $frase['texto']; ?>"
          <footer>— <?php echo $frase['autor']; ?></footer>
      </blockquote>
    </div>


    <main class="tareas">
      <div class="tareas-header">
        <h2>📋 Mis Tareas</h2>
        <a href="../proceso/agregar_tarea.php" class="btn-agregar">➕ Agregar tarea</a>
      </div>

      <?php if ($tareas): ?>
        <?php foreach ($tareas as $tarea): ?>
  <div class="tarea">
    <p><strong>Tarea #:</strong> <?php echo htmlspecialchars($tarea["Notarea"]); ?></p>
    <p><strong>Descripción:</strong> <?php echo htmlspecialchars($tarea["descripcion"]); ?></p>
    <p><strong>Estado:</strong> <?php echo htmlspecialchars($tarea["estado"]); ?></p>
    
    <!-- Botón Eliminar -->
    <a href="../proceso/editar_tarea.php?id=<?php echo $tarea['idtarea']; ?>" class="btn-editar">✏️ Editar</a>
    <a href="../proceso/eliminar_tarea.php?id=<?php echo $tarea['idtarea']; ?>" 
       class="btn-eliminar" 
       onclick="return confirm('¿Seguro que deseas eliminar esta tarea?');">
       🗑️ Eliminar
    </a>
    
  </div>
  
<?php endforeach; ?>

      <?php else: ?>
        <p>No tienes tareas asignadas.</p>
      <?php endif; ?>
    </main>
  </div>

  
  <a href="../proceso/logout.php" class="btn-logout">🚪 Logout</a>
</body>
</html>
