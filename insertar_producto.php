<?php
session_start();
include 'conexion.php';
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar y sanitizar los datos del formulario para evitar inyecciones SQL
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre_producto']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    $precio = mysqli_real_escape_string($conn, $_POST['precio']);
    $talla = mysqli_real_escape_string($conn, $_POST['talla']);
    $color = mysqli_real_escape_string($conn, $_POST['color']);
    $cantidad = mysqli_real_escape_string($conn, $_POST['cantidad_disponible']);
    $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);

    // Inserción del nuevo producto
    $sql = "INSERT INTO productos (nombre_producto, descripcion, precio, talla, color, cantidad_disponible, categoria) 
            VALUES ('$nombre', '$descripcion', '$precio', '$talla', '$color', '$cantidad', '$categoria')";

    if ($conn->query($sql) === TRUE) {
        header("Location: productos.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
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
            width: 50%;
            margin: 40px auto;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        textarea {
            height: 100px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 15px;
            font-size: 16px;
        }
        button:hover {
            background-color: #218838;
        }
        .back-link {
            text-decoration: none;
            color: #007BFF;
            display: inline-block;
            margin-top: 20px;
        }
        .back-link:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>

    <h2>Agregar Producto</h2>

    <div class="container">
        <form method="POST">
            <label>Nombre:</label>
            <input type="text" name="nombre_producto" required>

            <label>Descripción:</label>
            <textarea name="descripcion" required></textarea>

            <label>Precio:</label>
            <input type="number" step="0.01" name="precio" required>

            <label>Talla:</label>
            <input type="text" name="talla" required>

            <label>Color:</label>
            <input type="text" name="color" required>

            <label>Cantidad:</label>
            <input type="number" name="cantidad_disponible" required>

            <label>Categoría:</label>
            <input type="text" name="categoria" required>

            <button type="submit">Agregar</button>
        </form>

        <a href="productos.php" class="back-link">Volver a la lista de productos</a>
    </div>

</body>
</html>
