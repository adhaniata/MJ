<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!--isi-->
<!--slide gambar-->
<center>
    <div id="mycarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="/img/sepatuslide1.png" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="/img/sepatuslide3.jpg" alt="Second slide">
            </div>
        </div>
    </div>
    <script language="JavaScript" type="text/javascript">
        $(document).ready(function() {
            $('#mycarousel').carousel({
                interval: 3000
            })
        });
    </script>
    <br><br><br>
</center>


<!--produk pajangan-->
<div class="container">
    <div class="input-group">
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Cari Produk" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>

    <h2>Produk</h2>

    <div class="input-group">
        <select class="form-select" name="id_kategoriFK" id="id_kategoriFK" aria-label="Example select with button addon">
            <option selected>Semua</option>
            <?php foreach ($listKategori as $lk) {
                echo '<option value="' . $lk['id_kategori'] . '">' . $lk['nama_kategori'] . '</option>';
            } ?>
        </select>
        <button class="btn btn-outline-dark" type="button">Terapkan Kategori</button>
    </div></br>

    <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php foreach ($produk as $p) : ?>
            <div class="col">
                <div class="card-group">
                    <div class="card">
                        <img class="card-img-top" src="/img/produk/<?= $p['gambar']; ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?= $p['nama_produk']; ?></h5>
                            <p><b>Deskripsi :</b></p>
                            <p class="card-text"><?= $p['deskripsi']; ?></p>
                            <p><b>Harga :</b></p>
                            <p class="card-text"><?= $p['harga_produk']; ?></p>
                            <a href="/produk/<?= $p['slug_produk']; ?>" class="btn btn-dark">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<br><br>
<br><br><br><br><br>
</body>

</html>

<?= $this->endSection(); ?>