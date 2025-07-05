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
                        <form action="<?= base_url('admin/tambah_stok/') . $cinderamata['id']; ?>" method="post">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="idstaff">Jumlah stok sekarang</label>
                                        <input style="color: #000;" type="text" class="form-control" id="stok"
                                            name="stok" readonly value="<?= $cinderamata['stok']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="nama">Jumlah yang ingin ditambah</label>
                                        <input type="number" class="form-control" id="jumlah" name="jumlah" min="0"
                                            autocomplete="off">
                                        <?= form_error('jumlah', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-12"
                                    style="display: flex; justify-content: space-evenly; align-items: center; margin-top: 10px">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                    <a style="width: 100px;" href="<?= base_url('admin/cinderamata'); ?>"
                                        class="btn btn-warning">
                                        Batal </a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>