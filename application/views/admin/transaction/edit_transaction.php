<h1><?= $judul; ?></h1>
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
                        <form action="<?= base_url('transaction/edit_transaction/') . $transaction['id']; ?>" method="POST">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="id_member">ID Member</label>
                                        <input type="text" class="form-control" id="id_member" name="id_member" autocomplete="off" value="<?= $transaction['id_member']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" autocomplete="off" value="<?= $transaction['username']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $transaction['tanggal']; ?>">
                                    </div>
                                    <hr style="border-color: #fff;">
                                    <div class="form-group">
                                        <label for="idstaff">Jumlah Botol (BP)</label>
                                        <input style="background: #01E7f4; color: #1A2035; font-weight: 600;" type="number" class="form-control" id="jumlah_botol" name="jumlah_botol" placeholder="Ketik jumlah kaleng yang ditukar" min="0" value="<?= $transaction['jumlah_botol']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="idstaff">Jumlah Kaleng (KA)</label>
                                        <input style="background: #01E7f4; color: #1A2035; font-weight: 600;" type="number" class="form-control" id="jumlah_kaleng" name="jumlah_kaleng" placeholder="Ketik jumlah kaleng yang ditukar" min="0" value="<?= $transaction['jumlah_kaleng']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="idstaff">Jumlah Kardus (KK)</label>
                                        <input style="background: #01E7f4; color: #1A2035; font-weight: 600;" type="number" class="form-control" id="jumlah_kardus" name="jumlah_kardus" placeholder="Ketik jumlah kaleng yang ditukar" min="0" value="<?= $transaction['jumlah_kardus']; ?>">
                                    </div>
                                    <hr style="border-color: #fff;">
                                    <!-- <div class="form-group">
                                        <label for="idstaff">Total Koin</label>
                                        <input type="text" class="form-control" id="totalkoin" name="totalkoin" autocomplete="off" value="<?= $transaction['totalkoin'] ?>">
                                    </div> -->
                                    <div class="form-group">
                                        <label for="lokasi">Lokasi</label>
                                        <select class="form-control" id="lokasi" name="lokasi">
                                            <option value="Tenant Serpong" <?= $transaction['lokasi'] == "Tenant Serpong" ? 'selected' : '' ?>>Tenant Serpong</option>
                                            <!-- <option value="Tenant Serang" <?= $transaction['lokasi'] == "Tenant Serang" ? 'selected' : '' ?>>Tenant Serang</option> -->
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="catatan">Komentar</label>
                                        <textarea class="form-control" id="catatan" name="catatan"><?= isset($transaction['catatan']) ? htmlspecialchars($transaction['catatan']) : 'Tidak ada komentar' ?></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12" style="display: flex; justify-content: space-evenly; align-items: center; margin-top: 10px">
                                    <button type="submit" class="btn btn-danger">Simpan</button>
                                    <a style="width: 100px;" href="<?= base_url('transaction'); ?>" class="btn btn-warning">Batal</a>
                                </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>