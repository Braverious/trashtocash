 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title></title>
 </head>

 <body>
     <style type="text/css">
         .table-data {
             width: 100%;
             border-collapse: collapse;
         }

         .table-data tr th,
         .table-data tr td {
             border: 1px solid black;
             font-size: 11pt;
             padding: 10px 10px 10px 10px;
         }
     </style>
     <h3 style="text-align: center;">Laporan Seluruh Transaksi bulan
         <?php echo date('F'); ?></h3>
     <table class="table-data" style="justify-content: center;">
         <thead>
             <tr>
                 <th style="border: 1px solid black">Tanggal</th>
                 <th style="border: 1px solid black">Nominal</th>
                 <th style="border: 1px solid black">Jenis Transaksi</th>
             </tr>
         </thead>
         <tbody>
             <?php foreach ($transactions as $transaction) : ?>
                 <tr>
                     <td style="color: black;"><?= $transaction['tanggal']; ?></td>
                     <td>
                         <?php
                            if (isset($transaction['nominal'])) {
                                echo '<span style="color: red;"><i class="fa-solid fa-down-long"></i>&nbsp;&nbsp;Rp <b>' . number_format($transaction['nominal'], 0, ',', '.') . '</b></span>';
                            } elseif (isset($transaction['nilai_tukar'])) {
                                echo '<span style="color: lightgreen;"><i class="fa-solid fa-up-long"></i>&nbsp;&nbsp;Rp <b>' . number_format($transaction['nilai_tukar'], 0, ',', '.') . '</b<</span>';
                            } elseif (isset($transaction['jumlah'])) {
                                echo '<span style="color: lightgreen;"><i class="fa-solid fa-up-long"></i>&nbsp;&nbsp;Rp <b>' . number_format($transaction['jumlah'], 0, ',', '.') . '</b></span>';
                            }
                            ?>
                     </td>
                     <td>
                         <?php
                            if (isset($transaction['nominal'])) {
                                echo "Withdraw";
                            } elseif (isset($transaction['nilai_tukar'])) {
                                echo "Distribusi";
                            } elseif (isset($transaction['jumlah'])) {
                                echo "Deposit";
                            }
                            ?>
                     </td>
                 </tr>
             <?php endforeach; ?>
         </tbody>
         <div style="text-align: center;"><br>Data ini dimuat secara otomatis pada <b><?php echo strftime('%d %B %Y'); ?></b></div>
     </table>
 </body>

 </html>