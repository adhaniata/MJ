<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!--isi-->
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-3">Transaksi Saya</h2>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <dif class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </dif>
            <?php endif ?>
            <table class="table table-bordered">
                <?php $i = 1; ?>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Id Transaksi</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Total Tagihan</th>
                        <th scope="col">Status Pembayaran</th>
                        <th scope="col">Tanggal Transaksi</th>
                        <th scope="col">Aksi</th>
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
                            <td><?= $t['created_at'] ?></td>
                            <td>
                                <a href="/transaksi/<?= $t['id_transaksi'] ?>" class="btn btn-info">Detail</a>
                                <a href="/transaksi/konfirmasi/<?= $t['id_transaksi'] ?>" class="btn btn-warning">Konfirmasi Pembayaran</a>
                                <a href="/transaksi/delete/<?= $t['id_transaksi'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin?');">Batalkan</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
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