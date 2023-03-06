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
<div class="card mt-2">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link" href="/admin/transaksi">Semua</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/admin/transaksi/belum-bayar">Belum Bayar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/transaksi/proses">Proses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/transaksi/selesai">Selesai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/transaksi/batal">Batal</a>
            </li>
        </ul>
    </div>
    <!-- isi card / table transaksi-->
    <div class="card-body">
        <div class="container">
            <div class="row">
                <h2>Transaksi Belum Di Bayar</h2>
                <br>

                <?php if (session()->getFlashdata('pesan')) : ?>
                    <dif class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </dif>
                <?php endif ?>

                <table class="table table-bordered" id="datatable">
                    <?php $i = 1; ?>
                    <thead>
                        <tr class="table-warning">
                            <th scope="col">No</th>
                            <th scope="col">ID Transaksi</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Total Tagihan</th>
                            <th scope="col">Status Pembayaran</th>
                            <th scope="col">Tanggal Pembayaran</th>
                            <th scope="col">Validasi Pembayaran</th>
                            <th scope="col">Tanggal Transaksi</th>
                            <th scope="col">Konfirmasi Pembayaran</th>
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
                                <td><?= $t['tgl_konfirmasi'] ?></td>
                                <td><?= $t['validasi'] ?></td>
                                <td><?= $t['created_at'] ?></td>
                                <td> <a href="/admin/transaksi/konfirmasi/<?= $t['id_transaksi'] ?>" class="btn btn-dark mt-1">Konfirmasi</a></td>
                                <td>
                                    <a href="/admin/transaksi/<?= $t['id_transaksi'] ?>" class="btn btn-info mb-1">Detail</a>
                                    <a href="/admin/transaksi/edit/<?= $t['id_transaksi'] ?>" class="btn btn-warning mt-ml-1">Edit</a>
                                    <form action="/admin/transaksi/delete/<?= $t['id_transaksi']; ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <!--agar lebih aman-->
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger mt-1" onclick="return confirm('Apakah Anda Yakin?');">Delete</button><br>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</body>

</html>

<script>
    $(function() {
        $('#bulan').hide();
        $('#tahun').hide();
        $('#tanggal').hide();

        $('#filter').on('change', function() {
            var filter = $(this).val();

            if (filter != '') {
                if (filter == 'bln') {
                    $('#bulan').show();
                    $('#tanggal').hide();
                    $('#tahun').hide();
                } else if (filter == 'thn') {
                    $('#tahun').show();
                    $('#tanggal').hide();
                    $('#bulan').hide();
                } else {
                    $('#tanggal').show();
                    $('#bulan').hide();
                    $('#tahun').hide();
                }
            } else {
                $('#tanggal').hide();
                $('#bulan').hide();
                $('#tahun').hide();
            }
        })
    })
    $(function() {
        $('#bulan_tp').hide();
        $('#tahun_tp').hide();
        $('#tanggal_tp').hide();

        $('#filter_tp').on('change', function() {
            var filter_tp = $(this).val();

            if (filter_tp != '') {
                if (filter_tp == 'bln_tp') {
                    $('#bulan_tp').show();
                    $('#tanggalTp').hide();
                    $('#tahun_tp').hide();
                } else if (filter_tp == 'thn_tp') {
                    $('#tahun_tp').show();
                    $('#tanggal_tp').hide();
                    $('#bulan_tp').hide();
                } else {
                    $('#tanggal_tp').show();
                    $('#bulan_tp').hide();
                    $('#tahun_tp').hide();
                }
            } else {
                $('#tanggal_tp').hide();
                $('#bulan_tp').hide();
                $('#tahun_tp').hide();
            }
        })
    })
</script>

<?= $this->endSection(); ?>