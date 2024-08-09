<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuarios_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Preparar y ejecutar la consulta
    $sql = "SELECT nombre, apellidos, contraseña, foto FROM usuarios WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verificar la contraseña
        if (password_verify($contrasena, $row['contraseña'])) {
            // Autenticación exitosa, iniciar sesión
            $_SESSION['usuario'] = $usuario;
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['apellidos'] = $row['apellidos'];
            $_SESSION['foto'] = $row['foto'];
            // Redirigir a la página principal o perfil
            header("Location: Inicio.html");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    $stmt->close();
}

$conn->close();
?>
