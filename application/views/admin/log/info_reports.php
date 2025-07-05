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
                        <a href="/recyloop/log/reports">
                            <i class="fa-solid fa-paste"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#"><?= $judul ?></a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Index</a>
                    </li>
                </ul>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <?= $this->session->flashdata('message') ?>
                        <form action="<?= base_url('log/reports') ?>" method="POST">
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Nama Petugas</label>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-text border-secondary text-grey" style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035;"><?= isset($laporan['nama']) ? $laporan['nama'] : 'Data tidak ditemukan'; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Nomor Pegawai</label>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-text border-secondary text-grey" style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035;"><?= isset($laporan['id_account']) ? $laporan['id_account'] : 'Data tidak ditemukan'; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Judul Laporan</label>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-text border-secondary text-grey" style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035;"><?= htmlspecialchars_decode($laporan['judul']); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Tanggal Laporan</label>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-text border-secondary text-grey" style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035;"><?= htmlspecialchars_decode($laporan['tanggal']); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Isi Laporan</label>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-text border-secondary text-grey" style="background-color:#eaecf4; width: 100%; color: #1A2035;"><?= htmlspecialchars_decode($laporan['deskripsi']); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <a href="<?= base_url('log/reports') ?>" class="btn btn-primary">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>