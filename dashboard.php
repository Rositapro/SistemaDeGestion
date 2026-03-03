<?php
include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Bitácora Institucional</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">
                <i class="bi bi-shield-lock me-2"></i>Sistema de Gestión de Accesos
            </span>
            <div class="d-flex">
                <span class="navbar-text me-3 d-none d-md-inline">
                    Sesión Iniciada
                </span>
                <a href="index.php" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-box-arrow-left me-1"></i>Cerrar Sesión
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <h3><i class="bi bi-journal-text me-2"></i>Historial de Bitácora</h3>
                <p class="text-muted">Registros en tiempo real desde MariaDB</p>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Usuario</th>
                                <th>Fecha y Hora</th>
                                <th>Dirección IP</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Consulta SQL que une la bitácora con el nombre del usuario
                            $sql = "SELECT b.id_registro, u.nombre_completo, b.fecha_acceso, b.direccion_ip, b.exito 
                                    FROM bitacora b 
                                    LEFT JOIN usuario u ON b.id_usuario = u.id_usuario 
                                    ORDER BY b.fecha_acceso DESC";
                                    
                            $result = mysqli_query($conexion, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $usuario = $row['nombre_completo'] ?? '<span class="text-muted">Desconocido</span>';
                                    
                                    // Lógica para las insignias de colores según el éxito del acceso
                                    if ($row['exito'] == 1) {
                                        $status = '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Correcto</span>';
                                    } else {
                                        $status = '<span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Fallido</span>';
                                    }

                                    echo "<tr>
                                            <td class='fw-bold'>#{$row['id_registro']}</td>
                                            <td>{$usuario}</td>
                                            <td>{$row['fecha_acceso']}</td>
                                            <td><code>{$row['direccion_ip']}</code></td>
                                            <td>{$status}</td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center py-4 text-muted'>No hay registros de acceso en la base de datos.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <footer class="text-center mt-5 text-muted small">
            <p>Instituto Tecnológico Superior de Monclova - Práctica de Gestión de Accesos</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>