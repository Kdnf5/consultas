<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    http_response_code(401); // No autorizado
    echo json_encode(['error' => 'No estás autenticado']);
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuarios_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    http_response_code(500); // Error interno del servidor
    echo json_encode(['error' => 'Error en la conexión a la base de datos']);
    exit();
}

// Preparar y ejecutar la consulta
$sql = "SELECT nombre, apellidos, foto FROM usuarios WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['usuario']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode([
        'nombre' => $row['nombre'],
        'apellidos' => $row['apellidos'],
        'foto' => $row['foto']
    ]);
} else {
    http_response_code(404); // No encontrado
    echo json_encode(['error' => 'Usuario no encontrado']);
}

$stmt->close();
$conn->close();
?>

