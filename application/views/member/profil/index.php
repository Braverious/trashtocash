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
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?= $this->session->flashdata('message') ?>
                                    </div>
                                </div>
                                <div class="heading-subtitle">
                                    <span class="tx-primary tx-16 fw-semibold">Profil Saya</span>
                                </div>
                                <div class="heading-title mt-2">
                                    <img style="width: 3.8em; border-radius: 100%;"
                                        src="<?= base_url('assets/images/user/profile/') . $user['photo']; ?>" alt="">
                                    <div class="container">
                                        <div class="card p-3 mt-4">
                                            <div class="row">
                                                <div class="col-sm-6 mb-4 mt-3">
                                                    <label for="idmember" class="form-label"
                                                        style="font-size: 1rem; display: block; text-align: left; font-weight: 600;">ID
                                                        Member</label>
                                                    <input style="color: #000;" type="text" class="form-control"
                                                        id="idmember" name="idmember" readonly
                                                        value="<?= $user['id_member']; ?>">
                                                </div>
                                                <div class="col-sm-6 mb-4 mt-3">
                                                    <label for="username" class="form-label"
                                                        style="font-size: 1rem; display: block; text-align: left; font-weight: 600;">Username</label>
                                                    <input style="color: #000;" type="text" class="form-control"
                                                        id="username" name="username" readonly
                                                        value="<?= $user['username']; ?>">
                                                </div>
                                                <div class="col-sm-6 mb-4">
                                                    <label for="nama" class="form-label"
                                                        style="font-size: 1rem; display: block; text-align: left; font-weight: 600;">Nama
                                                        Lengkap</label>
                                                    <input style="color: #000;" type="text" class="form-control"
                                                        id="nama" name="nama" readonly value="<?= $user['nama']; ?>">
                                                </div>
                                                <div class="col-sm-6 mb-4">
                                                    <label for="email" class="form-label"
                                                        style="font-size: 1rem; display: block; text-align: left; font-weight: 600;">Email</label>
                                                    <input style="color: #000;" type="text" class="form-control"
                                                        id="email" name="email" readonly value="<?= $user['email']; ?>">
                                                </div>
                                                <div class="col-sm-6 mb-4">
                                                    <label for="no_telp" class="form-label"
                                                        style="font-size: 1rem; display: block; text-align: left; font-weight: 600;">Nomor
                                                        Telepon</label>
                                                    <input style="color: #000;" type="text" class="form-control"
                                                        id="no_telp" name="no_telp" readonly
                                                        value="<?= $user['no_telp']; ?>">
                                                </div>
                                                <div class="col-sm-6 mb-4">
                                                    <label for="alamat" class="form-label"
                                                        style="font-size: 1rem; display: block; text-align: left; font-weight: 600;">Alamat</label>
                                                    <input style="color: #000;" type="text" class="form-control"
                                                        id="alamat" name="alamat" readonly
                                                        value="<?= $user['alamat']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="<?= base_url('member/ubahProfil') ?>"
                                                class="btn btn-warning mb-1">Ubah Profil</a>
                                            <a href="<?= base_url('member') ?>" class="btn btn-dark mb-1">Kembali</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </section>