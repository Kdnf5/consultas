<?php
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
    $especialidad = $_POST['especialidad'];
    $edad = $_POST['edad'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $usuario = $_POST['usuario'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT); // Hash de la contraseña
    $foto = '';

    // Manejo de la carga de la imagen
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $foto_tmp = $_FILES['foto']['tmp_name'];
        $foto_nombre = basename($_FILES['foto']['name']);
        $foto_destino = "uploads/" . $foto_nombre;
        
        // Crear directorio si no existe
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }

        // Mover archivo a la carpeta de destino
        if (move_uploaded_file($foto_tmp, $foto_destino)) {
            $foto = $foto_destino;
        } else {
            echo "Error al subir la foto.";
            exit;
        }
    }

    $sql = "INSERT INTO usuarios (especialidad, edad, nombre, apellidos, usuario, contraseña, foto) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisssss", $especialidad, $edad, $nombre, $apellidos, $usuario, $contraseña, $foto);

    if ($stmt->execute()) {
        echo "Nuevo usuario creado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
