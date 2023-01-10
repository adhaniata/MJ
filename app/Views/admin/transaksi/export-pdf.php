<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <center>
        <h3>Laporan Semua Transaksi Penjualan MJ Sport</h3>
    </center>
    <table width="100%" border="1">
        <?php $i = 1; ?>
        <thead>
            <tr class="table-primary">
                <th scope="col">No</th>
                <th scope="col">ID Transaksi</th>
                <th scope="col">Nama</th>
                <th scope="col">Total Tagihan</th>
                <th scope="col">Status Pembayaran</th>
                <th scope="col">No Resi</th>
                <th scope="col">Status Pengiriman</th>
                <th scope="col">Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transaksi as $t) : ?>
                <tr>
                    <th><?= $i++ ?></th>
                    <td><?= $t['id_transaksi'] ?></td>
                    <td><?= $t['nama'] ?></td>
                    <td><?= $t['total_tagihan'] ?></td>
                    <td><?= $t['status_pembayaran'] ?></td>
                    <td><?= $t['no_resi'] ?></td>
                    <td><?= $t['status_pengiriman'] ?></td>
                    <td><?= $t['created_at'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>