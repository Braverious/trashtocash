<section class="section bg-pattern-2 bg-image2">
    <div class="container">
        <div class="heading-section">
            <div class="heading-title text-white">Statistik</div>
            <div class="heading-description text-white op-8">Jumlah limbah yang berada di gudang.</div>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-3 col-sm-6">
                <div class="card text-center feature-card-16 mb-lg-0">
                    <div class="card-body">
                        <span class="avatar br-7 me-3">
                            <img style="width: 45px; height: auto;"
                                src="<?= base_url('assets/images/svg/member-section2/') . $bp['icon'] ?>">
                        </span>
                        <h4 class="">Botol Plastik</h4>
                        <h2 class="counter tx-primary  mb-0"><?= $bp['total_sampah']; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card text-center feature-card-16 mb-lg-0 secondary">
                    <div class="card-body">
                        <span class="avatar br-7 me-3">
                            <img style="width: 45px; height: auto;"
                                src="<?= base_url('assets/images/svg/member-section2/') . $ka['icon'] ?>">
                        </span>
                        <h4 class="">Kaleng Alumunium</h4>
                        <h2 class="counter tx-primary  mb-0"> <?= $ka['total_sampah']; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card text-center feature-card-16 mb-lg-0 success">
                    <div class="card-body">
                        <span class="avatar br-7 me-3">
                            <img style="width: 45px; height: auto;"
                                src="<?= base_url('assets/images/svg/member-section2/') . $kk['icon'] ?>">
                        </span>
                        <h4 class="">Kardus</h4>
                        <h2 class="counter tx-success  mb-0"><?= $kk['total_sampah']; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card text-center feature-card-16 mb-lg-0 danger">
                    <div class="card-body">
                        <span class="avatar br-7 me-3">
                            <i class="fa-solid fa-3x fa-wheelchair-move" style="color: #1C274C;"></i>
                        </span>
                        <h4 class="" style="margin-top: 5px;">Total Limbah</h4>
                        <h2 class="counter tx-danger  mb-0"><?= $total ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>