<button class="sidebar-toggle-mobile">
        <i class="fas fa-bars"></i>
    </button>

    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-title">Sistema Ferretería</div>
            <div class="menu-toggle" id="sidebarCollapse">
                <link rel="icon" href="\ferreteria\images\F.png" type="image/x-icon">
                <i class="fas fa-angle-left"></i>
            </div>
        </div>
        
        <div class="sidebar-menu">
            <div class="menu-item">
                <a href="index.php" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-home"></i></span>
                    <span class="menu-text">Inicio</span>
                </a>
            </div>
            
            <div class="menu-item">
                <a href="FmostrarProducto.php" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-boxes"></i></span>
                    <span class="menu-text">Productos</span>
                </a>
            </div>
            
            <div class="menu-item">
                <a href="FmostrarCliente.php" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-users"></i></span>
                    <span class="menu-text">Clientes</span>
                </a>
            </div>
            
            <div class="menu-item">
                <a href="FmostrarProveedor.php" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-truck"></i></span>
                    <span class="menu-text">Proveedores</span>
                </a>
            </div>
            
            <div class="menu-item">
                <div class="menu-link" id="moreOptions">
                    <span class="menu-icon"><i class="fas fa-cog"></i></span>
                    <span class="menu-text">Más Opciones</span>
                    <span class="menu-toggle"><i class="fas fa-angle-right"></i></span>
                </div>
                <div class="submenu">
                    <a href="FmostrarBodega.php" class="menu-link">
                        <span class="menu-icon"><i class="fas fa-warehouse"></i></span>
                        <span class="menu-text">Bodegas</span>
                    </a>
                    <a href="FmostrarCategoria.php" class="menu-link">
                        <span class="menu-icon"><i class="fas fa-tags"></i></span>
                        <span class="menu-text">Categorías</span>
                    </a>
                    <a href="FmostrarCompra.php" class="menu-link">
                        <span class="menu-icon"><i class="fas fa-shopping-cart"></i></span>
                        <span class="menu-text">Compras</span>
                    </a>
                    <a href="FmostrarDetallecompra.php" class="menu-link">
                        <span class="menu-icon"><i class="fas fa-list-ul"></i></span>
                        <span class="menu-text">Detalle Compras</span>
                    </a>
                    <a href="FmostrarFormaPago.php" class="menu-link">
                        <span class="menu-icon"><i class="fas fa-credit-card"></i></span>
                        <span class="menu-text">Formas de Pago</span>
                    </a>
                    <a href="FmostrarDetallefactura.php" class="menu-link">
                        <span class="menu-icon"><i class="fas fa-file-invoice"></i></span>
                        <span class="menu-text">Detalle Factura</span>
                    </a>
                    <a href="FmostrarFactura.php" class="menu-link">
                        <span class="menu-icon"><i class="fas fa-file-alt"></i></span>
                        <span class="menu-text">Facturas</span>
                    </a>
                    <a href="FmostrarTraslado.php" class="menu-link">
                        <span class="menu-icon"><i class="fas fa-exchange-alt"></i></span>
                        <span class="menu-text">Traslados</span>
                    </a>
                    <a href="FmostrarDetalletraslado.php" class="menu-link">
                        <span class="menu-icon"><i class="fas fa-list-ol"></i></span>
                        <span class="menu-text">Detalle Traslados</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <header>
        <div class="header-content">
            <img src="/ferreteria/images/F.png" style="width: 100px; height: 100px;margin-right: -2000px;">
            <h1 style="">Sistema de Ferretería</h1>
        </div>
    </header>
      <script>
        // Toggle sidebar collapse
        document.getElementById('sidebarCollapse').addEventListener('click', function() {
            document.body.classList.toggle('sidebar-collapsed');
            const icon = this.querySelector('i');
            if (document.body.classList.contains('sidebar-collapsed')) {
                icon.classList.remove('fa-angle-left');
                icon.classList.add('fa-angle-right');
            } else {
                icon.classList.remove('fa-angle-right');
                icon.classList.add('fa-angle-left');
            }
        });
        
        // Toggle submenu
        document.getElementById('moreOptions').addEventListener('click', function(e) {
            e.preventDefault();
            const parent = this.closest('.menu-item');
            parent.classList.toggle('active');
        });
        
        // Mobile sidebar toggle
        document.querySelector('.sidebar-toggle-mobile').addEventListener('click', function() {
            document.body.classList.toggle('sidebar-mobile-expanded');
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768 && !document.querySelector('.sidebar').contains(e.target) && 
                e.target !== document.querySelector('.sidebar-toggle-mobile')) {
                document.body.classList.remove('sidebar-mobile-expanded');
            }
        });
    </script>