<section class="section bg-pattern-1 bg-gray-100 overflow-hidden" id="about">
    <img src="<?= base_url('assets/') ?>images/patterns/9.png" alt="img"
        class="patterns-8 sub-pattern-1 filter-invert sub-pattern-1 op-1">
    <div class="container">
        <div class="heading-section">
            <div class="heading-subtitle"><span class="tx-primary tx-16 fw-semibold">Tentang</span></div>
            <div class="heading-title">Tentang <span class="tx-primary">Kami</span></div>
            <div class="heading-description">Mengenal lebih dalam tentang kami.</div>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-6 feature-client-bg">
                <?php foreach($company as $c) : ?>
                <h4 class="mb-2">
                    <span><?= $c['judul']; ?></span>
                </h4>
                <p class="mb-3">
                    <?= $c['deskripsi']; ?>
                </p>
                <?php endforeach ?>
            </div>
            <div class="col-lg-6 text-center">
                <img src="<?= base_url('assets/') ?>images/png/63.png" class="img-fluid" alt="img" width="450">
            </div>
        </div>
    </div>
    </div>
</section>