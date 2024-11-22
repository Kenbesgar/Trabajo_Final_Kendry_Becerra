<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['nombre_usuario'];
    $contrasena = md5($_POST['contrasena']);

    // Consulta para obtener los datos del usuario
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario='$usuario' AND contrasena='$contrasena'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        // Si el usuario existe, guardamos el id_usuario y el nombre de usuario en la sesión
        $usuario_data = $resultado->fetch_assoc();  // Obtener el resultado de la consulta
        $_SESSION['id_usuario'] = $usuario_data['id'];  // Guardamos el id en la sesión
        $_SESSION['usuario'] = $usuario;  // Guardamos el nombre de usuario en la sesión

        header("Location: index.php");  // Redirigir a la página principal
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('https://static.vecteezy.com/system/resources/previews/002/801/211/large_2x/light-blue-background-with-bows-bright-sample-with-colorful-bent-lines-shapes-pattern-for-websites-landing-pages-vector.jpg ') no-repeat center center fixed; /* Aquí defines la ruta de la imagen */
            background-size: cover; /* Asegura que la imagen cubra toda la pantalla */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        h2 {
            color: #2a2a2a;
            text-align: center;
            margin-bottom: 20px;
        }
        .login-container {
            background-color: rgba(255, 255, 255, 0.8); /* Fondo semitransparente para el contenedor */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff; /* Color azul */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .login-container button:hover {
            background-color: #0056b3; /* Un azul más oscuro al pasar el mouse */
        }
        .login-container label {
            font-size: 14px;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Inicio de Sesión</h2>
        <form method="POST">
            <label for="nombre_usuario">Usuario:</label>
            <input type="text" name="nombre_usuario" required>
            
            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" required>
            
            <button type="submit">Ingresar</button>
        </form>
    </div>
</body>
</html>
