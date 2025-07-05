<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        .logo {
            width: 200px;
        }

        u {
            background-color: #d3d3d3;
            /* Light gray background color */
        }
    </style>
</head>

<body>
    <?php $selisih = $withdraw['koin1'] - $withdraw['koin2'] ?>
    <div class="container">
        <h1 style="margin-bottom: -10px;">Receipt</h1>
        ------------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>

        Telah diterima sebesar <u>Rp. <?= $withdraw['nominal']; ?> </u> pada tanggal <?= $withdraw['formatted_tanggal']; ?> dengan <u>Sdr. <?= $withdraw['username']; ?></u> dari saldo akun.
        <br>
        Petugas <?= $user['username']; ?> menyerahkan dengan <?= $withdraw['metode']; ?> sebesar <u>Rp. <?= $withdraw['nominal']; ?></u>, saldo koin berkurang sebesar <?= $selisih ?>.
        <table>
            <thead>
                <tr>
                    <th>ID Member</th>
                    <th>Username</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Lokasi</th>
                    <th>Tunai</th>
                    <th>Nomor Rekening</th>
                    <th>Koin Sebelum</th>
                    <th>Koin Saat Ini</th>
                    <th>Nominal Yang Ditarik Tunai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $withdraw['id_member']; ?></td>
                    <td><?= $withdraw['username']; ?></td>
                    <td><?= $withdraw['tanggal']; ?></td>
                    <td><?= $withdraw['jam']; ?></td>
                    <td><?= $withdraw['lokasi']; ?></td>
                    <td><?= $withdraw['metode']; ?></td>
                    <td><?= $withdraw['norek']; ?></td>
                    <td><?= $withdraw['koin1']; ?></td>
                    <td><?= $withdraw['koin2']; ?></td>
                    <td>Rp. <?= $withdraw['nominal']; ?></td>
                </tr>
            </tbody>
        </table>
        <br>
        <div style="text-align: center;">Data ini dimuat secara otomatis pada <b><?php echo date('d F Y, H:i:s'); ?></b></div>
        <div style="text-align: center;">Security Print Key: <b><?php echo mt_rand(1000000000, 9999999999); ?></b></div>
        ------------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>

    </div>
</body>

</html>