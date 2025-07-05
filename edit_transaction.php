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
                                        <label for="idstaff">ID Member</label>
                                        <input type="text" class="form-control" id="id_member" name="id_member" autocomplete="off" value="<?= $transaction['id_member']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="idstaff">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" autocomplete="off" value="<?= $transaction['username']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="idstaff">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $transaction['tanggal']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="idstaff">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" autocomplete="off" value="<?= $transaction['username']; ?>">
                                    </div>
                                    <hr style="border-color: #fff;">
                                    <div class="form-group">
                                        <label for="idstaff">Jumlah Botol (BP)</label>
                                        <input style="background: #01E7f4; color: #1A2035; font-weight: 600;" type="number" class="form-control" id="jumlah_kaleng" name="jumlah_kaleng" placeholder="Ketik jumlah kaleng yang ditukar" min="0" value="0">
                                    </div>
                                </div>
                                <div class="col-sm-12" style="display: flex; justify-content: space-evenly; align-items: center; margin-top: 10px">
                                    <button type="submit" class="btn btn-danger">Simpan</button>
                                    <a style="width: 100px;" href="<?= base_url('transaction'); ?>" class="btn btn-warning">
                                        Batal </a>
                                </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>