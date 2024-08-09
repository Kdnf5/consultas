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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $apellido = $_POST['apellido'];
    $nombre = $_POST['nombre'];
    $domicilio = $_POST['domicilio'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $hora_ingreso = $_POST['hora_ingreso'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $sexo = $_POST['sexo'];
    $estado_civil = $_POST['estado_civil'];
    $ocupacion = $_POST['ocupacion'];
    $diagnostico = $_POST['diagnostico'];
    $doctor = $_POST['doctor'];

    $sql = "INSERT INTO pacientes (apellido, nombre, domicilio, fecha_ingreso, hora_ingreso, fecha_nacimiento, sexo, estado_civil, ocupacion, diagnostico, doctor)
            VALUES ('$apellido', '$nombre', '$domicilio', STR_TO_DATE('$fecha_ingreso', '%d/%m/%Y'), '$hora_ingreso', STR_TO_DATE('$fecha_nacimiento', '%d/%m/%Y'), '$sexo', '$estado_civil', '$ocupacion', '$diagnostico', '$doctor')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro guardado con éxito.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Médico</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
            width: 800px;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        header img {
            width: 150px;
        }

        header h1 {
            font-size: 1.5em;
            margin: 0;
        }

        form fieldset {
            border: none;
            padding: 0;
        }

        form legend {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .form-group label {
            width: 20%;
        }

        .form-group input[type="text"],
        .form-group select {
            width: 75%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group input[type="radio"] {
            margin-right: 5px;
        }

        form button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            color: #fff;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        form button:hover {
            background-color: #218838;
        }

        .form-group-inline {
            display: flex;
            align-items: center;
        }

        .form-group-inline label {
            margin-right: 10px;
        }

        .form-group-inline input[type="text"] {
            width: auto;
        }

        .form-group img {
            width: 150px;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
        }

        .form-row .form-group {
            width: 48%;
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#fecha_ingreso, #fecha_nacimiento").datepicker({
                dateFormat: "dd/mm/yy"
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <header>
            <img src="utp.jpg" alt="Universidad Tecnológica de Puebla">
            <h1>REGISTRO MÉDICO<br>UTP</h1>
        </header>
        <form action="" method="POST">
            <fieldset>
                <legend>Datos del Paciente</legend>
                <div class="form-row">
                    <div class="form-group">
                        <label for="apellido">Apellidos:</label>
                        <input type="text" id="apellido" name="apellido">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombres:</label>
                        <input type="text" id="nombre" name="nombre">
                    </div>
                </div>
                <div class="form-group">
                    <label for="domicilio">Domicilio:</label>
                    <input type="text" id="domicilio" name="domicilio">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="fecha_ingreso">Fecha de Ingreso (DD/MM/AAAA):</label>
                        <input type="text" id="fecha_ingreso" name="fecha_ingreso">
                    </div>
                    <div class="form-group">
                        <label for="hora_ingreso">Hora de Ingreso (24H):</label>
                        <input type="text" id="hora_ingreso" name="hora_ingreso">
                    </div>
                </div>
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento (DD/MM/AAAA):</label>
                    <input type="text" id="fecha_nacimiento" name="fecha_nacimiento">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="sexo">Sexo:</label>
                        <div class="form-group-inline">
                            <input type="radio" id="masculino" name="sexo" value="Masculino">
                            <label for="masculino">Masculino</label>
                            <input type="radio" id="femenino" name="sexo" value="Femenino">
                            <label for="femenino">Femenino</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="estado_civil">Estado Civil:</label>
                        <select id="estado_civil" name="estado_civil">
                            <option value="soltero">Soltero</option>
                            <option value="casado">Casado</option>
                            <option value="divorciado">Divorciado</option>
                            <option value="viudo">Viudo</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ocupacion">Ocupación:</label>
                    <input type="text" id="ocupacion" name="ocupacion">
                </div>
                <div class="form-group">
                    <label for="diagnostico">Diagnóstico:</label>
                    <input type="text" id="diagnostico" name="diagnostico">
                </div>
                <div class="form-group">
                    <label for="doctor">Doctor:</label>
                    <select id="doctor" name="doctor">
                        <option value="doctor1">Doctor 1</option>
                        <option value="doctor2">Doctor 2</option>
                        <option value="doctor3">Doctor 3</option>
                    </select>
                </div>
            </fieldset>
            <button type="submit">Registrar Consulta</button>
        </form>
        <a href="inicio.html" class="back-button">Regresar</a>
    </div>
</body>
</html>
