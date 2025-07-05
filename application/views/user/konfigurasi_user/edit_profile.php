<div class="main-panel" style="font-family: quicksand;">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title"><?= $judul; ?></h4>
            </div>

            <div class="row">
                <div class="col-8">
                    <?= form_open_multipart('user/edit_profile'); ?>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputEmail13" name="email"
                                value="<?= $user['email']; ?>">
                        </div>
                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama']; ?>">
                        </div>
                        <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="<?= $user['alamat']; ?>">
                        </div>
                        <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group row">
                        <label for="notelp" class="col-sm-3 col-form-label">No. Telp</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="notelp" name="notelp"
                                value="<?= $user['no_telp']; ?>">
                        </div>
                        <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <div class="form-group row">
                        <label for="photo" class="col-sm-3 col-form-label" readonly>Foto Profil</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="<?= base_url('assets/images/user/profile/') . $user['photo']; ?>"
                                        class="img-thumbnail border border-0" id="profileImage">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="photo" name="photo">
                                        <label class="custom-file-label" for="photo" style="background: #1A2035;">Pilih
                                            gambar</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?= form_error('photo', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary"> Terapkan </button>
                        </div>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.getElementById('photo').onchange = function(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('profileImage');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };
    </script>
</div>