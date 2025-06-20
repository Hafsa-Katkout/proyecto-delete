<?php
// Configuración de la base de datos
$host = 'localhost';
$db = 'proyecto_db';
$user = 'root';
$pass = 'Hafsa@2005';

$mensaje = "";
$tipoMensaje = "";

if (isset($_GET['host_id'])) {
    $id = intval($_GET['host_id']);

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("DELETE FROM windows_hosts WHERE id = ?");
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            $mensaje = "Máquina Windows eliminada correctamente.";
            $tipoMensaje = "exito";
        } else {
            $mensaje = "No se encontró la máquina con ese ID.";
            $tipoMensaje = "error";
        }

    } catch (PDOException $e) {
        $mensaje = "Error al eliminar la máquina: " . $e->getMessage();
        $tipoMensaje = "error";
    }

} else {
    $mensaje = "ID de máquina no especificado.";
    $tipoMensaje = "error";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Máquina Windows</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('/images/windows_espacio_back.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .contenedor {
            max-width: 600px;
            margin: 120px auto;
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

        .botones-superiores {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .boton-navegacion {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            font-size: 14px;
            font-weight: bold;
            color: white;
            background-color: transparent;
            border: 2px solid white;
            border-radius: 6px;
            text-decoration: none;
            box-shadow: 0 0 8px white;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .boton-navegacion:hover {
            background-color: #e0f7ff;
            color: #007bff;
        }
    </style>
</head>
<body>

<div class="botones-superiores">
    <a href="dashboard.php" class="boton-navegacion">Volver</a>
    <a href="logout.php" class="boton-navegacion">Cerrar sesión</a>
    <a href="ayuda.html" class="boton-navegacion">Ayuda</a>
</div>

<div class="contenedor">
    <h2>Eliminar Máquina Windows</h2>
    <div class="mensaje <?php echo $tipoMensaje; ?>">
        <?php echo $mensaje; ?>
    </div>
    <a class="boton-volver" href="windows_espacio.php">Volver al listado</a>
</div>

</body>
</html>
