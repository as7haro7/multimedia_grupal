<?php
session_start();

if (isset($_POST['ingresar'])) {
    include "conexion.php";
    $usuarios = leer_json("usuarios");
    $user_input = $_POST["usuario"];
    $pass_input = $_POST["contrasenia"];
    
    $valido = false;
    foreach ($usuarios as $u) {
        if ($u["usuario"] == $user_input && $u["password"] == $pass_input) {
            $valido = true;
            $_SESSION["usuario"] = $user_input;
            $_SESSION["rol"] = $u["rol"];
            break;
        }
    }
    
    if ($valido) {
        header("Location: bandejae.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>
<html>
<head>
    <title>Login - Ayudantía</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); text-align: center; width: 300px; }
        h2 { color: #333; margin-bottom: 20px; font-size: 20px;}
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        input[type="submit"] { background: #007bff; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; margin-top: 10px; }
        input[type="submit"]:hover { background: #0056b3; }
        .error { color: red; margin-bottom: 15px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Postulación Ayudantía</h2>
        <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
        <form method="POST" action="iniciologin.php">
            <input type="text" name="usuario" placeholder="Usuario" required/>
            <input type="password" name="contrasenia" placeholder="Contraseña" required/>
            <input type="submit" name="ingresar" value="Ingresar"/>
        </form>
        <p style="font-size: 12px; color: #666; margin-top: 20px;">
            juan / 123 (Postulante bueno)<br>
            pedro / 123 (Postulante sin requisitos)<br>
            ana / 123 (Kárdex)<br>
            luis / 123 (Tribunal)<br>
            maria / 123 (Consejo)
        </p>
    </div>
</body>
</html>
