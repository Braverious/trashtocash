<section id="rev" class="section overflow-hidden">
    <div class="container">
        <div class="heading-section">
            <div class="heading-subtitle"><span class="tx-primary tx-16 fw-semibold">Reviews</span></div>
            <div class="heading-title">Apa Yang Orang Bicarakan <span class="tx-primary">Tentang Kami</span>
            </div>
            <div class="heading-description">Client Reviews</div>
        </div>
        <div class="row align-items-center">
            <div class="col-xl-3 text-center text-lg-start feature-client-bg">
                <span><i class="bi bi-quote tx-secondary tx-50"></i></span>
                <p class="h3 mb-5">Kata Client Tentang Kami</p>
                <div class="swiper-pagination"></div>
            </div>
            <div class="col-xl-9">
                <div class="bg-client position-relative">
                    <img src="<?= base_url('assets/') ?>images/patterns/9.png" alt="img" class="patterns-11 z-index-0 filter-invert op-2">
                    <div class="swiper testimonialSwiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($review as $r) : ?>
                                <?php if ($r['is_active'] == 1) : ?>
                                    <div class="swiper-slide">
                                        <div class="card shadow-none mb-0">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <img src="<?= base_url('assets/images/user/profile/') . $r['photo']; ?>" alt="img" class="avatar avatar-lg rounded-circle me-2">
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-0 text-white"><?= $r['nama']; ?></h6>
                                                        <span class="tx-11"><?= $r['formatted_date']; ?></span>
                                                    </div>
                                                    <i class="bi bi-quote review-quote"></i>
                                                </div>
                                                <p class="mt-2 mb-0 tx-14">
                                                    <?= $r['review']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <a href="<?= base_url('member/review'); ?>" class="btn btn-secondary"> Review Sekarang </a>
        </div>
    </div>
</section>
</div>

<!-- END MAIN-CONTENT -->
</div>
<!-- END PAGE -->