 <!-- <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">

 <div class="containers" style="font-family: Montserrat;">
     <div style="display: flex; justify-content: center; width: 100%;">
         <table id="dataTable" style="border: 1px solid black; border-collapse: collapse; text-align: center;">
             <thead>
                 <tr>
                     <th scope="col" style="border: 1px solid black;">Kode Member</th>
                     <th scope="col" style="border: 1px solid black;">User</th>
                     <th scope="col" style="border: 1px solid black;">Tanggal</th>
                     <th scope="col" style="border: 1px solid black;">Nominal</th>
                     <th scope="col" style="border: 1px solid black;">Metode</th>
                     <th scope="col" style="border: 1px solid black;">Status</th>
                 </tr>
             </thead>
             <tbody>
                 <?php foreach ($tithdraw as $t) : ?>
                     <?php if ($t['status'] === 'Belum diproses') : ?>
                         <tr>
                             <td style="border: 1px solid black; font-size: 14px;"><?= $t['id_member']; ?></td>
                             <td style="border: 1px solid black; font-size: 14px;"><?= $t['username']; ?></td>
                             <td style="border: 1px solid black; font-size: 14px;"><?= $t['tanggal']; ?></td>
                             <td style="border: 1px solid black; font-size: 14px;"><?= $t['nominal']; ?></td>
                             <td style="border: 1px solid black; font-size: 14px;"><?= $t['metode']; ?></td>
                             <td style="border: 1px solid black; font-size: 14px;"><?= $t['status']; ?></td>
                         </tr>
                     <?php endif; ?>
                 <?php endforeach; ?>
             </tbody>
         </table>
     </div>
 </div>
 aa -->

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
     <h3 style="text-align: center;">Laporan Transaksi bulan
         <?php echo date('F'); ?></h3>
     <table class="table-data" style="justify-content: center;">
         <thead>
             <tr>
                 <th scope="col" style="background: cyan; border: 1px solid black;">Kode Member</th>
                 <th scope="col" style="background: yellow; border: 1px solid black;">User</th>
                 <th scope="col" style="background: yellow; border: 1px solid black;">Tanggal</th>
                 <th scope="col" style="background: yellow; border: 1px solid black;">BP</th>
                 <th scope="col" style="background: yellow; border: 1px solid black;">KA</th>
                 <th scope="col" style="background: yellow; border: 1px solid black;">KK</th>
                 <th scope="col" style="background: yellow; border: 1px solid black;">Nominal</th>
                 <th scope="col" style="background: yellow; border: 1px solid black;">Status</th>
                 <th scope="col" style="background: yellow; border: 1px solid black;">Petugas</th>
             </tr>
         </thead>
         <tbody>
             <?php foreach ($transaction as $t) : ?>
                 ?>
                 <tr>
                     <td style="background: #D2FFFF; border: 1px solid black; font-size: 14px; text-align:center; justify-content:center;"><?= $t['id_member']; ?></td>
                     <td style="background: #FFF7DF; border: 1px solid black; font-size: 14px;"><?= $t['username']; ?></td>
                     <td style="background: #FFF7DF; border: 1px solid black; font-size: 14px; justify-content: center;"><?= $t['tanggal']; ?></td>
                     <td style="background: #FFF7DF; border: 1px solid black; font-size: 14px; justify-content: center;"><?= $t['jumlah_botol']; ?></td>
                     <td style="background: #FFF7DF; border: 1px solid black; font-size: 14px; justify-content: center;"><?= $t['jumlah_kaleng']; ?></td>
                     <td style="background: #FFF7DF; border: 1px solid black; font-size: 14px; justify-content: center;"><?= $t['jumlah_kardus']; ?></td>
                     <td style="background: #FFF7DF; border: 1px solid black; font-size: 14px;">Rp. <?= number_format($t['totalkoin'], 0, ',', '.') ?></td>
                     <td style="background: #FFF7DF; border: 1px solid black; font-size: 14px;"><?= $t['status']; ?></td>
                     <td style="background: #FFF7DF; border: 1px solid black; font-size: 14px;"><?= $t['petugas']; ?></td>
                 </tr>
             <?php endforeach; ?>
         </tbody>
         <div style="text-align: center;"><br>Data ini dimuat secara otomatis pada <b><?php echo strftime('%d %B %Y'); ?></b></div>
     </table>
 </body>

 </html>