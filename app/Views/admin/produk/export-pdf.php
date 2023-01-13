<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Produk Penjualan MJ Sport</title>
</head>

<body>
    <center>
        <h3><?= $ket ?></h3>
    </center>
    <table width="100%" border="1">
        <?php $i = 1; ?>
        <thead>
            <tr class="table-primary">
                <th scope="col">No</th>
                <th scope="col">ID Produk</th>
                <th scope="col">Kategori</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Harga (Rupiah)</th>
                <th scope="col">Stok</th>
                <th scope="col">Gambar</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Size</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produk as $key => $value) : ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $value['id_produk']; ?></td>
                    <td><?= $value['nama_kategori']; ?></td>
                    <td><?= $value['nama_produk']; ?></td>
                    <td><?= $value['harga_produk']; ?></td>
                    <td><?= $value['stok']; ?></td>
                    <td><img src="/img/produk/<?= $value['gambar']; ?>" width="100"> </td>
                    <td><?= $value['deskripsi']; ?></td>
                    <td><?= $value['size']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>