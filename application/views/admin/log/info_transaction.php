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

            <div class="container-fluid col">
                <div class="card border border-secondary">
                    <div class="card-body">
                        <h5 style="text-align: center;" class="card-title mt-1"><?= $judul; ?></h5>
                        <hr>
                        <form action="<?= base_url('transaction/edit_transaction/') . $transaction['id']; ?>"
                            method="POST">
                            <p style="font-weight: bold;">Transaksi penyerahan ini dilakukan oleh
                                <?= $transaction['petugas']; ?> dengan status <?= $transaction['status']; ?></p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="idstaff">ID Member</label>
                                        <span class="input-group-text border-secondary text-grey"
                                            style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035; font-weight: bold;"><?= $transaction['id_member'] ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="idstaff">Username</label>
                                        <span class="input-group-text border-secondary text-grey"
                                            style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035; font-weight: bold;"><?= $transaction['username'] ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="idstaff">Tanggal</label>
                                        <span class="input-group-text border-secondary text-grey"
                                            style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035; font-weight: bold;"><?= $transaction['tanggal'] ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="idstaff">Lokasi</label>
                                        <span class="input-group-text border-secondary text-grey"
                                            style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035; font-weight: bold;"><?= $transaction['lokasi'] ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="idstaff">Catatan</label>
                                        <span class="input-group-text border-secondary text-grey"
                                            style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035; font-weight: bold;"><?= $transaction['catatan'] ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="idstaff">Jumlah Botol</label>
                                        <span class="input-group-text border-secondary text-grey"
                                            style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035; font-weight: bold;"><?= $transaction['jumlah_botol'] ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="idstaff">Jumlah Kaleng</label>
                                        <span class="input-group-text border-secondary text-grey"
                                            style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035; font-weight: bold;"><?= $transaction['jumlah_kaleng'] ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="idstaff">Jumlah Kardus</label>
                                        <span class="input-group-text border-secondary text-grey"
                                            style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035; font-weight: bold;"><?= $transaction['jumlah_kardus'] ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="idstaff">Jumlah Limbah (Satuan)</label>
                                        <span class="input-group-text border-secondary text-grey"
                                            style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035; font-weight: bold;"><?= $transaction['total'] ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="idstaff">Jumlah Saldo Koin yang dapat ditukar</label>
                                        <span class="input-group-text border-secondary text-grey"
                                            style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035; font-weight: bold;">Rp
                                            <?= number_format($transaction['totalkoin'], 0, ',', '.') ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="idstaff">Komentar Petugas</label>
                                        <span class="input-group-text border-secondary text-grey"
                                            style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035;">
                                            <?= !empty($transaction['catatan']) ? $transaction['catatan'] : 'Tidak ada komentar dari petugas' ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-12"
                                    style="display: flex; justify-content: space-evenly; align-items: center; margin-top: 10px">
                                    <a style="width: 100px;" href="<?= base_url('log/transaction'); ?>"
                                        class="btn btn-warning">Kembali</a>
                                </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>