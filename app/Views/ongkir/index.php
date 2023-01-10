<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!--isi-->
<!--tabel-->
<div class="container">
    <div class="row">
        <div class="col">
            <table class="table">
                <h2 class="mt-3">Daftar Biaya Pengiriman</h2>
                <?php $i = 1; ?>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">ID Ongkir</th>
                        <th scope="col">Provinsi</th>
                        <th scope="col">Harga (Rupiah)</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ongkir as $o) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $o['id_ongkir']; ?></td>
                            <td><?= $o['kota']; ?></td>
                            <td><?= $o['harga']; ?></td>
                            <td><a href="/ongkir/<?= $o['slug']; ?>" class="btn btn-dark">Detail</a> </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<br><br><br>


</body>

</html>

<?= $this->endSection(); ?>