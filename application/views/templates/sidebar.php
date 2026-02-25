<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion">

    <!-- BRAND -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard'); ?>">
        <div class="sidebar-brand-text mx-3">ADMIN</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- DASHBOARD -->
    <li class="nav-item <?= ($this->uri->segment(1) == 'dashboard') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Manajemen Barang
    </div>

    <li class="nav-item <?= ($this->uri->segment(1) == 'input-produk') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('input-produk'); ?>">
            <i class="fas fa-fw fa-box"></i>
            <span>Produk</span>
        </a>
    </li>

    <li class="nav-item <?= ($this->uri->segment(1) == 'kategori') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('kategori'); ?>">
            <i class="fas fa-fw fa-tags"></i>
            <span>Kategori</span>
        </a>
    </li>

    <li class="nav-item <?= ($this->uri->segment(1) == 'testimoni-admin') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('testimoni-admin'); ?>">
            <i class="fas fa-fw fa-tags"></i>
            <span>Kelola Testimoni</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- LOGOUT -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>

</ul>