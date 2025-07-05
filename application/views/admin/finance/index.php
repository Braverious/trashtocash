<style>
.btn-small {
    transform: scale(0.5);
    transform-origin: center;
}

.btn-cross {
    margin-bottom: -20px;
}

.img-thumbnail {
    transition: transform 0.25s ease;
    cursor: pointer;
}

.zoomed {
    transform: scale(2);
}

.filter-group {
    margin-bottom: 20px;
}

select,
input[type="date"] {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-right: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

select:focus,
input[type="date"]:focus {
    border-color: #007bff;
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.25);
    outline: none;
}
</style>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header" style="font-family: quicksand;">
                <h4 class="page-title"><?= $judul; ?></h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="member">
                            <i class="fas fa-solid fa-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-home">
                        <a href="#">
                            <i class="fa-solid fa-wallet"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Manajemen Keuangan</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Index</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <?= $this->session->flashdata('message') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card border border-light" style="border-radius: 10px; overflow: hidden;">
                        <div class="card-header"
                            style="background-color: #fff; color: #1A2035; text-align: center; font-size: 24px; padding: 5px 0;">
                            <b>Modal Kas</b>
                        </div>
                        <div class="card-body" style="padding-bottom: 1px; background-color: #1A2035;">
                            <div style="text-align: center; font-family: Montserrat; padding-bottom: 15px;">
                                <h1 style="color: #fff;">Rp. <?= number_format($saldoModalAwal, 0, ',', '.') ?></h1>
                                <a href="" data-toggle="modal" data-target="#newFinanceModal"
                                    class="btn btn-light mb-3"><b>Perbarui Saldo Modal</b></a>
                                <a href="#" class="btn btn-light mb-3" data-toggle="modal"
                                    data-target="#tambahSaldoModal"><b>Tambah Saldo Modal</b></a>
                                <br>Terakhir diperbarui oleh <?= $username_update1 ?> tanggal <?= $tgl_update1 ?> pukul
                                <?= $jam_update1 ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border border-light" style="border-radius: 10px; overflow: hidden;">
                        <div class="card-header"
                            style="background-color: #fff; color: #1A2035; text-align: center; font-size: 24px; padding: 5px 0;">
                            <b>Kas Saat ini</b>
                        </div>
                        <div class="card-body" style="padding-bottom: 1px; background-color: #1A2035;">
                            <div style="text-align: center; font-family: Montserrat; padding-bottom: 15px;">
                                <h1 style="color: #fff;">Rp. <?= number_format($saldoKasSaatIni, 0, ',', '.') ?></h1>
                                <a href="" data-toggle="modal" data-target="#newFinanceModal2"
                                    class="btn btn-light mb-3"><b>Perbarui Saldo Kas</b></a>
                                <a href="#" class="btn btn-light mb-3" data-toggle="modal"
                                    data-target="#tambahSaldoArusKas"><b>Tambah Saldo Kas</b></a>
                                <br>Terakhir diperbarui oleh <?= $username_update2 ?> tanggal <?= $tgl_update2 ?> pukul
                                <?= $jam_update2 ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filter-group" style="display: flex; gap: 10px;">
                    <div class="filter-item" style="display: flex; flex-direction: column;">
                        <label for="searchSelect">Cari berdasarkan ID Finance:</label>
                        <select id="searchSelect" class="form-control" style="height: 38px; padding: 7px;">
                            <option value="">Semua</option>
                            <option value="Modal Awal">Modal Awal</option>
                            <option value="Arus Kas">Arus Kas</option>
                        </select>
                    </div>
                    <div class="filter-item" style="display: flex; flex-direction: column;">
                        <label for="dateSearch">Cari berdasarkan Tanggal:</label>
                        <input type="date" id="dateSearch" class="form-control" style="height: 38px; padding: 5px;">
                    </div>
                </div>
                <table class="table" id="dataTable">
                    <thead>
                        <tr>
                            <th>ID Finance</th>
                            <th>Metode</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Sumber</th>
                            <th>Gambar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($menu) && is_array($menu)) : ?>
                        <?php foreach ($menu as $m) : ?>
                        <tr>
                            <td>
                                <?php
                                        if ($m['id_finance'] == 1) {
                                            echo "Modal Awal";
                                        } elseif ($m['id_finance'] == 2) {
                                            echo "Arus Kas";
                                        } else {
                                            echo "Nilai Tidak Dikenal";
                                        }
                                        ?>
                            </td>
                            <td>
                                <?= $m['metode'] ?>
                            </td>
                            <td style="color: lightgreen;"><i class="fa-solid fa-up-long"></i>&nbsp;&nbsp;Rp
                                <b><?= number_format($m['jumlah'], 0, ',', '.'); ?></b></td>
                            </td>
                            <td>
                                <?= $m['tanggal'] ?>
                            </td>
                            <td>
                                <?= $m['sumber'] ?>
                            </td>
                            <td>
                                <?php if (!empty($m['image'])) : ?>
                                <img src="<?= base_url('assets/finance/') . $m['image']; ?>" alt="Gambar"
                                    class="img-thumbnail" width="100" height="100" onclick="toggleZoom(this)">
                                <?php else : ?>
                                <span>Tidak ada gambar</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="5">Tidak ada data deposit untuk arus kas dan modal awal.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit kolom saldo yang memiliki ID = 1  -->
<div class="modal fade" id="newFinanceModal" tabindex="-1" aria-labelledby="newFinanceModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="background-color: #1A2035; border-radius: 10px;">
        <div class="modal-content" style="background-color: #1A2035;">
            <div class="modal-header">
                <h2 class="modal-title text-white" id="newFinanceModalLabel"><b>Perbarui Keuangan</b></h2>
                <button type="button" class="btn btn-close btn-small btn-cross" data-dismiss="modal" aria-label="Close">
                    X
                </button>
            </div>
            <form action="<?= base_url('finance') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label style="color: #01E7f4 !important;" for="formGroupExampleInput">Perbarui Modal</label>
                        <input type="hidden" name="id" value="1">
                        <input style="background: #01E7f4; color: #1A2035; font-weight: 600;" type="text"
                            class="form-control" id="saldo" name="saldo"
                            value="<?= isset($saldoModalAwal) ? $saldoModalAwal : '' ?>">
                        <?= form_error('saldo', '<small class="text-light">', '</small>'); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit kolom saldo yang memiliki ID = 2  -->
<div class="modal fade" id="newFinanceModal2" tabindex="-1" aria-labelledby="newFinanceModalLabel2" aria-hidden="true">
    <div class="modal-dialog" style="background-color: #1A2035; border-radius: 10px;">
        <div class="modal-content" style="background-color: #1A2035;">
            <div class="modal-header">
                <h2 class="modal-title text-white" id="newFinanceModalLabel2"><b>Perbarui Keuangan</b></h2>
                <button type="button" class="btn btn-close btn-small btn-cross" data-dismiss="modal" aria-label="Close">
                    X
                </button>
            </div>
            <form action="<?= base_url('finance') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label style="color: #01E7f4 !important;" for="formGroupExampleInput">Perbarui Kas saat
                            ini</label>
                        <input type="hidden" name="id" value="2">
                        <input style="background: #01E7f4; color: #1A2035; font-weight: 600;" type="text"
                            class="form-control" id="saldo" name="saldo"
                            value="<?= isset($saldoKasSaatIni) ? $saldoKasSaatIni : '' ?>">
                        <?= form_error('saldo', '<small class="text-light">', '</small>'); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Tambah saldo berdasarkan nominal input 1 -->
<div class="modal fade" id="tambahSaldoModal" tabindex="-1" aria-labelledby="tambahSaldoModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="background-color: #1A2035; border-radius: 10px;">
        <div class="modal-content" style="background-color: #1A2035;">
            <div class="modal-header">
                <h2 class="modal-title text-white" id="tambahSaldoModalLabel"><b>Tambah Saldo</b></h2>
                <button type="button" class="btn btn-close btn-small btn-cross" data-dismiss="modal" aria-label="Close">
                    X
                </button>
            </div>
            <form action="<?= base_url('finance/tambahSaldo') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label style="color: #01E7f4 !important;" for="jumlah">Jumlah Saldo Tambahan</label>
                        <input type="hidden" name="id" value="1">
                        <input style="background: #01E7f4; color: #1A2035; font-weight: 600;" type="number"
                            class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan jumlah saldo tambahan">
                        <?= form_error('jumlah', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label style="color: #01E7f4 !important;" for="image">Upload Bukti Deposit</label>
                        <input type="file" class="form-control" id="image" name="image"
                            style="background: #01E7f4; color: #1a2035;">
                    </div>
                    <div class="form-group">
                        <label style="color: #01E7f4 !important;" for="tanggal">Tanggal Deposit</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                            style="background: #01E7f4; color: #1a2035;">
                    </div>
                    <div class="form-group">
                        <label style="color: #01E7f4 !important;" for="image">Pilih Metode Deposit</label>
                        <select class="form-control" id="metode" name="metode"
                            style="background: #01E7f4; color: #1A2035;">
                            <option value="" disabled selected>Pilih metode</option>
                            <option value="Tunai">Tunai</option>
                            <!-- <option value="Transfer Bank">Transfer Bank</option> -->
                        </select>
                        <?= form_error('metode', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label style="color: #01E7f4 !important;" for="image">Pilih Sumber Deposit</label>
                        <select class="form-control" id="sumber" name="sumber"
                            style="background: #01E7f4; color: #1A2035;">
                            <option value="" disabled selected>Pilih sumber</option>
                            <option value="Donatur">Donatur</option>
                            <option value="Sponsor">Sponsor</option>
                        </select>
                        <?= form_error('sumber', '<small class="text-danger">', '</small>') ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tambah arus kas berdasarkan nominal input 2 -->
<div class="modal fade" id="tambahSaldoArusKas" tabindex="-1" aria-labelledby="tambahSaldoArusKasLabel"
    aria-hidden="true">
    <div class="modal-dialog" style="background-color: #1A2035; border-radius: 10px;">
        <div class="modal-content" style="background-color: #1A2035;">
            <div class="modal-header">
                <h2 class="modal-title text-white" id="tambahSaldoArusKasLabel"><b>Tambah Saldo</b></h2>
                <button type="button" class="btn btn-close btn-small btn-cross" data-dismiss="modal" aria-label="Close">
                    X
                </button>
            </div>
            <form action="<?= base_url('finance/tambahSaldo') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label style="color: #01E7f4 !important;" for="jumlah">Jumlah Saldo Tambahan</label>
                        <input type="hidden" name="id" value="2">
                        <input style="background: #01E7f4; color: #1A2035; font-weight: 600;" type="number"
                            class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan jumlah saldo tambahan">
                        <?= form_error('jumlah', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label style="color: #01E7f4 !important;" for="image">Upload Bukti Deposit</label>
                        <input type="file" class="form-control" id="image" name="image"
                            style="background: #01E7f4; color: #1a2035;">
                    </div>
                    <div class="form-group">
                        <label style="color: #01E7f4 !important;" for="tanggal">Tanggal Deposit</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                            style="background: #01E7f4; color: #1a2035;">
                    </div>
                    <!-- <div class="form-group">
                        <label style="color: #01E7f4 !important;" for="image">Pilih Metode Deposit</label>
                        <select class="form-control" id="metode" name="metode" style="background: #01E7f4; color: #1A2035;">
                            <option value="" disabled selected>Pilih metode</option>
                            <option value="Tunai">Tunai</option>
                            <option value="Transfer Bank">Transfer Bank</option>
                        </select>
                        <?= form_error('metode', '<small class="text-danger">', '</small>') ?>
                    </div> -->
                    <input type="hidden" name="metode" id="metode" value="Dana Internal">
                    <div class="form-group">
                        <label style="color: #01E7f4 !important;" for="image">Pilih Sumber Deposit</label>
                        <select class="form-control" id="sumber" name="sumber"
                            style="background: #01E7f4; color: #1A2035;">
                            <option value="" disabled selected>Pilih sumber</option>
                            <!-- <option value="Donatur">Donatur</option>
                            <option value="Sponsor">Sponsor</option> -->
                            <option value="Modal Kas">Modal Kas</option>
                        </select>
                        <?= form_error('sumber', '<small class="text-danger">', '</small>') ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
    });
}, 2000);
</script>
<script>
function toggleZoom(img) {
    img.classList.toggle('zoomed');
}
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#searchSelect').change(function() {
        var selectedValue = $(this).val().toLowerCase();
        filterTable();
    });

    $('#dateSearch').on('input', function() {
        filterTable();
    });

    function filterTable() {
        var selectedValue = $('#searchSelect').val().toLowerCase();
        var selectedDate = $('#dateSearch').val();

        $('#dataTable tbody tr').each(function() {
            var idFinance = $(this).find('td:first').text().trim().toLowerCase();
            var date = $(this).find('td').eq(2).text().trim();

            var showRow = true;

            if (selectedValue !== "" && idFinance !== selectedValue) {
                showRow = false;
            }

            if (selectedDate !== "" && date !== selectedDate) {
                showRow = false;
            }

            if (showRow) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }
});
</script>