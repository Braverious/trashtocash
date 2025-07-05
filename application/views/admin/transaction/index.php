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
                            <a href="/recyloop/transaction">
                                <i class="fa-solid fa-money-bill-transfer"></i> </a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Transaksi Penyerahan</a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Index</a>
                        </li>
                    </ul>
                </div>
                <div class="alert alert-info" role="alert" style="margin-top: 15px; background: white; color: #1A2035; border-radius: 5px;">
                    <b>
                        <li>Pastikan Anda secara aktif memeriksa antrian konfirmasi penyerahan sampah!</li>
                        <li>Catatan: BP Botol Plastik | KA Kaleng Alumunium | KK Kertas Kardus</li>
                    </b>
                </div>
                <a href="" data-toggle="modal" data-target="#newTransactionModal" class="btn btn-secondary mb-3" style="color:white;"><b>Tambah
                        Transaksi</b></a>
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
                                <th scope="col">BP</th>
                                <th scope="col">KA</th>
                                <th scope="col">KK</th>
                                <th scope="col">Lokasi</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $unconfirmedTransactions = array_filter($transaksi, function ($t) {
                                return $t['status'] === 'Belum dikonfirmasi';
                            });
                            ?>
                            <?php if (empty($unconfirmedTransactions)) : ?>
                                <tr>
                                    <td colspan="9" style="text-align: center;">Tidak ada transaksi yang belum dikonfirmasi.</td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($unconfirmedTransactions as $t) : ?>
                                    <tr>
                                        <td><?= $t['id_member']; ?></td>
                                        <td><?= $t['username']; ?></td>
                                        <td><?= $t['tanggal']; ?></td>
                                        <td style="color: white;"><?= $t['jumlah_botol']; ?></td>
                                        <td style="color: white;"><?= $t['jumlah_kaleng']; ?></td>
                                        <td style="color: white;"><?= $t['jumlah_kardus']; ?></td>
                                        <td><?= $t['lokasi']; ?></td>
                                        <td><?= $t['status']; ?></td>
                                        <td style="width: 100%;">
                                            <div style="display: inline-block; text-align: center; margin-bottom: 2px;">
                                                <a href="<?= base_url('transaction/edit_transaction/' . $t['id']); ?>" class="btn btn-light btn-sm" style="width: 30px; height: 30px;"><i style="color: #000;" class="fa-solid fa-pencil"></i></a>
                                                <a href="<?= base_url('transaction/delete_transaksi/' . $t['id']); ?>" class="btn btn-light btn-sm" style="width: 30px; height: 30px;"><i style="color: #000;" class="fa-solid fa-trash"></i></a>
                                            </div>
                                            <div style="display: inline-block; text-align: center;">
                                                <a href="<?= base_url('transaction/updatetransaction/' . $t['id']); ?>" class="btn btn-light btn-sm" style="width: 30px; height: 30px;"><i style="color: #000;" class="fa-solid fa-check"></i></a>
                                                <a href="<?= base_url('transaction/info_transaction/' . $t['id']); ?>" class="btn btn-light btn-sm" style="width: 30px; height: 30px;"><i style="color: #000;" class="fa-solid fa-info"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Tambah Transaksi Penyerahan  -->
            <div class="modal fade" id="newTransactionModal" tabindex="-1" aria-labelledby="newTransactionModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="background-color: #1A2035; border-radius: 10px;">
                    <div class="modal-content" style="background-color: #1A2035;">
                        <div class="modal-header">
                            <h2 class="modal-title text-white" id="newTransactionModalLabel"><b>Transaksi Baru</b></h2>
                            <button type="button" class="btn btn-close btn-small btn-cross" data-dismiss="modal" aria-label="Close">
                                <!-- &times; -->X
                            </button>
                        </div>
                        <form action="<?= base_url('transaction') ?>" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label style="color: #01E7f4 !important;" for="formGroupExampleInput">ID Member</label>
                                    <input style="background: #01E7f4; color: #1A2035; font-weight: 600;" type="text" class="form-control" id="id_member" name="id_member" placeholder="Ketik ID milik member" required>
                                    <?= form_error('id_member', '<small class="text-light">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label style="color: #01E7f4 !important;" for="formGroupExampleInput">User</label>
                                    <input style="background: #01E7f4; color: #1A2035; font-weight: 600;" type="text" class="form-control" id="username" name="username" placeholder="ID Member tidak ditemukan!" readonly>
                                </div>
                                <div class="form-group">
                                    <label style="color: #01E7f4 !important;" for="jumlah_botol">Botol Plastik</label>
                                    <input style="background: #01E7f4; color: #1A2035; font-weight: 600;" type="number" class="form-control" id="jumlah_botol" name="jumlah_botol" placeholder="Ketik jumlah botol yang ditukar" min="0" value="0">
                                </div>
                                <div class="form-group">
                                    <label style="color: #01E7f4 !important;" for="jumlah_kaleng">Kaleng Alumunium</label>
                                    <input style="background: #01E7f4; color: #1A2035; font-weight: 600;" type="number" class="form-control" id="jumlah_kaleng" name="jumlah_kaleng" placeholder="Ketik jumlah kaleng yang ditukar" min="0" value="0">
                                </div>
                                <div class="form-group">
                                    <label style="color: #01E7f4 !important;" for="jumlah_kardus">Kertas Kardus</label>
                                    <input style="background: #01E7f4; color: #1A2035; font-weight: 600;" type="number" class="form-control" id="jumlah_kardus" name="jumlah_kardus" placeholder="Ketik kardus kaleng yang ditukar" min="0" value="0">
                                </div>
                                <input type="hidden" id="total" name="total">
                                <input type="hidden" id="totalkoin" name="totalkoin">
                                <input type="hidden" id="totalkonversi" name="totalkonversi">
                                <input type="hidden" id="petugas" name="petugas">
                                <div class="form-group">
                                    <label style="color: #01E7f4 !important;" for="formGroupExampleInput2">Tanggal Penukaran</label>
                                    <input style="background: #01E7f4; color: #1A2035; font-weight: 600;" type="date" class="form-control" id="tanggal" name="tanggal" required>
                                    <?= form_error('tanggal', '<small class="text-light">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label style="color: #01E7f4 !important;" for="lokasi">Lokasi</label>
                                    <select class="form-control" id="lokasi" name="lokasi" style="background: #01E7f4; color: #1A2035;" required>
                                        <option value="" disabled selected>Pilih lokasi</option>
                                        <option value="Tenant Serpong">Tenant Serpong</option>
                                    </select>
                                    <?= form_error('lokasi', '<small class="text-light">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label style="color: #01E7f4 !important;" for="formGroupExampleInput">Komentar</label>
                                    <textarea style="background: #01E7f4; color: #1A2035; font-weight: 600;" class="form-control" id="catatan" name="catatan" placeholder="Tulis komentar di sini"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info">Add</button>
                            </div>
                        </form>
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
                document.addEventListener('DOMContentLoaded', function() {
                    const form = document.querySelector('form');
                    const idMemberInput = document.getElementById('id_member');
                    const tanggalInput = document.getElementById('tanggal');
                    const submitButton = document.querySelector('button[type="submit"]');

                    form.addEventListener('submit', function(event) {
                        let isValid = true;

                        if (idMemberInput.value.trim() === '') {
                            isValid = false;
                            idMemberInput.classList.add('is-invalid');
                            if (!document.getElementById('idMemberError')) {
                                const errorElement = document.createElement('small');
                                errorElement.id = 'idMemberError';
                                errorElement.className = 'text-light';
                                errorElement.textContent = 'ID Member wajib diisi!';
                                idMemberInput.parentNode.appendChild(errorElement);
                            }
                        } else {
                            idMemberInput.classList.remove('is-invalid');
                            const errorElement = document.getElementById('idMemberError');
                            if (errorElement) {
                                errorElement.remove();
                            }
                        }

                        if (tanggalInput.value.trim() === '') {
                            isValid = false;
                            tanggalInput.classList.add('is-invalid');
                            if (!document.getElementById('tanggalError')) {
                                const errorElement = document.createElement('small');
                                errorElement.id = 'tanggalError';
                                errorElement.className = 'text-light';
                                errorElement.textContent = 'Tanggal wajib diisi!';
                                tanggalInput.parentNode.appendChild(errorElement);
                            }
                        } else {
                            tanggalInput.classList.remove('is-invalid');
                            const errorElement = document.getElementById('tanggalError');
                            if (errorElement) {
                                errorElement.remove();
                            }
                        }

                        if (!isValid) {
                            event.preventDefault();
                        }
                    });
                });
            </script>
            <script>
                document.getElementById('id_member').addEventListener('input', function() {
                    var idMember = this.value;

                    if (idMember) {
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', '<?= base_url("transaction/getUsernameByIdMember"); ?>', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                                var response = JSON.parse(xhr.responseText);
                                document.getElementById('username').value = response.username;
                            }
                        };
                        xhr.send('id_member=' + idMember);
                    } else {
                        document.getElementById('username').value = '';
                    }
                });
            </script>