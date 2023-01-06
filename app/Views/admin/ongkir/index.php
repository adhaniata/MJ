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
                            <li><a class="dropdown-item" href="#">Kategori</a></li>
                            <li><a class="dropdown-item" href="/admin/produk">Produk</a></li>
                            <li><a class="dropdown-item" href="/admin/transaksi">Transaksi</a></li>
                            <li><a class="dropdown-item" href="#">Pendapatan</a></li>
                            <li><a class="dropdown-item" href="/admin/ongkir">Ongkir</a></li>
                            <li><a class="dropdown-item" href="#">Chatbot</a></li>
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
<br><br><br>

<!--isi-->
<!--tabel-->
<div class="container">
    <div class="row">
        <div class="col">
            <table class="table">
                <a href="/admin/ongkir/create" class="btn btn-primary mt-1 mr-1">Tambah Data Ongkir</a>
                <a href="/admin" class="btn btn-dark ml-1 mt-1">Kembali</a>
                <h2 class="mt-3 mb-4">Daftar Biaya Pengiriman</h2>
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <dif class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </dif>
                <?php endif ?>
                <?php $i = 1; ?>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">ID Ongkir</th>
                        <th scope="col">Provinsi</th>
                        <th scope="col">Harga (Rupiah)</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ongkir as $key => $value) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $value['id_ongkir']; ?></td>
                            <td><?= $value['kota']; ?></td>
                            <td><?= $value['harga']; ?></td>
                            <td><a href="/admin/ongkir/<?= $value['slug']; ?>" class="btn btn-dark">Detail</a> </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


</body>

</html>

<?= $this->endSection(); ?>