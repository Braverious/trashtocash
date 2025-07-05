<div class="main-panel" style="font-family: quicksand;">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title"><?= $judul; ?></h4>
            </div>
            <div class="container-fluid col-md-8">
                <div class="card border border-secondary">
                    <div class="card-body">
                        <h5 style="text-align: center;" class="card-title mt-1"><?= $judul; ?></h5>
                        <hr>
                        <form action="<?= base_url('admin/ubah_distribusi/') . $distribution['id']; ?>" method="POST">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="pengepul">Pengepul</label>
                                        <select class="form-control" id="pengepul" name="pengepul">
                                            <option value="TLP" <?= $distribution['pengepul'] == "PT. Tangerang Lestari Pratama" ? 'selected' : '' ?>>PT. Tangerang Lestari Pratama</option>
                                            <option value="KSA" <?= $distribution['pengepul'] == "PT. Krakatau Steel Alumunium" ? 'selected' : '' ?>>PT. Krakatau Steel Alumunium</option>
                                            <option value="DPR" <?= $distribution['pengepul'] == "CV. Dunia Produk Raya" ? 'selected' : '' ?>>CV. Dunia Produk Raya</option>
                                        </select>
                                    </div>
                                    <div class="form-group hidden" id="form-bp">
                                        <label for="bp">Sampah Botol</label>
                                        <span class="form-control"><?= $distribution['bp']; ?></span>
                                    </div>
                                    <div class="form-group hidden" id="form-ka">
                                        <label for="ka">Kaleng Alumunium</label>
                                        <span class="form-control"><?= $distribution['ka']; ?></span>
                                    </div>
                                    <div class="form-group hidden" id="form-kk">
                                        <label for="kk">Kertas Kardus</label>
                                        <span class="form-control"><?= $distribution['kk']; ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="driver">Driver</label>
                                        <input type="text" class="form-control" id="driver" name="driver" autocomplete="off" value="<?= $distribution['driver']; ?>">
                                        <?= form_error('driver', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal" autocomplete="off" value="<?= $distribution['tanggal']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-12" style="display: flex; justify-content: space-evenly; align-items: center; margin-top: 10px">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                    <a style="width: 100px;" href="<?= base_url('admin/sampah'); ?>" class="btn btn-warning">
                                        Batal
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>