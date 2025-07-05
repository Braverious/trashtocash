<style>
.alert-content {
    display: flex;
}

.alert-text {
    flex: 1;
    text-align: center;
    padding: 0 10px;
}

.alert-text:not(:last-child) {
    border-right: 1px dashed #1A2035;
}
</style>
<div class="main-panel" style="font-family: quicksand;">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title"><?= $judul; ?></h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="/recyloop/member">
                            <i class="fas fa-solid fa-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-home">
                        <a href="sampah">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Manajemen Sampah</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Index</a>
                    </li>
                </ul>
            </div>
            <div class="row align-content-center justify-content-center">
                <div class="col-lg-3 counter">
                    <div class="card border border-dark weather-card" style="background-color: #fff;">
                        <div class="card-header">
                            <div class="card-header"
                                style="background-color: #fff; color: black; text-align: center; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                <b>Kapasitas Gudang Botol</b>
                            </div>
                            <h4 style="text-align: center; font-size: 1.5em; color: blue;">
                                <?php $persentase_kepenuhan = ($botol['total_sampah'] / $botol['kapasitas']) * 100; ?>
                                <?= $botol['total_sampah'] ?>/<b><?= $botol['kapasitas']; ?></b>
                            </h4>
                            <div style="text-align: center;">
                                <span style="margin-top: 20px; text-align: center; color: black;">Kapasitas Tersisa:
                                </span>
                            </div>
                            <h4
                                style="margin-top: 2px; text-align: center; font-size: 1.5em; color: blue; font-weight: bold;">
                                <?= number_format($persentase_kepenuhan, 2); ?>%
                            </h4>
                        </div>`;
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card border border-dark weather-card" style="background-color: #fff;">
                        <div class="card-header">
                            <div class="card-header"
                                style="background-color: #fff; color: black; text-align: center; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                <b>Kapasitas Gudang Kaleng</b>
                            </div>
                            <h4 style="text-align: center; font-size: 1.5em; color: red;">
                                <?php $persentase_kepenuhan = ($kaleng['total_sampah'] / $kaleng['kapasitas']) * 100; ?>
                                <?= $kaleng['total_sampah'] ?>/<b><?= $kaleng['kapasitas']; ?></b>
                            </h4>
                            <div style="text-align: center;">
                                <span style="margin-top: 20px; text-align: center; color: black;">Kapasitas Tersisa:
                                </span>
                            </div>
                            <h4
                                style="margin-top: 2px; text-align: center; font-size: 1.5em; color: red; font-weight: bold;">
                                <?= number_format($persentase_kepenuhan, 2); ?>%
                            </h4>
                        </div>`;
                    </div>
                </div>
                <div class="col-lg-3" style="text-align: center;">
                    <div class="card border border-dark weather-card" style="background-color: #fff;">
                        <div class="card-header">
                            <div class="card-header"
                                style="background-color: #fff; color: black; text-align: center; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                <b>Kapasitas Gudang kardus</b>
                            </div>
                            <h4 style="text-align: center; font-size: 1.5em; color: green;">
                                <?php $persentase_kepenuhan = ($kardus['total_sampah'] / $kardus['kapasitas']) * 100; ?>
                                <?= $kardus['total_sampah'] ?>/<b><?= $kardus['kapasitas']; ?></b>
                            </h4>
                            <div style="text-align: center;">
                                <span style="margin-top: 20px; text-align: center; color: black;">Kapasitas Tersisa:
                                </span>
                            </div>
                            <h4
                                style="margin-top: 2px; text-align: center; font-size: 1.5em; color: green; font-weight: bold;">
                                <?= number_format($persentase_kepenuhan, 2); ?>%
                            </h4>
                        </div>`;
                    </div>
                </div>
            </div>
            <div class="text-center">
                <!-- <a href="<?= base_url('admin/tambah_sampah'); ?>" class="btn btn-light col-lg-3 mb-3" style="display: inline-block; max-width: 200px; text-align: center; margin-top: -15px;"><b>Tambah Jenis Sampah</b></a> -->
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <?= $this->session->flashdata('message') ?>
                </div>
            </div>
            <div class="containers">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 50px;">No.</th>
                            <th scope="col" style="width: 50px;">Ikon</th>
                            <th scope="col" style="width: 50px;">KD</th>
                            <th scope="col" style="width: 100px;">Jenis Sampah</th>
                            <th scope="col" style="width: 100px;">Nilai Tukar</th>
                            <th scope="col" style="width: 50px;">Total Sampah</th>
                            <th scope="col" style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($sampah as $s) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td>
                                <img class="img-thumbnail border-0" style="width: 45px; height: auto;"
                                    src="<?= base_url('assets/images/svg/member-section2/' . $s['icon']); ?>"
                                    alt="Gambar" width="85" height="85">
                            </td>
                            <td><?= $s['kode']; ?></td>
                            <td><?= $s['jenis_sampah']; ?></td>
                            <td>Rp<?= $s['nilai_tukar']; ?>/buah</td>
                            <td><?= $s['total_sampah']; ?> buah</td>
                            <td>
                                <a href="<?= base_url('admin/ubah_sampah/'   . $s['id']); ?>"
                                    class="btn btn-success btn-sm"><i style="color: #000;"
                                        class="fa-solid fa-pencil"></i></a>
                                <a href="<?= base_url('admin/hapus_sampah/' . $s['id']); ?>"
                                    class="btn btn-danger btn-sm"><i style="color: #000;"
                                        class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="alert alert-info" role="alert"
                style="margin-top: 15px; background: white; color: #1A2035; border-radius: 5px;">
                <b>
                    <div class="alert-content">
                        <div class="alert-text">
                            <b>Total sampah ke PT. TLP:</b> <?= $this->session->userdata('total_sampah_tlp') ?? 0; ?>
                        </div>
                        <div class="alert-text">
                            <b>Total sampah ke PT. KSA:</b> <?= $this->session->userdata('total_sampah_ksa') ?? 0; ?>
                        </div>
                        <div class="alert-text">
                            <b>Total sampah ke PT. DPR:</b> <?= $this->session->userdata('total_sampah_dpr') ?? 0; ?>
                        </div>
                    </div>
                </b>
            </div>
            <div class="text-center" style="margin-top: 20px;">
                <a href="<?= base_url('admin/tambah_distribusi'); ?>" class="btn btn-light col-lg-3 mb-3"
                    style="display: inline-block; max-width: 200px; text-align: center; margin-top: -15px;"><b>Tambah
                        Pengiriman</b></a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col" style="text-align: center;">Pengepul</th>
                        <th scope="col" style="text-align: center;">Tanggal</th>
                        <th scope="col">BP</th>
                        <th scope="col">KA</th>
                        <th scope="col">KK</th>
                        <th scope="col">Kas Masuk</th>
                        <th scope="col">Driver</th>
                        <th scope="col">Petugas</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($distribution)) : ?>
                    <tr>
                        <td colspan="9" style="text-align: center;">Belum ada pengambilan sampah dari gudang</td>
                    </tr>
                    <?php else : ?>
                    <?php $i = 1;
                        foreach ($distribution as $d) : ?>
                    <tr>
                        <td><?= $d['id']; ?></td>
                        <td style="text-align: center;"><?= $d['pengepul']; ?></td>
                        <td style="text-align: center;"><?= $d['tanggal']; ?></td>
                        <td><?= $d['bp']; ?></td>
                        <td><?= $d['ka']; ?></td>
                        <td><?= $d['kk']; ?></td>
                        <td style="color: lightgreen;"><i class="fa-solid fa-up-long"></i>&nbsp;&nbsp;Rp
                            <b><?= number_format($d['nilai_tukar'], 0, ',', '.'); ?></b></td>
                        <td><?= $d['driver']; ?></td>
                        <td><?= $d['petugas']; ?></td>
                        <td>
                            <a href="<?= base_url('admin/ubah_distribusi/' . $d['id']); ?>"
                                class="btn btn-success btn-sm"><i style="color: #000;"
                                    class="fa-solid fa-pencil"></i></a>
                            <!-- <a href="<?= base_url('admin/updatedistribution/' . $d['id']); ?>" class="btn btn-light btn-sm" style="color: #000;"><i style="color: #000;" class="fa-solid fa-check"></i></a> -->
                            <!-- <a href="<?= base_url('admin/hapus_distribusi/' . $d['id']); ?>" class="btn btn-danger btn-sm"><i style="color: #000;" class="fa-solid fa-trash"></i></a> -->
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <?= $this->pagination->create_links(); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
window.setTimeout(function() {
    $(".col-lg-6").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
    });
}, 2000);
</script>