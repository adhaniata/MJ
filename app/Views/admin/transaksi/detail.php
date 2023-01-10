<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

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
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-3">Detail Transaksi</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-md-4 form-label">Nama</label>
                        <div class="col-md-8">
                            <input type="text" name="" value="<?= $transaksi['nama'] ?>" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-2 mb-2">
                    <div class="form-group row">
                        <label class="col-md-4 form-label">Alamat</label>
                        <div class="col-md-8">
                            <textarea class="form-control" readonly><?= $transaksi['alamat'] ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                    <div class="form-group row">
                        <label class="col-md-4 form-label">Telp</label>
                        <div class="col-md-8">
                            <input type="text" name="" value="<?= $transaksi['telp'] ?>" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-2 mb-2">
                    <div class="form-group row">
                        <label class="col-md-4 form-label">No Resi</label>
                        <div class="col-md-8">
                            <input type="text" name="" value="<?= $transaksi['no_resi'] ?>" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-2 mb-2">
                    <div class="form-group row">
                        <label class="col-md-4 form-label">Status Pembayaran</label>
                        <div class="col-md-8">
                            <input type="text" name="" value="<?= $transaksi['status_pembayaran'] ?>" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                    <div class="form-group row">
                        <label class="col-md-4 form-label"></label>
                        <div class="col-md-8">
                            <a href="/admin/transaksi/print/<?= $transaksi['id_transaksi'] ?>" class="btn btn-primary me-md-1" target="_blank"><i class="fa-solid fa-print"></i> Print Detail Transaksi</a>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <?php $i = 1; ?>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Jumlah Harga (Rupiah)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $subtotal = 0; ?>
                    <?php foreach ($transaksi_detail as $td) :
                        $subtotal += $td['subtotal_harga']  ?>
                        <tr>
                            <th><?= $i++ ?></th>
                            <td><?= $td['nama_produk'] ?></td>
                            <td><img src="/img/produk/<?= $td['gambar']; ?>" width="100"> </td>
                            <td><?= $td['total_harga'] ?></td>
                            <td><?= $td['qty'] ?></td>
                            <td><?= $td['subtotal_harga'] ?></td>
                        </tr>
                    <?php endforeach ?>
                    <tr class="table-info">
                        <th scope="row" colspan="5">Total Harga</th>
                        <td><?= $subtotal ?></td>
                    </tr>
                    <tr class="table-info">
                        <th scope="row" colspan="5">Total Ongkir</th>
                        <td><?= $transaksi['ongkir'] ?></td>
                    </tr>
                    <tr class="table-info">
                        <th scope="row" colspan="5">Total Pembayaran</th>
                        <td><?= $transaksi['ongkir'] + $subtotal ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<br><br>
<br><br><br><br><br>
</body>

</html>

<?= $this->endSection(); ?>