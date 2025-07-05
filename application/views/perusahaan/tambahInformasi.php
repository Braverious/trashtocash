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
                        <a href="/recyloop/perusahaan">
                            <i class="fa-solid fa-id-badge"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Informasi Perusahaan</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Index</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <?= $this->session->flashdata('message') ?>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <?= $this->session->flashdata('message') ?>
                        <form action="<?= base_url('perusahaan/tambahInformasi/'); ?>" method="POST">
                            <div class="form-group row">
                                <label for="judul" class="col-sm-3 col-form-label"><b>Judul</b></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="judul" name="judul">
                                    <?= form_error('judul', '<small class="text-danger">', '</small'); ?>
                                </div>
                            </div>
                            <div class=" form-group row">
                                <label for="myTextarea" class="col-sm-3 col-form-label"><b>Keterangan</b></label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="myTextarea" name="deskripsi"></textarea>
                                    <?= form_error('deskripsi', '<small style="margin-top: 20px;" class="text-danger">', '</small'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>