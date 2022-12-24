<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!--navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="/img/Artboard 1.png" alt="Bootstrap" width="40" height="34">
            MJ Sport</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/admin/index">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-bars-progress"></i> Manage
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/admin/produk">Produk</a></li>
                        <li><a class="dropdown-item" href="#">Transaksi</a></li>
                        <li><a class="dropdown-item" href="#">Chatbot</a></li>
                        <li><a class="dropdown-item" href="/admin/ongkir">Ongkir</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('logout') ?>"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/home"><i class="fa-solid fa-chart-simple"></i> Pendapatan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Link</a>
                </li>
            </ul>
            <form class="d-flex pt-2" role="search">
                <input class="form-control me-2" type="search" placeholder="Cari..." aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
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
    <h3>Kategori Produk</h3>
    <select class="form-select" aria-label="Default select example">
        <option selected>ALL</option>
        <option value="1">Sepatu</option>
        <option value="2">Pakaian</option>
        <option value="3">Aksesoris</option>
    </select><br><br>
    <h2>Produk</h2>
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
                            <a href="/admin/index/<?= $p['slug_produk']; ?>" class="btn btn-dark">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<br><br>
<br<br><br><br><br>
    </body>

    </html>

    <?= $this->endSection(); ?>