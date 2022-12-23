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
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i> Keranjang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php"><i class="fa-solid fa-user"></i> Login</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-store"></i>
                        e-commerce
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="https://www.shopee.co.id/" target="_blank">Shopee</a></li>
                        <li><a class="dropdown-item" href="https://www.tokopedia.coma/" target="_blank">Tokopedia</a></li>
                        <li><a class="dropdown-item" href="https://www.lazada.co.id/" target="_blank">Lazada</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa-solid fa-robot"></i> Chatbot</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ongkir/"><i class="fa-solid fa-robot"></i> Biaya Kirim</a>
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
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-3">Detail Produk</h2>
            <div class="card mb-3" style="max-width: 1200px;">
                <div class="row g-0">
                    <div class="col-md-4" class="align-middle">
                        <img src="/img/produk/<?= $produk[0]['gambar']; ?>" class="img-fluid rounded-start" width="1000" alt=" ...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $produk[0]['nama_produk']; ?></h5>
                            <p><b>Kategori :</b></p>
                            <p class="card-text"><?= $produk[0]['nama_kategori']; ?></p>
                            <p><b>Deskripsi :</b></p>
                            <p class="card-text"><?= $produk[0]['deskripsi']; ?></p>
                            <p><b>Harga :</b></p>
                            <p class="card-text"><?= $produk[0]['harga_produk']; ?></p>
                            <p><b>Size :</b></p>
                            <p class="card-text"><?= $produk[0]['size']; ?></p>
                            <p><b>Stok :</b></p>
                            <p class="card-text"><?= $produk[0]['stok']; ?></p>
                            <!--<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
                            <button type="button" class="btn btn-warning">Masukan ke Keranjang</button> <br><br>
                            <a href="/home" class="btn btn-dark">Kembali Ke Home</a>

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