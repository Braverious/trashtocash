<style>
    .separator {
        border-left: 2px dashed #000;
        /* Garis putus-putus vertikal */
        height: 100%;
        /* Sesuaikan dengan tinggi container */
        margin: 0 20px;
        /* Jarak antar kupon */
    }
</style>
<section class="section bg-pattern-1" style="margin-top: -50px;">
    <img src="<?= base_url('assets/') ?>images/patterns/7.png" alt="img" class="patterns-7">
    <img src="<?= base_url('assets/') ?>images/patterns/2.png" alt="img" class="patterns-1 op-1">
    <img src="<?= base_url('assets/') ?>images/patterns/9.png" alt="img" class="patterns-3 filter-invert sub-pattern-2 op-2">
    <div class="container">
        <div class="heading-section">
            <div class="heading-subtitle"><span class="tx-primary tx-16 fw-semibold">Tukar</span></div>
            <div class="heading-title"><span class="tx-primary"> Kupon Penukaran Cinderamata</span> </div>
            <div class="heading-description">Kami menghargai loyalitas dan kepercayaan member kami, cinderamata merupakan <br> bentuk kepedulian kami sebagai
                ucapan terima kasih kami atas kontribusi member.</div>
        </div>
        <div class="row justify-content-center">
            <?php foreach ($gift as $g) : ?>
                <div class="col-lg-4 col-sm-6">
                    <div class="card text-center feature-card-16 mb-lg-0 secondary">
                        <div class="card-body">
                            <span class="avatar br-7 me-3">
                                <img style="width: 45px; height: auto;" src="<?= base_url('assets/images/cinderamata/') . $g['photo'] ?>">
                            </span>
                            <h2 class="mb-0"><?= $g['nama_gift'] ?></h2>
                            <p>Syarat tukar: <?= $g['harga']  ?> koin</p>
                            <span class=""> <?= $g['deskripsi']; ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="divider py-1 bg-secondary"></div>
        </div>
        <div class="heading-section" style="margin-top: 20px;">
            <div class="heading-subtitle"><span class="tx-primary tx-16 fw-semibold">Tukar</span></div>
            <div class="heading-title"><span class="tx-primary"> Koleksi Kupon Kamu</span> </div>
            <div class="heading-description">Kupon hanya berlaku sekali setelah diambil, silakan datangi booth terdekat kami di lokasi yang tersedia.</div>
        </div>
        <div class="row">
            <div class="justify-content-center d-flex">
                <?php if (!$kupon1 && !$kupon2) : ?>
                    <div class="text-center mx-3" style="margin-top: -30px;">
                        <img style="width: 100px;" src="<?= base_url('assets/images/logo/sad-face.png') ?>">
                        <br>
                        <small>Maaf, Anda belum memiliki koleksi kupon.</small>
                    </div>
                <?php else : ?>
                    <?php if ($kupon1) : ?>
                        <div class="text-center mx-3">
                            <img style="width: 300px;" src="<?= base_url('assets/images/cinderamata/5000.png') ?>">
                            <br>
                            <small>Kode Unik: KUP5000-<?= $user['username'] ?> </small><br>
                            Status:
                            <?php if ($kupon1_taken) : ?>
                                <span style="color: red;"><b>Anda sudah mengambil cinderamata</b></span>
                            <?php else : ?>
                                <?php if ($stok > 0) : ?>
                                    <span style="color: green;">Stok tersedia</span>
                                <?php else : ?>
                                    <span style="color: red;">Stok tidak tersedia</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($kupon2) : ?>
                        <div class="separator"></div>
                        <div class="text-center mx-3">
                            <img style="width: 300px;" src="<?= base_url('assets/images/cinderamata/50000.png') ?>">
                            <br>
                            <small>Kode Unik: KUP50000-<?= $user['username'] ?> </small><br>
                            Status:
                            <?php if ($kupon2_taken) : ?>
                                <span style="color: red;"><b>Anda sudah mengambil cinderamata</b></span>
                            <?php else : ?>
                                <?php if ($stok2 > 0) : ?>
                                    <span style="color: green;">Stok tersedia</span>
                                <?php else : ?>
                                    <span style="color: red;">Stok tidak tersedia</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
            </div>
        <?php endif; ?>
        </div>
    </div>
</section>