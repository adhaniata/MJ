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
            <h3 class="my-3">Form Edit Data Produk</h3>
            <!--menambahkan action berisi method update untuk memproses edit-->
            <form action="/admin/produk/update/<?= $produk[0]['id_produk']; ?>" method="post" enctype="multipart/form-data">
                <!--fitur agar tidak ada pemalsuan, hanya bisa digunakan dihalaman ini saja-->
                <?= csrf_field(); ?>
                <!--menambahkan input slug bertype hidden-->
                <input type="hidden" name="slug_produk" value="<?= $produk[0]['slug_produk']; ?>">
                <!--menambahkan input gambar bertype hidden-->
                <input type="hidden" name="gambarProdukLama" value="<?= $produk[0]['gambar']; ?>">


                <div class="row mb-3">
                    <label for="id_kategoriFK" class="col-sm-2 col-form-label">Kategori Produk</label>
                    <div class="col-sm-10">
                        <select class="form-select <?= ($validation->hasError('id_kategoriFK')) ? 'is-invalid' : ''; ?>" name="id_kategoriFK" id="id_kategoriFK" aria-label="Default select example" value="<?= (old('id_kategoriFK')) ? old('id_kategoriFK') : $produk[0]['id_kategoriFK'] ?>">
                            <option selected>Pilih Kategori Produk (WAJIB)</option>
                            <?php foreach ($listKategori as $lk) {
                                echo '<option value="' . $lk['id_kategori'] . '">' . $lk['nama_kategori'] . '</option>';
                            } ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('id_kategoriFK'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nama_produk')) ? 'is-invalid' : ''; ?>" id="nama_produk" name="nama_produk" autofocus value="<?= (old('nama_produk')) ? old('nama_produk') : $produk[0]['nama_produk'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_produk'); ?>
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
                    <label for="harga_produk" class="col-sm-2 col-form-label">Harga (Rupiah)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('harga_produk')) ? 'is-invalid' : ''; ?>" id="harga_produk" name="harga_produk" value="<?= (old('harga_produk')) ? old('harga_produk') : $produk[0]['harga_produk'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('harga_produk'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('stok')) ? 'is-invalid' : ''; ?>" id="stok" name="stok" value="<?= (old('stok')) ? old('stok') : $produk[0]['stok'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('stok'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="gambarProduk" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <div class="mb-3">
                            <label for="gambarProduk" class="form-label"><?= $produk[0]['gambar']; ?></label>
                            <input class="form-control <?= ($validation->hasError('gambarProduk')) ? 'is-invalid' : ''; ?>" type="file" id="gambarProduk" name="gambarProduk" onchange="previewImgProduk()">
                            <br>
                            <div class="invalid-feedback">
                                <?= $validation->getError('gambarProduk'); ?>
                            </div>
                            <div class="col-sm-2">
                                <img src="/img/produk/<?= $produk[0]['gambar']; ?>" class="img-thumbnail img-preview">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" id="deskripsi" name="deskripsi" value="<?= (old('deskripsi')) ? old('deskripsi') : $produk[0]['deskripsi'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('deskripsi'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="size" class="col-sm-2 col-form-label">Size</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('size')) ? 'is-invalid' : ''; ?>" id="size" name="size" value="<?= (old('size')) ? old('size') : $produk[0]['size'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('size'); ?>
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