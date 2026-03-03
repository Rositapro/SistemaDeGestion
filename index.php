<?php
include 'conexion.php';

// Iniciamos variables para mensajes de error
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $password = $_POST['password']; // En una app real usarías password_verify
    $ip = $_SERVER['REMOTE_ADDR'];
    
    // 1. Buscamos al usuario en la base de datos sistema_web
    $query = "SELECT id_usuario FROM usuario WHERE correo = '$email' AND password = '$password' LIMIT 1";
    $result = mysqli_query($conexion, $query);
    $user = mysqli_fetch_assoc($result);
    
    if ($user) {
        $id_u = $user['id_usuario'];
        // 2. Registro exitoso en la bitácora
        $insert = "INSERT INTO bitacora (id_usuario, fecha_acceso, direccion_ip, exito) 
                   VALUES ($id_u, NOW(), '$ip', 1)";
        mysqli_query($conexion, $insert);
        
        // Redirigir al dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // 3. Registro fallido en la bitácora (id_usuario como NULL)
        $insert_fail = "INSERT INTO bitacora (id_usuario, fecha_acceso, direccion_ip, exito) 
                        VALUES (NULL, NOW(), '$ip', 0)";
        mysqli_query($conexion, $insert_fail);
        $error_msg = "Credenciales incorrectas. Intento registrado en bitácora.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gestión de Accesos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container vh-center" style="min-height: 100vh; display: flex; align-items: center; justify-content: center;">
        <div class="card p-4 shadow" style="max-width: 400px; width: 100%; border-radius: 15px;">
            <div class="text-center mb-4">
                <i class="bi bi-person-circle display-4 text-primary"></i>
                <h3 class="mt-2">Iniciar Sesión</h3>
                <p class="text-muted small">Sistema Institucional de Accesos</p>
            </div>

            <?php if($error_msg): ?>
                <div class="alert alert-danger py-2 small text-center"><?php echo $error_msg; ?></div>
            <?php endif; ?>

            <form action="index.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Correo Electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="correo@ejemplo.com" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="********" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-2">
                    Entrar <i class="bi bi-box-arrow-in-right ms-1"></i>
                </button>
            </form>
            
            <div class="text-center mt-3">
                <hr>
                <a href="registro.php" class="text-decoration-none small">Crear nueva cuenta</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>