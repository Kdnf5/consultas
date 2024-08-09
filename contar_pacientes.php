<?php
header('Content-Type: application/json');

$servidor = "localhost";
$usuario = "root";
$clave = ""; // Reemplaza con tu contraseña
$baseDeDatos = "pacientes";

$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

// Verificar la conexión
if (!$enlace) {
    http_response_code(500); // Error interno del servidor
    echo json_encode(['error' => 'Error en la conexión a la base de datos']);
    exit();
}

// Contar el número total de pacientes
$sql = "SELECT COUNT(*) AS total FROM datos";
$resultado = mysqli_query($enlace, $sql);

if ($resultado) {
    $fila = mysqli_fetch_assoc($resultado);
    echo json_encode(['total' => $fila['total']]);
} else {
    http_response_code(500); // Error interno del servidor
    echo json_encode(['error' => 'Error al contar los pacientes']);
}

mysqli_close($enlace);
?>
