<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!--isi-->
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-3">Detail Biaya Pengiriman</h2>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/ongkir/<?= $ongkir['gambar']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $ongkir['kota']; ?></h5>
                            <p class="card-text">Dikirim dengan J&T Express: Reguler</p>
                            <p class="card-text">Biaya : <?= $ongkir['harga']; ?> Rupiah</p>
                            <!--<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
                            <a href="/ongkir">Kembali Ke Daftar Biaya Pengiriman</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <br>
</body>

</html>

<?= $this->endSection(); ?>