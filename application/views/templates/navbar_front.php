<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top border-bottom py-3">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url(); ?>">
            <img src="<?= base_url('assets/img/logo_ajm.png'); ?>" alt="Logo CV ABADI JAYA MITRA">
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto fw-semibold">
                <li class="nav-item">
                    <a class="nav-link text-dark px-3 <?= ($this->uri->segment(1) == 'home' || $this->uri->segment(1) == '') ? 'active' : ''; ?>"
                        href="<?= base_url(); ?>">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark px-3 <?= ($this->uri->segment(1) == 'katalog') ? 'active' : ''; ?>"
                        href="<?= base_url('katalog'); ?>">Katalog Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark px-3 <?= ($this->uri->segment(1) == 'tentang-kami') ? 'active fw-bold' : ''; ?>"
                        href="<?= base_url('tentang-kami'); ?>">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark px-3 <?= ($this->uri->segment(1) == 'cara-order') ? 'active fw-bold' : ''; ?>"
                        href="<?= base_url('cara-order'); ?>">Cara Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark px-3 <?= ($this->uri->segment(1) == 'kontak-kami') ? 'active fw-bold' : ''; ?>"
                        href="<?= base_url('kontak-kami'); ?>">Kontak</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark px-3 <?= ($this->uri->segment(1) == 'testimoni') ? 'active fw-bold' : ''; ?>"
                        href="<?= base_url('testimoni'); ?>">Testimoni</a>
                </li>
            </ul>
        </div>
    </div>
</nav>