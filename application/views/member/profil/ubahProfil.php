<body class="main-body light-theme">
    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top" class="back-to-top rounded-circle shadow all-ease-03 fade-in">
        <i class="fe fe-arrow-up"></i>
    </a>
    <!-- END BACK-TO-TOP -->

    <!-- PAGE -->
    <div class="page">
        <!-- MAIN-CONTENT -->
        <div class="main-content app-content"></div>
        <section>
            <div class="section banner-4 banner-section d-flex justify-content-center">
                <div class="row col-7">
                    <div class="container">
                        <div class="card text-bg-light p-3">
                            <div class="heading-section" style="margin-bottom: 0;">
                                <div class="heading-subtitle">
                                    <span class="tx-primary tx-16 fw-semibold">Ubah Profil Anda</span>
                                </div>
                                <div class="heading-title mt-2">
                                    <?= form_open_multipart('member/ubahProfil'); ?>
                                    <img id="profileImage" style="width: 3.8em; border-radius: 100%;"
                                        src="<?= base_url('assets/images/user/profile/') . $user['photo']; ?>">
                                    <div class="custom-file d-flex justify-content-center mt-2">
                                        <div class="container mt-3">
                                            <div class="form-group d-flex align-items-center">
                                                <input type="file" id="photo" name="photo" style="display: none;">
                                                <label for="photo"
                                                    style="font-size: 1rem; font-weight: 600; margin-bottom: 0; margin-right: 10px;">
                                                    <button type="button"
                                                        onclick="document.getElementById('photo').click();"
                                                        class="btn btn-primary">
                                                        Pilih Gambar
                                                    </button>
                                                </label>
                                                <input type="text" id="fileName" class="form-control"
                                                    style="color: #000; flex: 1;" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="card p-3 mt-4">
                                            <div class="row">
                                                <div class="col-sm-6 mb-4 mt-3">
                                                    <label for="username" class="form-label"
                                                        style="font-size: 1rem; display: block; text-align: left; font-weight: 600;">Username</label>
                                                    <input type="text" class="form-control" id="username"
                                                        name="username" value="<?= $user['username']; ?>"
                                                        style="color: #000;" readonly>
                                                </div>
                                                <div class="col-sm-6 mb-4 mt-3">
                                                    <label for="nama" class="form-label"
                                                        style="font-size: 1rem; display: block; text-align: left; font-weight: 600;">Nama
                                                        Lengkap</label>
                                                    <input type="text" class="form-control" id="nama" name="nama"
                                                        value="<?= $user['nama']; ?>" style="color: #000;">
                                                    <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                                                </div>
                                                <div class="col-sm-6 mb-4">
                                                    <label for="email" class="form-label"
                                                        style="font-size: 1rem; display: block; text-align: left; font-weight: 600;">Email</label>
                                                    <input type="text" class="form-control" id="email" name="email"
                                                        value="<?= $user['email']; ?>" style="color: #000;">
                                                    <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                                </div>
                                                <div class="col-sm-6 mb-4">
                                                    <label for="notelp" class="form-label"
                                                        style="font-size: 1rem; display: block; text-align: left; font-weight: 600;">Nomor
                                                        Telepon</label>
                                                    <input type="text" class="form-control" id="notelp" name="notelp"
                                                        value="<?= $user['no_telp']; ?>" style="color: #000;">
                                                    <?= form_error('notelp', '<small class="text-danger mt-1" style="font-size: .9rem; display: block; text-align: left; font-weight: 600;">', '</small>'); ?>
                                                </div>
                                                <div class="col-sm-12 mb-4">
                                                    <label for="alamat" class="form-label"
                                                        style="font-size: 1rem; display: block; text-align: left; font-weight: 600;">Alamat</label>
                                                    <input type="text" class="form-control" id="alamat" name="alamat"
                                                        value="<?= $user['alamat']; ?>" style="color: #000;">
                                                    <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-secondary mb-1">Simpan</button>
                                            <a href="<?= base_url('member/profil') ?>"
                                                class="btn btn-dark mb-1">Kembali</a>
                                        </div>
                                    </div>
                                    <?= form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
    <script>
    document.getElementById('photo').onchange = function(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('profileImage');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);

        const fileName = event.target.files[0].name;
        document.getElementById('fileName').value = fileName;
    };
    </script>