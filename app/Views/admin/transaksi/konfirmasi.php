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
        <div class="col-8">
            <h3 class="my-3">Konfirmasi</h3>
            <!--menambahkan action berisi method update untuk memproses edit-->
            <form action="/admin/transaksi/konfirmasi/update" method="post" enctype="multipart/form-data">
                <!--fitur agar tidak ada pemalsuan, hanya bisa digunakan dihalaman ini saja-->
                <?= csrf_field(); ?>
                <!--menambahkan input slug bertype hidden-->
                <input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi']; ?>">
                <input type="hidden" name="id_userFK" value="<?= $transaksi['id_userFK']; ?>">

                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" value="<?= $transaksi['nama'] ?>" class="form-control" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="telp" class="col-sm-2 col-form-label">Telp</label>
                    <div class="col-sm-10">
                        <input type="text" name="telp" value="<?= $transaksi['telp'] ?>" class="form-control" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" name="alamat" value="<?= $transaksi['alamat'] ?>" class="form-control" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ongkir" class="col-sm-2 col-form-label">Ongkir</label>
                    <div class="col-sm-10">
                        <input type="text" name="ongkir" value="<?= $transaksi['ongkir'] ?>" class="form-control" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="total_tagihan" class="col-sm-2 col-form-label">Total Tagihan</label>
                    <div class="col-sm-10">
                        <input type="text" name="total_tagihan" value="<?= $transaksi['total_tagihan'] ?>" class="form-control" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="bukti" class="col-sm-2 col-form-label">Bukti</label>
                    <div class="col-sm-10">
                        <img src="/img/konfirmasi/<?= $transaksi['bukti_konfirmasi']; ?>" width="700">
                    </div>
                </div>
                <!-- <div class="row mb-3">
                    <label for="validasi" class="col-sm-2 col-form-label">Validasi</label>
                    <div class="col-sm-10">
                        <select class="form-select <?= ($validation->hasError('validasi')) ? 'is-invalid' : ''; ?>" name="validasi" id="validasi" aria-label="Default select example" value="<?= (old('validasi')) ? old('validasi') : $transaksi['validasi'] ?>">
                            <option value="VALID" selected>VALID</option>
                            <option value="TIDAK VALID">TIDAK VALID</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('validasi'); ?>
                        </div>
                    </div>
                </div> -->
                <?php if (!$transaksi['validasi'] == '') : ?>
                    <div class="row mb-3">
                        <label for="validasi" class="col-sm-2 col-form-label">Validasi</label>
                        <div class="col-sm-10">
                            <input type="text" name="validasi" value="<?= $transaksi['validasi'] ?>" class="form-control" readonly>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="row mb-3">
                        <label for="validasi" class="col-sm-2 col-form-label">Validasi</label>
                        <div class="col-sm-10">
                            <select class="form-select <?= ($validation->hasError('validasi')) ? 'is-invalid' : ''; ?>" name="validasi" id="validasi" aria-label="Default select example" value="<?= (old('validasi')) ? old('validasi') : $transaksi['validasi'] ?>">
                                <option value="VALID" selected>VALID</option>
                                <option value="TIDAK VALID">TIDAK VALID</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('validasi'); ?>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
                <a href="/admin/transaksi" class="btn btn-dark">Kembali</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div> <br>


</body>

</html>

<?= $this->endSection(); ?>