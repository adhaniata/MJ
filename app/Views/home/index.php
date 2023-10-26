<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!--isi-->
<!--slide gambar-->
<center>
    <div id="mycarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-80" src="/img/spt1.jpeg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-80" src="/img/spt2.jpeg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-80" src="/img/spt3.jpeg" alt="Second slide">
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
    <!-- <div class="input-group">
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Cari Produk" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div> -->
    <form class="row" action="cari" action="get">
        <?= csrf_field(); ?>
        <div class="col-4 mt-2">
            <div class="input-group col-1">
                <input class="form-control me-2" type="search" placeholder="Masukan Kata Kunci" aria-label="Search" name="cari">
                <button class="btn btn-outline-dark" type="submit">Search</button>
            </div>
        </div>
    </form>

    <h2>Produk</h2>
    <form action="/kategori" method="get">
        <?= csrf_field(); ?>
        <div class="input-group">
            <select class="form-select" name="fillter_tp" id="fillter_tp" aria-label="Example select with button addon">
                <option value="semua">Semua</option>
                <?php foreach ($listKategori as $lk) {
                    echo '<option value="' . $lk['nama_kategori'] . '">' . $lk['nama_kategori'] . '</option>';
                } ?>
            </select>
            <button class="btn btn-outline-dark" type="submit">Terapkan Kategori</button>
        </div>
    </form></br>

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