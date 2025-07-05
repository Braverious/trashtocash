    <style>
.btn-small {
    transform: scale(0.5);
    transform-origin: center;
}

.btn-cross {
    margin-bottom: -20px;
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
                            <a href="/recyloop/withdraw">
                                <i class="fa-solid fa-money-bill-1"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Tarik Tunai</a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Index</a>
                        </li>
                    </ul>
                </div>
                <div class="alert alert-info" role="alert"
                    style="margin-top: 20px; background: white; color: #1A2035; border-radius: 5px;">
                    <b>
                        <li>Minta bantuan personel Administrator apabila penarikan tunai bermasalah pada saldo
                            perusahaan!</li>
                    </b>
                </div>
                <a href="" data-toggle="modal" data-target="#newWithdrawModal" class="btn btn-secondary mb-3"
                    style="color:white;"><b>Tambah Tarik Tunai</b></a>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $this->session->flashdata('message') ?>
                    </div>
                </div>
                <div class="containers">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Kode Member</th>
                                <th scope="col">User</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col" style="width: 15%;">Nominal</th>
                                <th scope="col">Metode</th>
                                <th scope="col">Status</th>
                                <th scope="col" style="width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($withdraw)) : ?>
                            <tr>
                                <td colspan="9" style="text-align: center;">Belum ada tarik tunai yang terjadi.</td>
                            </tr>
                            <?php else : ?>
                            <?php foreach ($withdraw as $w) : ?>
                            <tr>
                                <td><?= $w['id_member']; ?></td>
                                <td><?= $w['username']; ?></td>
                                <td><?= $w['tanggal']; ?></td>
                                <td style="color: red;"><i class="fa-solid fa-down-long"></i>&nbsp;&nbsp;Rp
                                    <b><?= number_format($w['nominal'], 0, ',', '.'); ?></b></td>
                                <td><?= $w['metode']; ?></td>
                                <td><?= $w['status']; ?></td>
                                <td>
                                    <!-- <a href="<?= base_url('withdraw/delete_withdraw/' . $w['id']); ?>" class="btn btn-light btn-sm" style="width: 30px; height: 30px;"><i style="color: #000;" class="fa-solid fa-trash"></i></a> -->
                                    <a href="<?= base_url('withdraw/receipt/' . $w['id']); ?>"
                                        class="btn btn-light btn-sm" style="width: 30px; height: 30px;"><i
                                            style="color: #000;" class="fa-solid fa-file-pdf"></i></a>
                                    <a href="<?= base_url('withdraw/info_withdraw/' . $w['id']); ?>"
                                        class="btn btn-light btn-sm" style="width: 30px; height: 30px;"><i
                                            style="color: #000;" class="fa-solid fa-info"></i></a>
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

        <!-- Modal Tambah Transaksi Penarikan Saldo / Tarik Tunai  -->
        <div class="modal fade" id="newWithdrawModal" tabindex="-1" aria-labelledby="newWithdrawModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" style="background-color: #1A2035; border-radius: 10px;">
                <div class="modal-content" style="background-color: #1A2035;">
                    <div class="modal-header">
                        <h2 class="modal-title text-white" id="newWithdrawModalLabel"><b>Penarikan Saldo Baru</b></h2>
                        <button type="button" class="btn btn-close btn-small btn-cross" data-dismiss="modal"
                            aria-label="Close">
                            <!-- &times; -->X
                        </button>
                    </div>
                    <form action="<?= base_url('withdraw') ?>" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label style="color: #01E7f4 !important;" for="formGroupExampleInput">ID Member</label>
                                <input style="background: #01E7f4; color: #1A2035; font-weight: 600;" type="text"
                                    class="form-control" id="id_member" name="id_member"
                                    placeholder="Ketik ID milik member" required>
                                <?= form_error('id_member', '<small class="text-light">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label style="color: #01E7f4 !important;" for="formGroupExampleInput">Username</label>
                                <input style="background: #01E7f4; color: #1A2035; font-weight: 600;" type="text"
                                    class="form-control text-dark" id="username" name="username"
                                    placeholder="ID Member tidak ditemukan!" readonly>
                            </div>
                            <div class="form-group">
                                <label style="color: #01E7f4 !important;" for="formGroupExampleInput">Saldo Koin</label>
                                <input style="background: #01E7f4; color: #1A2035; font-weight: 600;" type="text"
                                    class="form-control text-dark" id="koin" name="koin"
                                    placeholder="Koin member kosong!" readonly>
                            </div>
                            <div class="form-group">
                                <label style="color: #01E7f4 !important;" for="jumlah_botol">Nominal</label>
                                <input style="background: #01E7f4; color: #1A2035; font-weight: 600;" type="number"
                                    class="form-control" id="nominal" name="nominal"
                                    placeholder="Ketik jumlah saldo yang ingin ditarik" min="10000" value="0">
                                <?= form_error('nominal', '<small class="text-light">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label style="color: #01E7f4 !important;" for="metode">Metode tarik tunai</label>
                                <select class="form-control" id="metode" name="metode"
                                    style="background: #01E7f4; color: #1A2035;" required>
                                    <option value="" disabled selected>Pilih Metode</option>
                                    <option value="Tunai">Tunai</option>
                                    <option value="Transfer">Transfer Bank</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label style="color: #01E7f4 !important;" for="lokasi">Lokasi</label>
                                <select class="form-control" id="lokasi" name="lokasi"
                                    style="background: #01E7f4; color: #1A2035;" required>
                                    <option value="" disabled selected>Pilih lokasi</option>
                                    <option value="Tenant Serpong">Tenant Serpong</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label style="color: #01E7f4 !important;" for="formGroupExampleInput">Nomor
                                    Rekening</label>
                                <textarea style="background: #01E7f4; color: #1A2035; font-weight: 600;"
                                    class="form-control" id="norek" name="norek"
                                    placeholder="Tulis nomor rekening di sini"></textarea>
                            </div>
                            <div class="form-group">
                                <label style="color: #01E7f4 !important;" for="formGroupExampleInput">Catatan</label>
                                <textarea style="background: #01E7f4; color: #1A2035; font-weight: 600;"
                                    class="form-control" id="catatan" name="catatan"
                                    placeholder="Tulis komentar di sini"></textarea>
                            </div>
                            <input type="hidden" id="petugas" name="petugas">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info">Add</button>
                        </div>
                    </form>
                </div>
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
    <script>
document.getElementById('id_member').addEventListener('input', function() {
    var idMember = this.value;

    if (idMember) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?= base_url("withdraw/getUserDataByIdMember"); ?>', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                document.getElementById('username').value = response.username;
                document.getElementById('koin').value = response.koin;
            }
        };
        xhr.send('id_member=' + idMember);
    } else {
        document.getElementById('username').value = '';
        document.getElementById('koin').value = '';
    }
});
    </script>