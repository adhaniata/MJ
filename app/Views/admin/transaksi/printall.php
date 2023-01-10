<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>A4 landscape</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <!-- <style>
        @page {
            size: A4 landscape
        }
    </style> -->
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4 landscape" onload="print()">

    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet padding-10mm">

        <!-- Write HTML just like a web page -->
        <article>
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
        </article>

    </section>

</body>

</html>