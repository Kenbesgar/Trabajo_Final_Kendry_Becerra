<?php
session_start();
include 'conexion.php';
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM productos";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            color: #333;
            padding: 20px;
            background-color: #007BFF;
            color: white;
            margin: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px;
        }
        a {
            text-decoration: none;
            color: #fff;
            background-color: #28a745;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #007BFF;
            color: white;
        }
        table td a {
            margin: 0 5px;
            color: white;
            text-decoration: none;
            background-color: #007BFF;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        table td a:hover {
            background-color: #0056b3;
            color: #fff;
        }
        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }
        .btn-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h2>Gestión de Productos</h2>

    <div class="container">
        <a href="insertar_producto.php">Agregar Producto</a>
        <br><br>
        <a href="index.php" class="btn-back">Volver al Inicio</a>
        <br><br>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Talla</th>
                    <th>Color</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nombre_producto']; ?></td>
                        <td><?php echo $row['descripcion']; ?></td>
                        <td><?php echo $row['precio']; ?></td>
                        <td><?php echo $row['talla']; ?></td>
                        <td><?php echo $row['color']; ?></td>
                        <td><?php echo $row['cantidad_disponible']; ?></td>
                        <td>
                            <a href="editar_producto.php?id=<?php echo $row['id']; ?>">Editar</a>
                            <a href="eliminar_producto.php?id=<?php echo $row['id']; ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>
