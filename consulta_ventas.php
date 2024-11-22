<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT v.id, u.nombre_usuario, p.nombre_producto, v.cantidad, v.total, v.fecha_venta
        FROM ventas v
        INNER JOIN usuarios u ON v.id_usuario = u.id
        INNER JOIN productos p ON v.id_producto = p.id
        WHERE v.total > 0"; // Cambié la condición

$resultado = $conn->query($sql);

// Verifica si la consulta devuelve resultados
if (!$resultado) {
    die("Error en la consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Ventas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f1f1;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #2a2a2a;
            margin-top: 50px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007bff; /* Azul para el encabezado */
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #cce5ff; /* Un azul claro cuando se pasa el mouse */
        }

        button {
            padding: 10px 20px;
            background-color: #007bff; /* Azul para el botón */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block;
            margin: 30px auto;
        }

        button:hover {
            background-color: #0056b3; /* Azul más oscuro cuando se pasa el mouse */
        }
    </style>
</head>
<body>
    <h2>Consulta de Ventas</h2>
    <table>
        <tr>
            <th>ID Venta</th>
            <th>Usuario</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>Fecha</th>
        </tr>
        <?php while ($row = $resultado->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nombre_usuario']; ?></td>
                <td><?php echo $row['nombre_producto']; ?></td>
                <td><?php echo $row['cantidad']; ?></td>
                <td><?php echo $row['total']; ?></td>
                <td><?php echo $row['fecha_venta']; ?></td>
            </tr>
        <?php } ?>
    </table>

    <!-- Botón para volver a la página principal -->
    <form action="index.php">
        <button type="submit">Volver a la Página Principal</button>
    </form>
</body>
</html>
