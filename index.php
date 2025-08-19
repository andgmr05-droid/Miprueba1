<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Ferretería</title>
    <link rel="icon" href="\ferreteria\images\F.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <style>
       
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <nav>
        <?php include 'menu.php';?>
    </nav>

    <div class="container">
        <div class="main-content">
            <div class="welcome-section">
                <h2>Bienvenido al Sistema de Gestión de Ferretería</h2>
                <p>Gestiona tu inventario, clientes, proveedores y transacciones de manera eficiente con nuestra plataforma integral.</p>
                <a href="FmostrarProducto.php" class="btn">Ver Productos</a>
                <a href="FmostrarCliente.php" class="btn">Ver Clientes</a>
            </div>

            <h2>Resumen General</h2>
            <div class="stats-container">
                <div class="stat-card">
                    <h3>Productos</h3>
                    <div class="stat-value">1,245</div>
                    <a href="FmostrarProducto.php" class="btn btn-accent">Administrar</a>
                </div>
                <div class="stat-card">
                    <h3>Clientes</h3>
                    <div class="stat-value">586</div>
                    <a href="FmostrarCliente.php" class="btn btn-accent">Administrar</a>
                </div>
                <div class="stat-card">
                    <h3>Proveedores</h3>
                    <div class="stat-value">42</div>
                    <a href="FmostrarProveedor.php" class="btn btn-accent">Administrar</a>
                </div>
                <div class="stat-card">
                    <h3>Ventas Hoy</h3>
                    <div class="stat-value">24</div>
                    <a href="FmostrarFactura.php" class="btn btn-accent">Ver Detalles</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>