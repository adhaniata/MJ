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
<div class="container">
    <div class="row">
        <div class="col-8">
            <h3 class="my-3">Form Edit Data Biaya Ongkir</h3>
            <!--menambahkan action berisi method update untuk memproses edit-->
            <form action="/admin/ongkir/update/<?= $ongkir['id_ongkir']; ?>" method="post" enctype="multipart/form-data">
                <!--fitur agar tidak ada pemalsuan, hanya bisa digunakan dihalaman ini saja-->
                <?= csrf_field(); ?>
                <!--menambahkan input slug bertype hidden-->
                <input type="hidden" name="slug" value="<?= $ongkir['slug']; ?>">
                <!--menambahkan input gambar bertype hidden-->
                <input type="hidden" name="gambarOngkirLama" value="<?= $ongkir['gambar']; ?>">

                <div class="row mb-3">
                    <label for="kota" class="col-sm-2 col-form-label">Kota</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('kota')) ? 'is-invalid' : ''; ?>" id="kota" name="kota" autofocus value="<?= (old('kota')) ? old('kota') : $ongkir['kota'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('kota'); ?>
                        </div>
                    </div>
                </div>
                <!--<div class="row mb-3">
                    <label for="slug" class="col-sm-2 col-form-label">Slug (huruf kecil)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="slug" name="slug">
                    </div>
                </div>-->
                <div class="row mb-3">
                    <label for="harga" class="col-sm-2 col-form-label">Harga (Rupiah)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" name="harga" value="<?= (old('harga')) ? old('harga') : $ongkir['harga'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('harga'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="gambarOngkir" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <div class="mb-3">
                            <label for="gambarOngkir" class="form-label"><?= $ongkir['gambar']; ?></label>
                            <input class="form-control <?= ($validation->hasError('gambarOngkir')) ? 'is-invalid' : ''; ?>" type="file" id="gambarOngkir" name="gambarOngkir" onchange="previewImgOngkir()">
                            <br>
                            <div class="invalid-feedback">
                                <?= $validation->getError('gambarOngkir'); ?>
                            </div>
                            <div class="col-sm-2">
                                <img src="/img/ongkir/<?= $ongkir['gambar']; ?>" class="img-thumbnail img-preview">
                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input class="form-control" type="file" id="gambar" name="gambar">
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword3">
                    </div>
                </div>-->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div> <br>
</body>

</html>

<?= $this->endSection(); ?>