<?php
   $servidor = "localhost";
   $usuario = "root";
   $clave = ""; // Reemplaza con tu contraseña
   $baseDeDatos = "pacientes";

   $enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

   // Verificar la conexión
   if (!$enlace) {
       die("Conexión fallida: " . mysqli_connect_error());
   }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Datos</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 18px;
            text-align: left;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Datos de Pacientes</h1>
    <form action="" method="get">
        <input type="text" name="buscarNombre" placeholder="Buscar por nombre">
        <input type="submit" value="Buscar">
    </form>
    <?php
    // Filtrar los datos de la base de datos según el nombre buscado
    $consulta = "SELECT * FROM datos";
    if (isset($_GET['buscarNombre']) && !empty($_GET['buscarNombre'])) {
        $buscarNombre = mysqli_real_escape_string($enlace, $_GET['buscarNombre']);
        $consulta .= " WHERE Nombre LIKE '%$buscarNombre%'";
    }

    $resultado = mysqli_query($enlace, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th>ID</th>'; // Nueva columna para ID
        echo '<th>Nombre</th>';
        echo '<th>Edad</th>';
        echo '<th>Peso</th>';
        echo '<th>Sexo</th>';
        echo '<th>Diagnóstico</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo '<tr>';
            echo '<td>' . $fila['id'] . '</td>'; // Nueva columna para ID
            echo '<td>' . $fila['Nombre'] . '</td>';
            echo '<td>' . $fila['Edad'] . '</td>';
            echo '<td>' . $fila['Peso'] . '</td>';
            echo '<td>' . $fila['Sexo'] . '</td>';
            echo '<td>' . $fila['Diagnostico'] . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo "No hay datos para mostrar.";
    }

    // Cerrar la conexión
    mysqli_close($enlace);
    ?>
</body>
</html>


