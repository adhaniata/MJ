<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!--isi-->
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-3">Detail Transaksi</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-md-4 form-label">Nama</label>
                        <div class="col-md-8">
                            <input type="text" name="" value="<?= $transaksi['nama'] ?>" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-md-4 form-label">No Resi</label>
                        <div class="col-md-8">
                            <input type="text" name="" value="<?= $transaksi['no_resi'] ?>" class="form-control" readonly>
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
                <div class="col-md-6 mt-2 mb-2">
                    <div class="form-group row">
                        <label class="col-md-4 form-label">Status Pembayaran</label>
                        <div class="col-md-8">
                            <input type="text" name="" value="<?= $transaksi['status_pembayaran'] ?>" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-2 mb-2">
                    <div class="form-group row">
                        <label class="col-md-4 form-label">Telepon</label>
                        <div class="col-md-8">
                            <input type="text" name="" value="<?= $transaksi['telp'] ?>" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-2 mb-2">
                    <div class="form-group row">
                        <label class="col-md-4 form-label">Status Pengiriman</label>
                        <div class="col-md-8">
                            <input type="text" name="" value="<?= $transaksi['status_pengiriman'] ?>" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <br>
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
            <a href="/transaksi/ulasan-selesai/<?= $transaksi['id_transaksi'] ?>" class="btn btn-primary">Lihat Ulasan</a>
        </div>
    </div>
</div>
<br><br>
<br><br><br><br><br>
</body>

</html>

<?= $this->endSection(); ?>