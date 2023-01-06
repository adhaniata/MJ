<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!--nav-->
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


<!--isi-->
<!--tabel-->
<br><br>
<div class="container">
    <div class="row">
        <div class="col">
            <h2>Transaksi</h2>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <dif class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </dif>
            <?php endif ?>
            <table class="table table-bordered">
                <?php $i = 1; ?>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Id Transaksi</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Total Tagihan</th>
                        <th scope="col">Status Pembayaran</th>
                        <th scope="col">No Resi</th>
                        <th scope="col">Status Pengiriman</th>
                        <th scope="col">Tanggal Transaksi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transaksi as $t) : ?>
                        <tr>
                            <th><?= $i++ ?></th>
                            <td><?= $t['id_transaksi'] ?></td>
                            <td><?= $t['nama'] ?></td>
                            <td><?= $t['total_tagihan'] ?></td>
                            <td><?= $t['status_pembayaran'] ?></td>
                            <td><?= $t['no_resi'] ?></td>
                            <td><?= $t['status_pengiriman'] ?></td>
                            <td><?= $t['created_at'] ?></td>
                            <td>
                                <a href="/admin/transaksi/<?= $t['id_transaksi'] ?>" class="btn btn-info">Detail</a><br><br>
                                <a href="/admin/transaksi/edit/<?= $t['id_transaksi'] ?>" class="btn btn-warning">Edit</a><br><br>
                                <a href="/admin/transaksi/konfirmasi/<?= $t['id_transaksi'] ?>" class="btn btn-dark">Konfirmasi Pembayaran</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


</body>

</html>

<?= $this->endSection(); ?>