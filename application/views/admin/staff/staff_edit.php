<style>
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type=number] {
    -moz-appearance: textfield;
}
</style>

<div class="main-panel" style="font-family: quicksand;">
    <div class="content">
        <div class="page-inner">
            <div class="container-fluid col-md-8">
                <div class="card border border-secondary">
                    <div class="card-body">
                        <h5 style="text-align: center;" class="card-title mt-1"><?= $judul; ?></h5>
                        <hr>
                        <form action="<?= base_url('admin/staff_edit/') . $user['id']; ?>" method="POST">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="idstaff">ID Staff</label>
                                        <input style="color: #000;" type="text" class="form-control" id="idstaff"
                                            name="idstaff" autocomplete="off" value="<?= $user['id_staff'] ?>" readonly>
                                        <?= form_error('idstaff', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            value="<?= $user['nama'] ?>" autocomplete="off">
                                        <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="lahir">Tanggal Lahir</label>
                                        <input style="color: #000;" type="date" class="form-control" id="lahir"
                                            name="lahir" value="<?= $user['lahir'] ?>" autocomplete="off" readonly>
                                        <?= form_error('lahir', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            value="<?= $user['email'] ?>" autocomplete="off">
                                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input style="color: #000;" type="text" class="form-control" id="username"
                                            name="username" value="<?= $user['username'] ?>" autocomplete="off"
                                            readonly>
                                        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <div class="input-group">
                                            <input style="color: #000;" type="password" class="form-control"
                                                id="password" name="password" value="password" autocomplete="off"
                                                readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fas fa-eye-slash" id="togglePassword"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="no_telp">No. Telepon</label>
                                        <input type="number" class="form-control" id="no_telp" name="no_telp"
                                            value="<?= $user['no_telp'] ?>" autocomplete="off">
                                        <?= form_error('no_telp', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat"
                                            value="<?= $user['alamat'] ?>" autocomplete="off">
                                        <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12"
                                style="display: flex; justify-content: space-evenly; align-items: center; margin-top: 10px">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a style="width: 100px;" href="<?= base_url('admin/staff'); ?>" class="btn btn-danger">
                                    Batal </a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>