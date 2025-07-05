<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title"><?= $judul; ?></h4>
            </div>

            <div class="container">

            </div>
            <div class="row">
                <div class="col-12 col-sm-9 col-md-4 mb-2">
                    <div class="card mb-3 p-3 border border-secondary"
                        style="display: flex; flex-direction: column; align-items: center;">
                        <img src="<?= base_url('assets/images/user/profile/') .  $user['photo']; ?>"
                            class="border border-secondary card-img-top rounded-circle" alt="..."
                            style="max-height: 40%; max-width: 40%;">
                        <h1 style="text-align: center;" class="card-title mt-3">
                            <?= $user['name']; ?>
                        </h1>
                        <p class="email">
                            <?= $user['email']; ?>
                        </p>
                        <div style="display: flex; justify-content: center;">
                            <span class="badge rounded-pill bg-secondary text-light">
                                <?php
                                if ($user['role_id'] == 1) {
                                    echo 'ADMIN';
                                } else {
                                    echo 'MEMBER';
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-9 col-md-4 mb-2">
                    <div class="card mb-3 p-3 border border-secondary">
                        <h5 style="text-align: center;" class="card-title">Tentang
                            Saya</h5>
                        <hr>
                        <div class="form-group row">
                            <label for="notelp" class="col-sm-3 col-form-label">No.
                                Telp</label>
                            <div class="col-sm-9">
                                <input style="color:#000;" type="text" class="form-control" id="notelp" name="notelp"
                                    readonly value="<?= $user['no_telp']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_created" class="col-sm-3 col-form-label">Akun</label>
                            <div class="col-sm-9">
                                <input style="color:#000;" readonly type="text" class="form-control" id="date_created"
                                    name="date_created" value="<?= date('d F Y', $user['date_created']); ?>">
                                <?php
                                $dateCreated = $user['date_created'];
                                $currentTime = time();
                                $timeDifference = $currentTime - $dateCreated;
                                $daysDifference = floor($timeDifference / (60 * 60 * 24));
                                ?>
                                <!-- <h1 class="style=col-sm-10">Bekerja sejak <?= $daysDifference ?> hari lalu</h1> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>