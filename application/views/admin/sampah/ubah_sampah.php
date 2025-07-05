<div class="main-panel" style="font-family: quicksand;">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title"><?= $judul; ?></h4>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <?= $this->session->flashdata('message') ?>
                </div>
            </div>
            <div class="container-fluid col-md-8">
                <div class="card border border-secondary">
                    <div class="card-body">
                        <h5 style="text-align: center;" class="card-title mt-1"><?= $judul; ?></h5>
                        <hr>
                        <form action="<?= base_url('admin/ubah_sampah/') . $sampah['id']; ?>" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label for="icon" class="col-form-label">Ikon Limbah</label>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <?php if (!empty($sampah['icon'])) : ?>
                                                    <img src="<?= base_url('assets/images/svg/member-section2/') . $sampah['icon']; ?>" class="img-thumbnail border-0" style="width: 50px; height: 50px;">
                                                <?php else : ?>
                                                    <img src="<?= base_url('assets/images/svg/member-section2/waste.png'); ?>" class="img-thumbnail" style="width: 50px; height: 50px;">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="custom-file mt-3">
                                            <input type="file" class="custom-file-input" id="icon" name="icon">
                                            <label class="custom-file-label" for="icon" style="background: #1A2035;">Pilih
                                                gambar</label>
                                        </div>

                                        <?= form_error('photo', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="idstaff">Jenis Sampah</label>
                                        <input type="text" class="form-control" id="jenis_sampah" name="jenis_sampah" autocomplete="off" value="<?= $sampah['jenis_sampah']; ?>">
                                        <?= form_error('jenis_sampah', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="nama">Nilai Tukar</label>
                                        <input type="number" class="form-control" id="nilai_tukar" name="nilai_tukar" autocomplete="off" value="<?= $sampah['nilai_tukar']; ?>">
                                        <?= form_error('nilai_tukar', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="nama">Kode</label>
                                        <input type="text" class="form-control" id="kode" name="kode" autocomplete="off" value="<?= $sampah['kode']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="nama">Total Sampah</label>
                                        <input type="number" class="form-control" id="total_sampah" name="total_sampah" autocomplete="off" value="<?= $sampah['total_sampah']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-12" style="display: flex; justify-content: space-evenly; align-items: center; margin-top: 10px">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a style="width: 100px;" href="<?= base_url('admin/sampah'); ?>" class="btn btn-warning">
                                        Batal </a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>