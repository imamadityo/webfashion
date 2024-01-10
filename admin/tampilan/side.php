<aside class="main-sidebar sidebar-secondary-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light"><B>Fortuneshop</B></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="?p=home" class="nav-link <?= ($_GET['p'] == "home") ? 'active fw-bold' : '' ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p> Dashboard </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="?p=kategori" class="nav-link <?= ($_GET['p'] == "kategori") ? 'active fw-bold' : '' ?>">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p> Data Kategori </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="?p=produk" class="nav-link <?= ($_GET['p'] == "produk") ? 'active fw-bold' : '' ?>">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p> Data Produk </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="?p=user" class="nav-link <?= ($_GET['p'] == "user") ? 'active fw-bold' : '' ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p> Data Customer </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="?p=order&st=Semua" class="nav-link <?= ($_GET['p'] == "order") ? 'active fw-bold' : '' ?>">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p> Data Transaksi </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="?p=info" class="nav-link <?= ($_GET['p'] == "info") ? 'active fw-bold' : '' ?>">
                        <i class="nav-icon fas fa-info"></i>
                        <p> Data Informasi </p>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>