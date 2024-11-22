<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página Principal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://static.vecteezy.com/system/resources/previews/002/801/211/large_2x/light-blue-background-with-bows-bright-sample-with-colorful-bent-lines-shapes-pattern-for-websites-landing-pages-vector.jpg'); /* Ruta de la imagen de fondo */
            background-size: cover; /* Hace que la imagen cubra toda la pantalla */
            background-position: center; /* Centra la imagen */
            background-attachment: fixed; /* Hace que la imagen de fondo no se mueva al hacer scroll */
            margin: 0;
            padding: 0;
            height: 100vh; /* Asegura que el cuerpo ocupe toda la altura de la ventana */
            display: flex; /* Usamos flexbox */
            justify-content: center; /* Centra horizontalmente */
            align-items: center; /* Centra verticalmente */
        }

        .container {
            text-align: center; /* Alinea todo el contenido dentro del contenedor */
            background-color: rgba(255, 255, 255, 0.8); /* Fondo semi-transparente para mejorar la legibilidad */
            padding: 30px;
            border-radius: 10px;
        }

        h1 {
            color: #2a2a2a;
            margin-top: 50px;
        }

        nav {
            margin-top: 30px;
        }

        nav a {
            margin: 0 20px;
            padding: 10px 20px;
            background-color: #007bff; /* Color azul para los botones */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #0056b3; /* Un azul más oscuro al pasar el mouse */
        }

        nav a:active {
            background-color: #004085; /* Azul aún más oscuro cuando el botón es presionado */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenido, <?php echo $_SESSION['usuario']; ?></h1>
        <nav>
            <a href="productos.php">Gestión de Productos</a>
            <a href="registrar_venta.php">Registro de Ventas</a>
            <a href="consulta_ventas.php">Consultar Ventas</a>
            <a href="logout.php">Cerrar Sesión</a>
        </nav>
    </div>
</body>
</html>
