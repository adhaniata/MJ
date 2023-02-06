<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!--navbar-->
<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="/img/Artboard 1.png" alt="Bootstrap" width="40" height="34">MJ Sport</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Admin</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/admin/tampilan-produk">Tampilan Produk</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-bars-progress"></i> Manage
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="/admin/kategori">Kategori</a></li>
                            <li><a class="dropdown-item" href="/admin/produk">Produk</a></li>
                            <li><a class="dropdown-item" href="/admin/transaksi">Transaksi</a></li>
                            <li><a class="dropdown-item" href="/admin/pengembalian">Pengembalian</a></li>
                            <li><a class="dropdown-item" href="/admin/ongkir">Ongkir</a></li>
                            <li><a class="dropdown-item" href="/admin/chatbot">Chatbot</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('logout') ?>"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                    </li>
                </ul>
                <!-- <form class="d-flex mt-3" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                </form> -->
            </div>
        </div>
    </div>
</nav>


<!--isi-->
<!--produk pajangan-->
<div class="container">
    <!-- <div class="input-group">
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Cari Produk" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div> -->
    <form class="row" action="tampilan-produk/cari" action="get">
        <?= csrf_field(); ?>
        <div class="col-4 mt-2">
            <div class="input-group col-1">
                <input class="form-control me-2" type="search" placeholder="Masukan Kata Kunci" aria-label="Search" name="cari">
                <button class="btn btn-outline-dark" type="submit">Search</button>
            </div>
        </div>
    </form>

    <h2>Produk</h2>
    <form action="tampilan-produk/kategori" method="get">
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
                            <a href="/admin/produk/<?= $p['slug_produk']; ?>" class="btn btn-dark">Detail</a>
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