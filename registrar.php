<?php
// --- CONFIGURACIÓN DE CONEXIÓN ---
$host     = "localhost";      
$usuario  = "mytransfor7c";      
$password = "33Vdeadmin..";     
$dbname   = "bdalumnos"; 

// Crear la conexión con control de errores silencioso
mysqli_report(MYSQLI_REPORT_OFF);
$conexion = @new mysqli($host, $usuario, $password, $dbname);

// Comprobar si la conexión funciona
if ($conexion->connect_error) {
    die("Error de conexión: Parece que el usuario, contraseña o nombre de BD en cdmon son incorrectos.");
}

// Configurar tildes y eñes
$conexion->set_charset("utf8mb4");

// --- PROCESAMIENTO DEL FORMULARIO ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibimos y limpiamos espacios en blanco
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $curso  = trim($_POST['curso']);

    // Validar que no lleguen vacíos desde el servidor
    if (empty($nombre) || empty($correo) || empty($curso)) {
        die("Error: Todos los campos son obligatorios.");
    }

    // Preparar la inserción segura (Previene Inyección SQL)
    $stmt = $conexion->prepare("INSERT INTO alumnos (nombre, correo, curso) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $correo, $curso);

    // Ejecutar y dar respuesta
    if ($stmt->execute()) {
        echo "<html><body style='font-family:sans-serif; text-align:center; padding-top:50px;'>";
        echo "<h2 style='color:green;'>✅ ¡Registro Completado!</h2>";
        echo "<p>El alumno <b>" . htmlspecialchars($nombre) . "</b> ha sido dado de alta correctamente.</p>";
        echo "<br><a href='index.html' style='text-decoration:none; background:#007bff; color:white; padding:10px 20px; border-radius:5px;'>Registrar otro alumno</a>";
        echo "</body></html>";
    } else {
        echo "Error al guardar los datos: " . $stmt->error;
    }

    $stmt->close();
}

$conexion->close();
?>