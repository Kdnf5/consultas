<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinica";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Capturar el término de búsqueda si está presente
$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

// Ajustar la consulta SQL según el término de búsqueda
$sql = "SELECT * FROM pacientes";
if ($searchTerm) {
    $sql .= " WHERE nombre LIKE '%$searchTerm%' OR apellido LIKE '%$searchTerm%'";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes Registrados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1000px;
        }

        h1 {
            text-align: center;
        }

        .search-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .search-input {
            padding: 5px;
            font-size: 1em;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .search-button {
            padding: 5px 10px;
            border: none;
            color: #fff;
            background-color: #007bff;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 5px;
        }

        .search-button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
            word-wrap: break-word;
        }

        th {
            background-color: #f2f2f2;
        }

        .back-button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: #fff;
            text-align: center;
            text-decoration: none;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pacientes Registrados</h1>
        <div class="search-container">
            <form action="" method="post">
                <input type="text" name="search" class="search-input" placeholder="Buscar por nombre o apellido" value="<?php echo htmlspecialchars($searchTerm); ?>">
                <button type="submit" class="search-button">Buscar</button>
            </form>
        </div>
        <table>
            <tr>
                <th>Apellido</th>
                <th>Nombre</th>
                <th>Domicilio</th>
                <th>Fecha de Ingreso</th>
                <th>Hora de Ingreso</th>
                <th>Fecha de Nacimiento</th>
                <th>Sexo</th>
                <th>Estado Civil</th>
                <th>Ocupación</th>
                <th>Diagnóstico</th>
                <th>Doctor</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['apellido']}</td>
                            <td>{$row['nombre']}</td>
                            <td>{$row['domicilio']}</td>
                            <td>" . date('d/m/Y', strtotime($row['fecha_ingreso'])) . "</td>
                            <td>{$row['hora_ingreso']}</td>
                            <td>" . date('d/m/Y', strtotime($row['fecha_nacimiento'])) . "</td>
                            <td>{$row['sexo']}</td>
                            <td>{$row['estado_civil']}</td>
                            <td>{$row['ocupacion']}</td>
                            <td>{$row['diagnostico']}</td>
                            <td>{$row['doctor']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='11'>No hay registros</td></tr>";
            }
            $conn->close();
            ?>
        </table>
        <a href="inicio.html" class="back-button">Regresar</a>
    </div>
</body>
</html>



