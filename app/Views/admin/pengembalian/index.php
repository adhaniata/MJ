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
<!--tabel-->
<div class="container">
    <div class="row">
        <div class="col">
            <table class="table table-bordered" id="datatable">
                <h2 class="mt-3 mb-4">Daftar Pengembalian Produk</h2>
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <dif class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </dif>
                <?php endif ?>
                <?php $i = 1; ?>
                <thead>
                    <tr class="table-primary">
                        <th scope="col">No</th>
                        <th scope="col">ID Transaksi</th>
                        <th scope="col">Nama User</th>
                        <th scope="col">No Telepon</th>
                        <th scope="col">Validasi</th>
                        <th scope="col">Status Pengembalian</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pengembalian as $key => $value) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $value['id_transaksi']; ?></td>
                            <td><?= $value['nama']; ?></td>
                            <td><?= $value['telp']; ?></td>
                            <td><?= $value['validasi']; ?></td>
                            <td><?= $value['status']; ?></td>
                            <td>
                                <a href="/admin/pengembalian/<?= $value['id_transaksi']; ?>" class="btn btn-dark">Detail</a>
                            </td>
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