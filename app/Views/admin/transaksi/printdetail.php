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
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-md-4 form-label">Nama</label>
                        <div class="col-md-8">
                            <input type="text" name="" value="<?= $transaksi['nama'] ?>" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-2 mb-2">
                    <div class="form-group row">
                        <label class="col-md-4 form-label">Alamat</label>
                        <div class="col-md-8">
                            <textarea class="form-control" readonly><?= $transaksi['alamat'] ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                    <div class="form-group row">
                        <label class="col-md-4 form-label">Telp</label>
                        <div class="col-md-8">
                            <input type="text" name="" value="<?= $transaksi['telp'] ?>" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-2 mb-2">
                    <div class="form-group row">
                        <label class="col-md-4 form-label">No Resi</label>
                        <div class="col-md-8">
                            <input type="text" name="" value="<?= $transaksi['no_resi'] ?>" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-2 mb-2">
                    <div class="form-group row">
                        <label class="col-md-4 form-label">Status Pembayaran</label>
                        <div class="col-md-8">
                            <input type="text" name="" value="<?= $transaksi['status_pembayaran'] ?>" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <table width="100%" border="1">
                <?php $i = 1; ?>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Jumlah Harga (Rupiah)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $subtotal = 0; ?>
                    <?php foreach ($transaksi_detail as $td) :
                        $subtotal += $td['subtotal_harga']  ?>
                        <tr>
                            <th><?= $i++ ?></th>
                            <td><?= $td['nama_produk'] ?></td>
                            <td><img src="/img/produk/<?= $td['gambar']; ?>" width="100"> </td>
                            <td><?= $td['total_harga'] ?></td>
                            <td><?= $td['qty'] ?></td>
                            <td><?= $td['subtotal_harga'] ?></td>
                        </tr>
                    <?php endforeach ?>
                    <tr class="table-info">
                        <th scope="row" colspan="5">Total Harga</th>
                        <td><?= $subtotal ?></td>
                    </tr>
                    <tr class="table-info">
                        <th scope="row" colspan="5">Total Ongkir</th>
                        <td><?= $transaksi['ongkir'] ?></td>
                    </tr>
                    <tr class="table-info">
                        <th scope="row" colspan="5">Total Pembayaran</th>
                        <td><?= $transaksi['ongkir'] + $subtotal ?></td>
                    </tr>
                </tbody>
            </table>
            </div>
        </article>

    </section>

</body>

</html>