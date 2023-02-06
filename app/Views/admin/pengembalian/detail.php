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
<div class="container mt-2">
    <div class="row">
        <div class="col">
            <div class="card">
                <h5 class="card-header text-bg-dark">Form Permintaan Pengembalian Barang</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label" for="rincian"><b>Detail Pengembalian Barang dan Dana</b></label>
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
                                        <td><?= $pengembalian['ongkir'] ?></td>
                                    </tr>
                                    <tr class="table-info">
                                        <th scope="row" colspan="5">Total Pengembalian Dana</th>
                                        <td><?= $pengembalian['ongkir'] + $subtotal ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <form action="/admin/pengembalian/update/<?= $pengembalian['id_pengembalian']; ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="col-12">
                                <input type="hidden" id="id_transaksiFK" name="id_transaksiFK" class="form-control" value="<?= $pengembalian['id_transaksiFK'] ?>" />
                                <label class="form-label" for="alasan">Alasan</label>
                                <textarea id="alasan" name="alasan" placeholder="Jelaskan Alasan Pengembalian" class="form-control" readonly><?= $pengembalian['alasan'] ?></textarea><br>
                                <label class="form-label" for="telp">Gambar</label><br>
                                <img src="/img/pengembalian/<?= $pengembalian['gambar'] ?>" width="900"><br><br>
                                <label class="form-label" for="validasi">Validasi</label>
                                <select class="form-select" aria-label="Default select example" id="validasi" name="validasi">
                                    <option selected>Menunggu Validasi</option>
                                    <option value="Valid">Valid</option>
                                    <option value="Tidak Valid">Tidak Valid</option>
                                </select><br>
                                <label class="form-label" for="resi_pengembalian">Status Saat Ini</label>
                                <input type="text" id="status1" name="status1" class="form-control" value="<?= $pengembalian['status'] ?>" readonly /><br>
                                <label class="form-label" for="validasi">Update Status (Isi Ketika Barang Retur Sudah Sampai)</label>
                                <select class="form-select" aria-label="Default select example" id="status" name="status">
                                    <option selected>Pilih Jika Barang Sudah Sampai, Lewati Jika Tidak</option>
                                    <!-- <option value="Pengiriman Produk Retur">Pengiriman Produk Retur</option> -->
                                    <option value="Pengembalian Dana Selesai">Pengembalian Dana Selesai</option>
                                </select><br>
                                <label class="form-label" for="">Alamat Pengembalian</label>
                                <textarea placeholder="Jl. Penyelesaian Tomang IV No.1, North Meruya, Kembangan, West Jakarta City, Jakarta 11620" class="form-control" readonly></textarea><br>
                                <label class="form-label" for="resi_pengembalian">No Resi Pengembalian (Biaya Ditanggung Pembeli)</label>
                                <input type="text" id="resi_pengembalian" name="resi_pengembalian" placeholder="Belum Diisi" class="form-control" value="<?= $pengembalian['resi_pengembalian'] ?>" readonly /><br>
                                <label class="form-label" for="telp">Rekening Pengembalian Dana</label>
                                <input type="text" id="rek_pengembalian" name="rek_pengembalian" placeholder="Belum Diisi" class="form-control" value="<?= $pengembalian['rek_pengembalian'] ?>" readonly /><br>
                            </div>
                            <button class="btn btn-primary" type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <br>
</body>

</html>

<?= $this->endSection(); ?>