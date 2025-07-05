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
                        <form action="<?= base_url('transaction/edit_withdraw/') . $withdraw['id']; ?>" method="POST">
                            <p style="font-weight: bold;">Transaksi tarik tunai ini berstatus
                                <?= $withdraw['status']; ?> oleh petugas <?= $withdraw['petugas'] ?></p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="idstaff">ID Member</label>
                                        <span class="input-group-text border-secondary text-grey"
                                            style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035;"><?= isset($withdraw['id_member']) ? $withdraw['id_member'] : 'Data tidak ditemukan'; ?></span>
                                        <!-- <?= form_error('jenis_sampah', '<small class="text-danger">', '</small>'); ?> -->
                                    </div>
                                    <div class="form-group">
                                        <label for="idstaff">Username</label>
                                        <span class="input-group-text border-secondary text-grey"
                                            style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035;"><?= isset($withdraw['username']) ? $withdraw['username'] : 'Data tidak ditemukan'; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="idstaff">Tanggal</label>
                                        <span class="input-group-text border-secondary text-grey"
                                            style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035;"><?= isset($withdraw['tanggal']) ? $withdraw['tanggal'] : 'Data tidak ditemukan'; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="idstaff">Jam</label>
                                        <span class="input-group-text border-secondary text-grey"
                                            style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035;"><?= isset($withdraw['jam']) ? $withdraw['jam'] : 'Data tidak ditemukan'; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="idstaff">Lokasi</label>
                                        <span class="input-group-text border-secondary text-grey"
                                            style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035;"><?= isset($withdraw['lokasi']) ? $withdraw['lokasi'] : 'Data tidak ditemukan'; ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="idstaff">Metode</label>
                                        <span class="input-group-text border-secondary text-grey"
                                            style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035;"><?= isset($withdraw['metode']) ? $withdraw['metode'] : 'Data tidak ditemukan'; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="idstaff">Nomor Rekening</label>
                                        <span class="input-group-text border-secondary text-grey"
                                            style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035;"><?= isset($withdraw['norek']) ? $withdraw['norek'] : 'User menerima uang tunai'; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="idstaff">Koin Sebelum</label>
                                        <span class="input-group-text border-secondary text-grey"
                                            style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035;"><?= isset($withdraw['koin1']) ? $withdraw['koin1'] : 'Tidak ada koin'; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="idstaff">Koin Saat Ini</label>
                                        <span class="input-group-text border-secondary text-grey"
                                            style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035;"><?= isset($withdraw['koin2']) ? $withdraw['koin2'] : 'Data tidak ditemukan'; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="idstaff">Nominal Yang ditarik tunai</label>
                                        <span class="input-group-text border-secondary text-grey"
                                            style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035;">Rp
                                            <?= number_format($withdraw['nominal'], 0, ',', '.') ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="idstaff">Komentar Petugas</label>
                                        <span class="input-group-text border-secondary text-grey"
                                            style="background-color:#eaecf4; width: 100%; height: 40px; color: #1A2035;"><?= !empty($transaction['catatan']) ? $transaction['catatan'] : 'Tidak ada komentar dari petugas' ?>
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