<?php
header('Content-Type: application/json');

// Conectar a la base de datos
$servidor = "localhost";
$usuario = "root";
$clave = ""; // Contraseña de tu base de datos
$baseDeDatos = "pacientes";

$conexion = new mysqli($servidor, $usuario, $clave, $baseDeDatos);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consultar los datos
$query = "SELECT Id, Nombre, Edad, Sexo FROM datos";
$resultado = $conexion->query($query);

$data = array();
while ($row = $resultado->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode(array("data" => $data));

$conexion->close();
?>
