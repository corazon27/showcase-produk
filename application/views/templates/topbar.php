<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">

        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" role="button">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                            <?= $this->session->userdata('username'); ?>
                        </span>
                        <img class="img-profile rounded-circle"
                            src="<?= base_url('assets/sbadmin2/img/undraw_profile.svg'); ?>">
                    </a>
                </li>

            </ul>

        </nav>