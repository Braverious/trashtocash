<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=data-transaksi.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table>
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
                <td><?= $transaction['tanggal']; ?></td>
                <td>
                    <?php
                    if (isset($transaction['nominal'])) {
                        echo $transaction['nominal'];
                    } elseif (isset($transaction['nilai_tukar'])) {
                        echo $transaction['nilai_tukar'];
                    } elseif (isset($transaction['jumlah'])) {
                        echo $transaction['jumlah'];
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
</table>