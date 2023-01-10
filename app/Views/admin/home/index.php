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
                        <a class="nav-link active" aria-current="page" href="/">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-bars-progress"></i> Manage
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="/admin/kategori">Kategori</a></li>
                            <li><a class="dropdown-item" href="/admin/produk">Produk</a></li>
                            <li><a class="dropdown-item" href="/admin/transaksi">Transaksi</a></li>
                            <li><a class="dropdown-item" href="#">Pendapatan</a></li>
                            <li><a class="dropdown-item" href="/admin/ongkir">Ongkir</a></li>
                            <li><a class="dropdown-item" href="#">Chatbot</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-bars-progress"></i> Akun
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="/admin/akun/profil">Profil</a></li>
                            <li><a class="dropdown-item" href="/admin/akun/password">Ubah Password</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('logout') ?>"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                    </li>
                </ul>
                <form class="d-flex mt-3" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
</nav>
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