<?php
// Iniciar sesión para verificar si el usuario está logueado
session_start();

// Verificar si el id_usuario está almacenado en la sesión
if (!isset($_SESSION['id_usuario'])) {
    die("Error: No se ha iniciado sesión."); 
}

// Obtener el id_usuario de la sesión
$id_usuario = $_SESSION['id_usuario'];

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "venta_ropa");

// Verificar si la conexión fue exitosa
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $total = $_POST['total'];

    // Verificar si los datos son correctos
    if ($id_producto && $cantidad > 0 && $total > 0) {
        // Consulta para obtener el stock disponible del producto
        $sql_check_stock = "SELECT cantidad_disponible FROM productos WHERE id = '$id_producto'";
        $result_check_stock = $conexion->query($sql_check_stock);
        
        if ($result_check_stock->num_rows > 0) {
            $producto = $result_check_stock->fetch_assoc();
            $stock_disponible = $producto['cantidad_disponible'];

            // Verificar si hay suficiente stock
            if ($cantidad <= $stock_disponible) {
                // Insertar la venta en la base de datos
                $sql_venta = "INSERT INTO ventas (id_usuario, id_producto, cantidad, total) 
                              VALUES ('$id_usuario', '$id_producto', '$cantidad', '$total')";
                
                if ($conexion->query($sql_venta) === TRUE) {
                    // Actualizar la cantidad disponible del producto
                    $new_stock = $stock_disponible - $cantidad;
                    $sql_update_stock = "UPDATE productos SET cantidad_disponible = '$new_stock' WHERE id = '$id_producto'";
                    $conexion->query($sql_update_stock);

                    echo "<p class='mensaje-exito'>Venta registrada correctamente. Stock actualizado.</p>";
                } else {
                    echo "<p class='mensaje-error'>Error al registrar la venta: " . $conexion->error . "</p>";
                }
            } else {
                echo "<p class='mensaje-error'>No hay suficiente stock disponible.</p>";
            }
        } else {
            echo "<p class='mensaje-error'>Producto no encontrado.</p>";
        }
    } else {
        echo "<p class='mensaje-error'>Datos incorrectos o incompletos.</p>";
    }
}

// Obtener los productos disponibles
$sql = "SELECT id, nombre_producto FROM productos";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Venta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .contenedor {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-size: 16px;
        }

        select, input[type="number"], input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #2980b9;
        }

        .mensaje-exito {
            background-color: #2ecc71;
            color: #fff;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
        }

        .mensaje-error {
            background-color: #e74c3c;
            color: #fff;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
        }

        .boton-volver {
            display: block;
            width: 100%;
            background-color: #95a5a6;
            color: #fff;
            padding: 10px;
            text-align: center;
            border-radius: 4px;
            text-decoration: none;
        }

        .boton-volver:hover {
            background-color: #7f8c8d;
        }
    </style>
</head>
<body>

<div class="contenedor">
    <h2>Registrar Venta de Producto</h2>

    <form method="POST" action="">
        <label for="id_producto">Producto:</label>
        <select name="id_producto" id="id_producto">
            <?php
            if ($resultado->num_rows > 0) {
                // Recorrer los productos obtenidos de la base de datos
                while ($producto = $resultado->fetch_assoc()) {
                    echo "<option value='" . $producto['id'] . "'>" . $producto['nombre_producto'] . "</option>";
                }
            } else {
                echo "<option value=''>No hay productos disponibles</option>";
            }
            ?>
        </select><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" required><br>

        <label for="total">Total:</label>
        <input type="text" name="total" id="total" required><br>

        <button type="submit">Registrar Venta</button>
    </form>

    <!-- Botón para volver a la página principal -->
    <a href="index.php" class="boton-volver">Volver a la Página Principal</a>
</div>

</body>
</html>

<?php
// Cerrar la conexión
$conexion->close();
?>
