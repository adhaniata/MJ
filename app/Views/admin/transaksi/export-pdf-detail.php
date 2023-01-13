<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembelian</title>
</head>

<body>
    <h2>MJ Sport Collection</h2>
    <p>Meruya Utara, Jakarta Barat / 081285173625</p>
    <hr />
    <table width="100%" border="0">
        <tr>
            <td><b>Nama Pembeli</b></td>
            <td>: <?= $transaksi['nama']; ?> </td>
            <td><b>Tanggal Transaksi</b></td>
            <td>: <?= $transaksi['created_at']; ?> </td>
        </tr>
        <tr>
            <td><b>No Telepon</b></td>
            <td>: <?= $transaksi['telp']; ?> </td>
            <td><b>Resi Pengiriman</b></td>
            <td>: <?= $transaksi['no_resi']; ?> </td>
        </tr>
        <tr>
            <td><b>Alamat</b></td>
            <td>: <?= $transaksi['alamat']; ?> </td>
        </tr>
    </table>
    <hr />
    <h4>Nota Pembelian</h4>
    <table width="100%" border="2">
        <?php $i = 1; ?>
        <thead>
            <tr class="table-primary">
                <th scope="col">No</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Harga</th>
                <th scope="col">Quantity</th>
                <th scope="col">Jumlah Harga (Rupiah)</th>
            </tr>
        </thead>
        <tbody align="center">
            <?php $subtotal = 0; ?>
            <?php foreach ($transaksi_detail as $td) :
                $subtotal += $td['subtotal_harga']  ?>
                <tr>
                    <th><?= $i++ ?></th>
                    <td><?= $td['nama_produk'] ?></td>
                    <td><?= $td['total_harga'] ?></td>
                    <td><?= $td['qty'] ?></td>
                    <td><?= $td['subtotal_harga'] ?></td>
                </tr>
            <?php endforeach ?>
            <tr class="table-info">
                <th scope="row" colspan="4">Total Harga</th>
                <td><?= $subtotal ?></td>
            </tr>
            <tr class="table-info">
                <th scope="row" colspan="4">Total Ongkir</th>
                <td><?= $transaksi['ongkir'] ?></td>
            </tr>
            <tr class="table-info">
                <th scope="row" colspan="4">Total Pembayaran</th>
                <td><?= $transaksi['ongkir'] + $subtotal ?></td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <b>Catatan</b>
    <p>Jika produk yang diterima tidak sesuai, anda bisa melakukan retur pada menu pengembalian.</p>
    <!-- <table width="20%" border="0">
        <tr>
            <th>Hormat Kami</th>
        </tr>
        <tr>
            <td>
                <br>
                <br>
                <br>
                <br>
                <hr />
            </td>
        </tr>
        <tr>
            <td>
                <center>MJ Sport Collection </center>
            </td>
        </tr>
    </table> -->
</body>

</html>