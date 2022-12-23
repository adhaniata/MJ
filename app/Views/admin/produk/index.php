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
                    <a class="nav-link" aria-current="page" href="/admin/index">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-bars-progress"></i> Manage
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/admin/produk">Kategori dan Produk</a></li>
                        <li><a class="dropdown-item" href="#">Transaksi</a></li>
                        <li><a class="dropdown-item" href="#">Chatbot</a></li>
                        <li><a class="dropdown-item" href="/admin/ongkir">Ongkir</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/home"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
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
<!--tabel-->
<div class="container">
    <div class="row">
        <div class="col">
            <table class="table">
                <a href="/admin/produk/create" class="btn btn-primary mt-4">Tambah Produk</a>
                <h2 class="mt-3 mb-4">Produk</h2>
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <dif class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </dif>
                <?php endif ?>
                <?php $i = 1; ?>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">ID Produk</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga (Rp)</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Size</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produk as $key => $value) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $value['id_produk']; ?></td>
                            <td><?= $value['nama_kategori']; ?></td>
                            <td><?= $value['nama_produk']; ?></td>
                            <td><?= $value['harga_produk']; ?></td>
                            <td><?= $value['stok']; ?></td>
                            <td><img src="/img/produk/<?= $value['gambar']; ?>" width="100"> </td>
                            <td><?= $value['deskripsi']; ?></td>
                            <td><?= $value['size']; ?></td>
                            <td><a href="/admin/produk/<?= $value['slug_produk']; ?>" class="btn btn-dark">Detail</a></td>
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