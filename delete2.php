<?php
// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "Hafsa@2005", "proyecto_db");

// Verificamos la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Inicializamos variables para el mensaje
$mensaje = "";
$tipoMensaje = "";

if (isset($_GET['producto_id'])) {
    $id = intval($_GET['producto_id']);

    // Preparamos la consulta para eliminar
    $consulta = "DELETE FROM datos WHERE id = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $mensaje = "Máquina eliminada correctamente.";
        $tipoMensaje = "exito";
    } else {
        $mensaje = "Error al eliminar la máquina: " . $conexion->error;
        $tipoMensaje = "error";
    }

    $stmt->close();
} else {
    $mensaje = "ID no especificado.";
    $tipoMensaje = "error";
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Máquina</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('images/update.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .contenedor {
            max-width: 600px;
            margin: 100px auto;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }

        h2 {
            color: #dc3545;
            margin-bottom: 20px;
        }

        .mensaje {
            padding: 20px;
            border-radius: 6px;
            margin-top: 20px;
            font-weight: bold;
        }

        .exito {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        a.boton-volver {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 24px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s ease;
        }

        a.boton-volver:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <h2>Eliminar Máquina</h2>

        <div class="mensaje <?php echo $tipoMensaje; ?>">
            <?php echo $mensaje; ?>
        </div>

        <a href="updateMachine.php" class="boton-volver">Volver al listado</a>
    </div>
</body>
</html>
