<?php
class Conexion {
    private $host = "localhost";   // Servidor
    private $db   = "escuela";     // Nombre de tu base de datos
    private $user = "root";        // Usuario de tu BD
    private $pass = "play.minelc103";            // Contraseña de tu BD
    private $charset = "utf8mb4";  // Codificación

    public function obtenerConexion() {
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
            $pdo = new PDO($dsn, $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            die("❌ Error en la conexión: " . $e->getMessage());
        }
    }
}
?>
