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
                        <a href="/recyloop/log/accounting">
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
                <a href="<?= base_url('log/exportToExcel'); ?>" class="btn btn-light mb-3">
                    <b>
                        <div class="printicon">
                            <i class="fa-solid fa-file-excel"></i>
                            Cetak Excell
                        </div>
                    </b>
                </a> <!-- Tombol untuk memicu ekspor ke Excel -->
                <a href="<?= base_url('log/pdf_accounting'); ?>" class="btn btn-light mb-3">
                    <b>
                        <div class="printicon">
                            <i class="fa-solid fa-file-pdf"></i>
                            Cetak PDF
                        </div>
                    </b>
                </a>
                <div class="container">
                    <div class="card border border-dark weather-card" style="width: 100%;">
                        <canvas id="lineChart" width="800" height="400" style="color: white;"></canvas> <!-- Tambahkan canvas untuk grafik -->
                    </div>
                    <div class="filter-group" style="display: flex; gap: 10px;">
                        <div class="filter-item" style="display: flex; flex-direction: column;">
                            <label for="searchJenis">Cari berdasarkan Jenis transaksi</label>
                            <input type="text" id="searchJenis" class="form-control" style="height: 38px; padding: 6px;" placeholder="Cari berdasarkan jenis">
                        </div>
                        <div class="filter-item" style="display: flex; flex-direction: column;">
                            <label for="dateSearch">Cari berdasarkan Tanggal:</label>
                            <input type="date" id="dateSearch" class="form-control" style="height: 38px; padding: 5px;">
                        </div>
                    </div>
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nominal</th>
                                <th>Jenis Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transactions as $transaction) : ?>
                                <tr>
                                    <td style="color: yellow;"><?= $transaction['tanggal']; ?></td>
                                    <td>
                                        <?php
                                        if (isset($transaction['nominal'])) {
                                            echo '<span style="color: red;"><i class="fa-solid fa-down-long"></i>&nbsp;&nbsp;Rp <b>' . number_format($transaction['nominal'], 0, ',', '.') . '</b></span>';
                                        } elseif (isset($transaction['nilai_tukar'])) {
                                            echo '<span style="color: lightgreen;"><i class="fa-solid fa-up-long"></i>&nbsp;&nbsp;Rp <b>' . number_format($transaction['nilai_tukar'], 0, ',', '.') . '</b></span>';
                                        } elseif (isset($transaction['jumlah'])) {
                                            echo '<span style="color: lightgreen;"><i class="fa-solid fa-up-long"></i>&nbsp;&nbsp;Rp <b>' . number_format($transaction['jumlah'], 0, ',', '.') . '</b></span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if (isset($transaction['nominal'])) {
                                            echo '<span style="color: white;">Withdraw</span>';
                                        } elseif (isset($transaction['nilai_tukar'])) {
                                            echo '<span style="color: white;">Distribusi</span>';
                                        } elseif (isset($transaction['jumlah'])) {
                                            echo '<span style="color: white;">Deposit</span>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="pagination-links">
                        <!-- Gajadi ah pusing ~ rehan -->
                    </div>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <script>
                $(document).ready(function() {
                    // Fungsi untuk menangani pencarian berdasarkan Jenis Transaksi
                    $('#searchJenis').on('input', function() {
                        var value = $(this).val().toLowerCase();
                        $('#dataTable tbody tr').filter(function() {
                            $(this).toggle($(this).find('td:nth-child(3)').text().toLowerCase().indexOf(value) > -1)
                        });
                    });

                    // Fungsi untuk menangani pencarian berdasarkan Tanggal
                    $('#dateSearch').on('change', function() {
                        var value = $(this).val();
                        $('#dataTable tbody tr').filter(function() {
                            $(this).toggle($(this).find('td:first-child').text().indexOf(value) > -1)
                        });
                    });
                });
            </script>
            <script>
                var dates = <?= json_encode(array_column($transactions, 'tanggal')); ?>;
                var nominals = <?= json_encode(array_column($transactions, 'nominal')); ?>;
                var nilaiTukars = <?= json_encode(array_column($transactions, 'nilai_tukar')); ?>;
                var jumlahs = <?= json_encode(array_column($transactions, 'jumlah')); ?>;

                var data = {
                    labels: dates,
                    datasets: [{
                        label: 'Withdraw',
                        data: nominals,
                        borderColor: 'red',
                        fill: false
                    }, {
                        label: 'Distribusi',
                        data: nilaiTukars,
                        borderColor: 'green',
                        fill: false
                    }, {
                        label: 'Deposit',
                        data: jumlahs,
                        borderColor: 'blue',
                        fill: false
                    }]
                };

                var options = {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Pergerakan Uang dalam 30 Hari Terakhir'
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Tanggal'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Jumlah Uang'
                            }
                        }]
                    }
                };

                // Menggambar grafik menggunakan Chart.js
                var ctx = document.getElementById('lineChart').getContext('2d');
                var lineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
            </script>
        </div>
    </div>