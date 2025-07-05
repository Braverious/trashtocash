<div class="main-panel" style="font-family: quicksand;">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title"><?= $judul; ?></h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="/recyloop/member">
                            <i class="fas fa-solid fa-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-home">
                        <a href="/recyloop/secure">
                            <i class="fa-solid fa-building-lock"></i> </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Manajemen Pengumuman</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Index</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Edit Pengumuman</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <?= $this->session->flashdata('message') ?>
                </div>
            </div>
            <form action="<?= base_url('secure/update/' . $secure['id']); ?>" method="POST">
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" id="tittle" name="tittle" value="<?= $secure['tittle']; ?>" placeholder="Masukkan Judul Ringkas">
                </div>
                <div class="form-group">
                    <label for="tanggal">IP Address</label>
                    <input type="password" class="form-control" id="address" name="address" value="<?= $secure['address']; ?>" placeholder="Masukkan Tanggal">
                </div>
                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-info">Edit</button>
                    <a href="<?= base_url('secure'); ?>" class="btn btn-danger">Kembali</a>
                </div>