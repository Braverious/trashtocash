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
                        <a href="/recyloop/log/transaction">
                            <i class="fa-solid fa-file-lines"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Log Transaksi Penyerahan</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Index</a>
                    </li>
                </ul>
            </div>
            <div class="containers">
                <button id="printPdfButton" class="btn btn-light mb-3">
                    <b>
                        <div class="printicon">
                            <i class="fa-solid fa-print"></i>
                            Cetak PDF
                        </div>
                    </b>
                </button>
                <div class="filter-group" style="display: flex; gap: 10px;">
                    <div class="filter-item" style="display: flex; flex-direction: column;">
                        <label for="searchName">Cari berdasarkan User</label>
                        <input type="text" id="searchName" class="form-control" style="height: 38px; padding: 6px;"
                            placeholder="Cari berdasarkan user">
                    </div>
                    <div class="filter-item" style="display: flex; flex-direction: column;">
                        <label for="dateSearch">Cari berdasarkan Tanggal:</label>
                        <input type="date" id="dateSearch" class="form-control" style="height: 38px; padding: 5px;">
                    </div>
                </div>
                <table id="dataTable" class="table">
                    <thead>
                        <tr>
                            <th scope="col">Kode Member</th>
                            <th scope="col">User</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">BP</th>
                            <th scope="col">KA</th>
                            <th scope="col">KK</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Petugas</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($transaction)) : ?>
                        <tr>
                            <td colspan="9" style="text-align: center;">Tidak ada transaksi yang belum dikonfirmasi.
                            </td>
                        </tr>
                        <?php else : ?>
                        <?php foreach ($transaction as $t) : ?>
                        <tr>
                            <td><?= $t['id_member']; ?></td>
                            <td><?= $t['username']; ?></td>
                            <td><?= $t['tanggal']; ?></td>
                            <td><?= $t['jumlah_botol']; ?></td>
                            <td><?= $t['jumlah_kaleng']; ?></td>
                            <td><?= $t['jumlah_kardus']; ?></td>
                            <td><?= $t['lokasi']; ?></td>
                            <td><?= $t['petugas']; ?></td>
                            <td>
                                <div style="text-align: center;">
                                    <a href="<?= base_url('log/info_transaction/' . $t['id']); ?>"
                                        class="btn btn-light btn-sm" style="width: 30px; height: 30px;"><i
                                            style="color: #000;" class="fa-solid fa-info"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <script>
            $(document).ready(function() {
                const searchNameInput = $('#searchName');
                const dateSearchInput = $('#dateSearch');
                const rows = $('#dataTable tbody tr');
                const printPdfButton = $('#printPdfButton');

                searchNameInput.on('input', filterTable);
                dateSearchInput.on('input', filterTable);

                printPdfButton.on('click', function() {
                    const searchNameValue = searchNameInput.val().toLowerCase();
                    const dateSearchValue = dateSearchInput.val();
                    let url = "pdf_transaction?";
                    if (dateSearchValue) {
                        url += "date=" + dateSearchValue;
                    }
                    if (searchNameValue) {
                        if (dateSearchValue) {
                            url += "&";
                        }
                        url += "user=" + searchNameValue;
                    }
                    window.location.href = url;
                });

                function filterTable() {
                    const searchNameValue = searchNameInput.val().toLowerCase();
                    const dateSearchValue = dateSearchInput.val();

                    rows.each(function() {
                        const cells = $(this).find('td');
                        const userName = cells.eq(1).text().toLowerCase();
                        const date = cells.eq(2).text();

                        const nameMatch = !searchNameValue || userName.includes(searchNameValue);
                        const dateMatch = !dateSearchValue || date === dateSearchValue;

                        if (nameMatch && dateMatch) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                }
            });
            </script>
        </div>
    </div>
</div>