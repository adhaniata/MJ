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
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/admin/tampilan-produk">Tampilan Produk</a>
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
                            <a href="/admin/produk/edit/<?= $produk['slug_produk']; ?>" class="btn btn-warning">Edit</a>
                            <form action="/admin/produk/delete/<?= $produk['id_produk']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <!--agar lebih aman-->
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin?');">Delete</button><br>
                            </form>
                            <br>
                            <a href="/admin/produk" class="btn btn-dark">Kembali Ke Daftar Produk</a>
                            <a href="/admin/home" class="btn btn-secondary">Kembali Ke Home</a>
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