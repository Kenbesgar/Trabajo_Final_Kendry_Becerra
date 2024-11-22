<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM productos WHERE id = $id";
    $resultado = $conn->query($sql);
    $producto = $resultado->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre_producto'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $talla = $_POST['talla'];
    $color = $_POST['color'];
    $cantidad = $_POST['cantidad_disponible'];
    $categoria = $_POST['categoria'];

    $sql = "UPDATE productos SET 
                nombre_producto='$nombre',
                descripcion='$descripcion',
                precio='$precio',
                talla='$talla',
                color='$color',
                cantidad_disponible='$cantidad',
                categoria='$categoria'
            WHERE id = $id";

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
    <title>Editar Producto</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #2a2a2a;
            margin-top: 50px;
        }

        form {
            width: 60%;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #f76c6c;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #f5a5a5;
        }

        .form-container {
            max-width: 900px;
            margin: 50px auto;
        }

    </style>
</head>
<body>
    <div class="form-container">
        <h2>Editar Producto</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
            <label>Nombre:</label>
            <input type="text" name="nombre_producto" value="<?php echo $producto['nombre_producto']; ?>" required>
            
            <label>Descripción:</label>
            <textarea name="descripcion" required><?php echo $producto['descripcion']; ?></textarea>
            
            <label>Precio:</label>
            <input type="number" step="0.01" name="precio" value="<?php echo $producto['precio']; ?>" required>
            
            <label>Talla:</label>
            <input type="text" name="talla" value="<?php echo $producto['talla']; ?>" required>
            
            <label>Color:</label>
            <input type="text" name="color" value="<?php echo $producto['color']; ?>" required>
            
            <label>Cantidad:</label>
            <input type="number" name="cantidad_disponible" value="<?php echo $producto['cantidad_disponible']; ?>" required>
            
            <label>Categoría:</label>
            <input type="text" name="categoria" value="<?php echo $producto['categoria']; ?>" required>
            
            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
