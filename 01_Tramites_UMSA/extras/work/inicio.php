<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Trámites UMSA</title>
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px 50px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 400px;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
        }

        .login-container h2 {
            margin-bottom: 30px;
            color: #333;
            font-weight: 600;
            font-size: 24px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #666;
            font-size: 14px;
            font-weight: 400;
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
            background: #fbfbfb;
        }

        .input-group input:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
            background: #fff;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background: #000000ff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.1s ease;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background: #404055ff;
        }

        .btn-submit:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form action='iniciologin.php' method="get">
            
            <div class="input-group">
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" placeholder="m1" required autocomplete="off"/>
            </div>

            <div class="input-group">
                <label for="clave">Contraseña</label>
                <input type="password" id="clave" name="clave" placeholder="123456" required/>
            </div>

            <button type="submit" class="btn-submit">Ingresar</button>
            
        </form>
    </div>

</body>
</html>