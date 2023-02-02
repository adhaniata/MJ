<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!--isi-->
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card mb-3 mt-3" style="max-width: 1200px;">
                <div class="card-header text-bg-dark">
                    <h4>Detail Produk</h4>
                </div>
                <div class="row g-0">
                    <div class="col-md-4" class="align-middle">
                        <img src="/img/produk/<?= $produk['gambar']; ?>" class="img-fluid rounded-start" width="1000" alt=" ...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><b><?= $produk['nama_produk']; ?></b></h5>
                            <p><b>Kategori :</b></p>
                            <p class="card-text"><?= $produk['nama_kategori']; ?></p>
                            <p><b>Deskripsi :</b></p>
                            <p class="card-text"><?= $produk['deskripsi']; ?></p>
                            <p><b>Harga :</b></p>
                            <p class="card-text"><?= $produk['harga_produk']; ?></p>
                            <p><b>Size :</b></p>
                            <p class="card-text"><?= $produk['size']; ?></p>
                            <p><b>Stok :</b></p>
                            <p class="card-text"><?= $produk['stok']; ?></p>
                            <!--<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
                            <!--<button type="button" class="btn btn-warning">Masukan ke Keranjang</button> <br><br>-->
                            <!-- ka ini gimana ya biar pas klik keranjang id_produk sama id users yg lagi login bisa ikut?-->
                            <form action="/keranjang/tambah-keranjang" method="POST">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>">
                                <input type="hidden" name="total_harga" value="<?= $produk['harga_produk'] ?>">
                                <label>Qty</label>
                                <input type="number" name="qty" value="1" min="1" max="<?= $produk['stok']; ?>" style="width: 50px;">
                                <button class="btn btn-warning" type="submit">Masukan ke Keranjang</button>
                            </form>
                            <a href="/" class="btn btn-dark">Kembali Ke Home</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <br>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card text-bg-light mb-3" style="max-width: 1200px;">
                <div class="card-header text-bg-secondary">
                    <h4>Ulasan Produk</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($ulasan as $u) : ?>
                            <div class="col">
                                <!-- card ulasan-->
                                <div class="card text-bg-light mb-3" style="max-width: 20rem;">
                                    <div class="card-header text-bg-light">Oleh <?= $u['nama']; ?></div>
                                    <div class="card-body">

                                        <p class="card-text"><b><?= $u['isi_ulasan']; ?></b></p>
                                    </div>
                                    <div class="card-footer text-muted">
                                        <?= $u['nama_produk']; ?> | Dibeli pada: <?= $u['tgl_konfirmasi']; ?>
                                    </div>
                                </div><br>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>

<?= $this->endSection(); ?>