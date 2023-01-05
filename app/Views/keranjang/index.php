<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!--isi-->
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-3">Keranjang</h2>
            <table class="table table-bordered">
                <?php $i = 1; ?>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Jumlah Harga (Rupiah)</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $subtotal = 0; ?>
                    <?php foreach ($keranjang as $key => $value) : ?>
                        <?php $subtotal += $value['subtotal_harga']; ?>
                        <form action="keranjang/update/<?= $value['id_keranjang']; ?>" method="post" class="d-inline">
                        <?= csrf_field(); ?>
                        <!--agar lebih aman-->
                            <tr class="table-light">
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $value['nama_produk']; ?></td>
                                <td><img src="/img/produk/<?= $value['gambar']; ?>" width="100"> </td>
                                <td><?= $value['harga_produk']; ?></td>
                                <td>
                                    <fieldset>
                                        <input type="number" id="qty" name="qty" value="<?= $value['qty'] ?>" min="1" max="<?= $value['stok']; ?>">
                                        <input type="hidden" id="total_harga" name="total_harga" value="<?= $value['harga_produk'] ?>">
                                    </fieldset>
                                </td>
                                <td><?= $value['harga_produk'] * $value['qty']; ?></td>
                                <td>
                                    <a href="keranjang/delete/<?= $value['id_keranjang'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin?');">Delete</a>
                                    <button type="submit" class="btn btn-info">Update</button>
                                </td>
                            </tr>
                        </form>
                    <?php endforeach; ?>
                    <tr class="table-info">
                        <th scope="row">Total Harga</th>
                        <td colspan="5"><?= $subtotal ?></td>
                        <td><?= $count == 0 ? '' : '<a href="keranjang/checkout" class="btn btn-primary">Checkout</a>' ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<br><br>
<br><br><br><br><br>
</body>

</html>

<?= $this->endSection(); ?>