<?php 

require_once ("../Conexion.php");

class Registro {
    private $conexion;

    public function __construct(){
        $db = new Conexion();
        $this->conexion = $db->obtenerConexion(); //
    }

    public function agregar($user, $pasword){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = trim($_POST['user']);
            $pasword = trim($_POST['pasword']);

            if (empty($user) || empty($pasword)) {
                echo "El usuario y la contraseña son obligatorios";
                exit();
            }

            
            $check = $this->conexion->prepare("SELECT idusuario FROM usuario WHERE Nombre = :user");
            $check->bindParam(":user", $user, PDO::PARAM_STR);
            $check->execute();

            if ($check->rowCount() > 0) {
                echo "El usuario ya existe, elige otro nombre";
                exit();
            }

            
            $hashedPassword = password_hash($pasword, PASSWORD_DEFAULT);
            $idtarea = 1;

            
            $sql = $this->conexion->prepare("INSERT INTO usuario (Nombre, pasword) VALUES (:user, :pasword)");
            $sql->bindParam(":user", $user, PDO::PARAM_STR);
            $sql->bindParam(":pasword", $hashedPassword, PDO::PARAM_STR);
            

            if ($sql->execute()) {
                header("location:../proceso/registro.php");
                exit();
            } else {
                echo "Error al registrar usuario";
            }
        }
    }
}


class Login {
    private $conexion;

    public function __construct(){
        $sql = new Conexion();
        $this->conexion = $sql->obtenerConexion(); 
    }

    public function loggin($user, $pasword){
        try {
            $sql = "SELECT idusuario, Nombre, pasword FROM usuario WHERE Nombre = :usuario LIMIT 1";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(":usuario", $user, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if (password_verify($pasword, $row["pasword"])) {
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }

                    $_SESSION["idusuario"] = $row["idusuario"];
                    $_SESSION["Nombre"] = $row["Nombre"];

                    header("Location: ../Front/inicio.php");
                    exit();
                } else {
                    echo "<script>alert('Contraseña incorrecta'); window.location.href='../Front/login.php';</script>";
                }
            } else {
                echo "<script>alert('Usuario no encontrado'); window.location.href='../Front/login.php';</script>";
            }
        } catch (PDOException $e) {
            echo "Error en la base de datos: " . $e->getMessage();
        }
    }
}

class Tarea {
    private $conexion;

    public function __construct() {
        $db = new Conexion();
        $this->conexion = $db->obtenerConexion();
    }

    // 🔹 Obtener tareas por usuario
    public function obtenerPorUsuario($idusuario) {
        $sql = "SELECT idtarea, descripcion, estado, Notarea 
                FROM tarea 
                WHERE idusuario = :idusuario";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":idusuario", $idusuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // 🔹 Agregar tarea
    public function agregarTarea($idusuario, $descripcion, $estado, $notarea) {
        $sql = "INSERT INTO tarea (idusuario, descripcion, estado, Notarea) 
                VALUES (:idusuario, :descripcion, :estado, :notarea)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":idusuario", $idusuario, PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":notarea", $notarea, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // 🔹 Eliminar tarea
    public function eliminarTarea($idtarea, $idusuario) {
        $sql = "DELETE FROM tarea WHERE idtarea = :idtarea AND idusuario = :idusuario";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":idtarea", $idtarea, PDO::PARAM_INT);
        $stmt->bindParam(":idusuario", $idusuario, PDO::PARAM_INT);
        return $stmt->execute();
    }
    // 🔹 Obtener tarea por ID (para editar)
public function obtenerPorId($idtarea, $idusuario) {
    $sql = "SELECT * FROM tarea WHERE idtarea = :idtarea AND idusuario = :idusuario";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindParam(":idtarea", $idtarea, PDO::PARAM_INT);
    $stmt->bindParam(":idusuario", $idusuario, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
}

// 🔹 Editar tarea
public function editarTarea($idtarea, $idusuario, $descripcion, $estado, $notarea) {
    $sql = "UPDATE tarea 
            SET descripcion = :descripcion, estado = :estado, Notarea = :notarea 
            WHERE idtarea = :idtarea AND idusuario = :idusuario";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
    $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
    $stmt->bindParam(":notarea", $notarea, PDO::PARAM_INT);
    $stmt->bindParam(":idtarea", $idtarea, PDO::PARAM_INT);
    $stmt->bindParam(":idusuario", $idusuario, PDO::PARAM_INT);
    return $stmt->execute();
    }
}
class Frase {
    private $conexion;

    public function __construct() {
        $db = new Conexion();
        $this->conexion = $db->obtenerConexion();
    }

    // 🔹 Obtener frase motivacional aleatoria
    public function obtenerAleatoria() {
        $sql = "SELECT texto, autor FROM frase ORDER BY RAND() LIMIT 1";
        $stmt = $this->conexion->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}
?>
