<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!--isi-->
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="mt-3">Detail Produk</h3>
            <div class="card mb-3" style="max-width: 1200px;">
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
            <h2 class="mt-3">Ulasan Produk</h2>
            <!-- card -->
            <div class="card text-bg-light mb-3" style="max-width: 18rem;">
                <div class="card-header">Nama User</div>
                <div class="card-body">
                    <h5 class="card-title">Light card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div><br>
        </div>
    </div>
</div>
</body>

</html>

<?= $this->endSection(); ?>