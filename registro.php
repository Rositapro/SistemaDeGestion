<?php
include 'conexion.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $password = mysqli_real_escape_string($conexion, $_POST['password']);
    $tipo = $_POST['id_tipo'];

    // Insertar el nuevo usuario en la tabla 'usuario' de sistema_web
    $sql = "INSERT INTO usuario (nombre_completo, correo, password, id_tipo) 
            VALUES ('$nombre', '$correo', '$password', $tipo)";

    if (mysqli_query($conexion, $sql)) {
        $mensaje = "<div class='alert alert-success'>Usuario registrado exitosamente. Ya puedes iniciar sesión.</div>";
    } else {
        $mensaje = "<div class='alert alert-danger'>Error al registrar: " . mysqli_error($conexion) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Gestión de Accesos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light p-4">
    <div class="container">
        <div class="card p-4 mx-auto shadow-sm" style="max-width: 800px; border-radius: 15px;">
            <h2 class="mb-4 text-primary">Registro de Usuarios</h2>
            
            <?php echo $mensaje; ?>

            <form action="registro.php" method="POST" class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nombre Completo</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Ej. Rosalinda Cedillo" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="correo" class="form-control" placeholder="nombre@ejemplo.com" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tipo de Usuario</label>
                    <select name="id_tipo" class="form-select" required>
                        <option value="" selected disabled>Selecciona una opción...</option>
                        <option value="1">Administrador</option>
                        <option value="2">Operador</option>
                        <option value="3">Invitado</option>
                    </select>
                </div>
                <div class="col-12 mt-4 text-end">
                    <a href="index.php" class="btn btn-outline-secondary me-2">Volver al Login</a>
                    <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>