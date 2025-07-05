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
            <div class="section banner-4 banner-section">
                <div class="row">
                    <div class="container col-8">
                        <div class="card p-4 d-flex align-items-center justify-content-center">
                            <div class="heading-section">
                                <div class="heading-subtitle">
                                    <span class="tx-primary tx-16 fw-semibold">Ulasan</span>
                                </div>
                                <div class="heading-title">
                                    <span style="font-size: 1.9rem" class="tx-primary">
                                        Silahkan berikan ulasan anda
                                    </span>
                                </div>
                            </div>
                            <!-- START DI SINI -->
                            <form action="<?= base_url('member/review'); ?>" method="post">
                                <div class="form-group">
                                    <textarea style="resize: none; font-size: 1rem; padding: 10px; height: 30vh" class="form-control border border-primary col-12" id="review" name="review" cols="100"></textarea>
                                </div>
                                <?= form_error('review', '<small class="text-danger">', '</small>'); ?>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary mb-1 me-2">Beri Ulasan</button>
                                    <a href="<?= base_url('member/about#rev') ?>" class="btn btn-secondary mb-1">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>