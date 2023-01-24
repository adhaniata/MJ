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
                            <li><a class="dropdown-item" href="/admin/pengembalian">Pengembalian</a></li>
                            <li><a class="dropdown-item" href="/admin/pendapatan">Pendapatan</a></li>
                            <li><a class="dropdown-item" href="/admin/ongkir">Ongkir</a></li>
                            <li><a class="dropdown-item" href="/admin/chatbot">Chatbot</a></li>
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
<div class="container">
    <div class="row">
        <div class="col">
            <table class="table table-bordered" id="datatable">
                <h2 class="mt-3 mb-1">Produk</h2>
                <div class="row">
                    <div class="col">
                        <!-- <a href="/admin/produk/create" class="btn btn-primary mt-4">Tambah Produk</a> -->
                        <br>
                        <form action="/admin/produk/proses" method="post">
                            <?= csrf_field(); ?>
                            <!-- untuk export -->
                            <h5>Export Data</h5>
                            <div class="form-group row mt-2">
                                <label class="col-md-2">Filter</label>
                                <div class="col-md-10">
                                    <select class="form-control" id="filter" name="filter">
                                        <?php foreach ($listKategori as $lk) {
                                            echo '<option value="' . $lk['id_kategori'] . '">' . $lk['nama_kategori'] . '</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label class="col-md-2">Type</label>
                                <div class="col-md-10">
                                    <select class="form-control" id="type" name="type">
                                        <option value="pdf">PDF</option>
                                        <option value="excel">Excel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-md-10">
                                    <button type="submit" class="btn btn-success">Proses</button>
                                </div>
                            </div>
                        </form>
                        <a href="/admin/produk/create" class="btn btn-primary mt-4">Tambah Produk</a>
                        <!-- <form class="row" action="/admin/produk/cari" action="get">
                            <?= csrf_field(); ?>
                            <div class="col-10 mt-2">
                                <div class="input-group col-1">
                                    <input class="form-control me-2" type="search" placeholder="Masukan Kata Kunci" aria-label="Search" name="cari">
                                    <button class="btn btn-outline-dark" type="submit">Search</button>
                                </div>
                            </div>
                        </form><br> -->
                    </div>
                    <div class="col">

                    </div>
                </div>
                <br>
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <dif class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </dif>
                <?php endif ?>
                <?php $i = 1; ?>
                <thead>
                    <tr class="table-primary">
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