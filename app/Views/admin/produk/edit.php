<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!--navbar-->
<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="/img/Artboard 1.png" alt="Bootstrap" width="40" height="34">MJ
            Sport</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
            aria-controls="offcanvasDarkNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
            aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Admin</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
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
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
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
                        <a class="nav-link" href="<?= base_url('logout') ?>"><i
                                class="fa-solid fa-right-from-bracket"></i> Logout</a>
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
        <div class="col-8">
            <h3 class="my-3">Form Edit Data Produk</h3>
            <!--menambahkan action berisi method update untuk memproses edit-->
            <form action="/admin/produk/update/<?= $produk['id_produk']; ?>" method="post"
                enctype="multipart/form-data">
                <!--fitur agar tidak ada pemalsuan, hanya bisa digunakan dihalaman ini saja-->
                <?= csrf_field(); ?>
                <!--menambahkan input slug bertype hidden-->
                <input type="hidden" name="slug_produk" value="<?= $produk['slug_produk']; ?>">
                <!--menambahkan input gambar bertype hidden-->
                <input type="hidden" name="gambarProdukLama" value="<?= $produk['gambar']; ?>">

                <div class="row mb-3">
                    <label for="id_kategoriFK" class="col-sm-2 col-form-label">Kategori Produk</label>
                    <div class="col-sm-10">
                        <select class="form-select <?= ($validation->hasError('id_kategoriFK')) ? 'is-invalid' : ''; ?>"
                            name="id_kategoriFK" id="id_kategoriFK" aria-label="Default select example"
                            value="<?= (old('id_kategoriFK')) ? old('id_kategoriFK') : $produk['id_kategoriFK'] ?>">
                            <?php foreach ($listKategori as $lk) {
                                echo '<option value="' . $lk['id_kategori'] . '" ' . ($produk['id_kategoriFK'] == $lk['id_kategori'] ? 'selected' : '') . '>' . $lk['nama_kategori'] . '</option>';
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
                        <input type="text"
                            class="form-control <?= ($validation->hasError('nama_produk')) ? 'is-invalid' : ''; ?>"
                            id="nama_produk" name="nama_produk" autofocus
                            value="<?= (old('nama_produk')) ? old('nama_produk') : $produk['nama_produk'] ?>">
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
                    <label for="modal_produk" class="col-sm-2 col-form-label">Modal (Rupiah)</label>
                    <div class="col-sm-10">
                        <input type="text"
                            class="form-control <?= ($validation->hasError('modal_produk')) ? 'is-invalid' : ''; ?>"
                            id="modal_produk" name="modal_produk"
                            value="<?= (old('modal_produk')) ? old('modal_produk') :  $produk['modal_produk'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('modal_produk'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="harga_produk" class="col-sm-2 col-form-label">Harga (Rupiah)</label>
                    <div class="col-sm-10">
                        <input type="text"
                            class="form-control <?= ($validation->hasError('harga_produk')) ? 'is-invalid' : ''; ?>"
                            id="harga_produk" name="harga_produk"
                            value="<?= (old('harga_produk')) ? old('harga_produk') : $produk['harga_produk'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('harga_produk'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                        <input type="text"
                            class="form-control <?= ($validation->hasError('stok')) ? 'is-invalid' : ''; ?>" id="stok"
                            name="stok" value="<?= (old('stok')) ? old('stok') : $produk['stok'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('stok'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="gambarProduk" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <div class="mb-3">
                            <label for="gambarProduk" class="form-label"><?= $produk['gambar']; ?></label>
                            <input
                                class="form-control <?= ($validation->hasError('gambarProduk')) ? 'is-invalid' : ''; ?>"
                                type="file" id="gambarProduk" name="gambarProduk" onchange="previewImgProduk()">
                            <br>
                            <div class="invalid-feedback">
                                <?= $validation->getError('gambarProduk'); ?>
                            </div>
                            <div class="col-sm-2">
                                <img src="/img/produk/<?= $produk['gambar']; ?>" class="img-thumbnail img-preview">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <input type="text"
                            class="form-control <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : ''; ?>"
                            id="deskripsi" name="deskripsi"
                            value="<?= (old('deskripsi')) ? old('deskripsi') : $produk['deskripsi'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('deskripsi'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="size" class="col-sm-2 col-form-label">Size</label>
                    <div class="col-sm-10">
                        <input type="text"
                            class="form-control <?= ($validation->hasError('size')) ? 'is-invalid' : ''; ?>" id="size"
                            name="size" value="<?= (old('size')) ? old('size') : $produk['size'] ?>">
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