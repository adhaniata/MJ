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
                        <li><a class="dropdown-item" href="#">Kategori dan Produk</a></li>
                        <li><a class="dropdown-item" href="#">Transaksi</a></li>
                        <li><a class="dropdown-item" href="#">Chatbot</a></li>
                        <li><a class="dropdown-item" href="admin/ongkir/">Ongkir</a></li>
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