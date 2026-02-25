<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php $this->load->view('templates/topbar'); ?>

        <div class="container-fluid">
            <?php $this->load->view($content); ?>
        </div>
    </div>
    <?php $this->load->view('templates/footer'); ?>
</div>