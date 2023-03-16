<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!--navbar-->
<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="/img/Artboard 1.png" alt="Bootstrap" width="40" height="34">MJ
            Sport</a>
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
<!-- summary -->
<div class="container mt-4">
    <div class="row">
        <div class="col">
            <h2>Dashboard</h2>
            <div class="card text-bg-light mb-3" style="max-width: 1300px;">
                <!-- <div class="card-header text-bg-dark">
                    <h4>Summary</h4>
                </div> -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <!-- card Total Produk-->
                            <div class="card text-bg-secondary mb-3" style="max-width: 20rem;">
                                <div class="card-body">
                                    <h4 class="card-title"><?= $countKategori; ?></h4>
                                    <h5 class="card-title">Kategori</h5>
                                </div>
                                <div class="card-footer">
                                    <a class="btn btn-outline-light" href=" /admin/kategori">More Info <i class="fa-solid fa-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <!-- card Total Transaksi-->
                            <div class="card text-bg-primary mb-3" style="max-width: 20rem;">
                                <div class="card-body">
                                    <h4 class="card-title"><?= $countProduk; ?></h4>
                                    <h5 class="card-title">Produk</h5>
                                </div>
                                <div class="card-footer">
                                    <a class="btn btn-outline-light" href=" /admin/produk">More Info <i class="fa-solid fa-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <!-- card Total Transaksi-->
                            <div class="card text-bg-success mb-3" style="max-width: 20rem;">
                                <div class="card-body">
                                    <h4 class="card-title"><?= $countTransaksi; ?></h4>
                                    <h5 class="card-title">Transaksi</h5>
                                </div>
                                <div class="card-footer">
                                    <a class="btn btn-outline-light" href=" /admin/transaksi">More Info <i class="fa-solid fa-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <!-- card Total Transaksi-->
                            <div class="card text-bg-danger mb-3" style="max-width: 20rem;">
                                <div class="card-body">
                                    <h4 class="card-title"><?= $countPengembalian; ?></h4>
                                    <h5 class="card-title">Pengembalian</h5>
                                </div>
                                <div class="card-footer">
                                    <a class="btn btn-outline-light" href=" /admin/pengembalian">More Info <i class="fa-solid fa-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <!-- card Total Transaksi-->
                            <div class="card text-bg-warning mb-3" style="max-width: 20rem;">
                                <div class="card-body">
                                    <h4 class="card-title"><?= $countOngkir; ?></h4>
                                    <h5 class="card-title">Daftar Ongkir</h5>
                                </div>
                                <div class="card-footer">
                                    <a class="btn btn-outline-dark" href=" /admin/ongkir">More Info <i class="fa-solid fa-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- chart -->
<div class="container mt-4">
    <div class="row">
        <div class="col">
            <div class="card text-bg-light mb-3" style="max-width: 1300px;">
                <!-- <div class="card-header text-bg-dark">
                    <h4>Chart</h4>
                </div> -->
                <div class="card-body">
                    <!-- card Total Produk-->
                    <!-- <div class="card mb-3" style="max-width: 1300px;">
                        <div class="card-header text-bg-secondary">Kategori</div>
                        <div class="card-body text-bg-light">

                        </div>
                    </div><br> -->
                    <!-- card Total Pendapatan-->
                    <div class="card mb-3" style="max-width: 1300px;">
                        <div class="card-header text-bg-dark">
                            <h5>Pendapatan dan Pengeluaran</h5>
                            <br>
                            <form action="/admin" method="GET">
                                <input type="hidden" name="type" value="pendapatan">
                                <div class="form-group row mb-2">
                                    <label for="" class="col-md-1">Filter</label>
                                    <div class="col-md-4">
                                        <select name="filter" id="filter_pendapatan" class="form-control">
                                            <option value="tanggal">Tanggal</option>
                                            <option value="bulan">Bulan</option>
                                            <option value="tahun">Tahun</option>
                                            <option value="periode_tanggal">Periode Tanggal</option>
                                            <option value="periode_bulan">Periode Bulan</option>
                                            <option value="periode_tahun">Periode Tahun</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="tanggal_pendapatan">
                                    <label for="" class="col-md-1">Tanggal</label>
                                    <div class="col-md-4">
                                        <input type="date" class="form-control" name="tanggal" id="tanggal">
                                    </div>
                                </div>
                                <div class=" form-group row mb-2" id="bulan_pendapatan">
                                    <label for="" class="col-md-1">Bulan</label>
                                    <div class="col-md-4">
                                        <input type="month" class="form-control" name="bulan">
                                    </div>
                                </div>
                                <div class="form-group  row mb-2" id="tahun_pendapatan">
                                    <label for="" class="col-md-1">Tahun</label>
                                    <div class="col-md-4">
                                        <input type="year" class="form-control date-own" name="tahun" value="<?= date('Y') ?>">
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="tanggal_pendapatan_periode1">
                                    <label for="" class="col-md-1">Tanggal Awal</label>
                                    <div class="col-md-4">
                                        <input type="date" class="form-control" name="tanggal_periode1">
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="tanggal_pendapatan_periode2">
                                    <label for="" class="col-md-1">Tanggal Akhir</label>
                                    <div class="col-md-4">
                                        <input type="date" class="form-control" name="tanggal_periode2">
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="bulan_pendapatan_periode1">
                                    <label for="" class="col-md-1">Bulan Awal</label>
                                    <div class="col-md-4">
                                        <input type="month" class="form-control" name="bulan_periode1">
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="bulan_pendapatan_periode2">
                                    <label for="" class="col-md-1">Bulan Akhir</label>
                                    <div class="col-md-4">
                                        <input type="month" class="form-control" name="bulan_periode2">
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="tahun_pendapatan_periode1">
                                    <label for="" class="col-md-1">Tahun Awal</label>
                                    <div class="col-md-4">
                                        <input type="year" class="form-control date-own" name="tahun_periode1">
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="tahun_pendapatan_periode2">
                                    <label for="" class="col-md-1">Tahun Akhir</label>
                                    <div class="col-md-4">
                                        <input type="year" class="form-control date-own" name="tahun_periode2">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <div class="col-md-1">
                                        <button type="submit" id="btnPendapatan" name="btnPendapatan" class="btn btn-primary btn-sm">Proses</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body text-bg-light">
                            <b class="keteranganPendapatan" id="keteranganPendapatan" name="keteranganPendapatan">
                                <?= $judulPendapatan; ?>
                            </b>
                            <center>
                                <div class="chart-container" style="position: relative; height:50vh; width:75vw">
                                    <canvas id="pendapatanChart"></canvas>
                                </div>
                            </center>
                        </div>
                    </div><br>
                    <!-- card Total Kategori dan Produk-->
                    <div class="card mb-3" style="max-width: 1300px;">
                        <div class="card-header text-bg-primary">
                            <h5>Kategori dan Stok Produk</h5>
                            <div class="form-group row">
                                <div class="col">
                                    <button type="submit" id="stokkategori" class="btn btn-dark btn-sm">Stok Per Kategori</button>
                                    <button type="submit" id="stokbrg" class="btn btn-dark btn-sm">Stok Produk</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-bg-light">
                            <center>
                                <div class="chart-container" style="position: relative; height:50vh; width:75vw">
                                    <canvas id="stokkategoriChart"></canvas>
                                    <canvas id="stokproduksChart"></canvas>
                                </div>
                            </center>
                        </div>
                    </div><br>
                    <!-- card Total Transaksi-->
                    <div class="card mb-3" style="max-width: 1300px;">
                        <div class="card-header text-bg-success">
                            <h5>Transaksi</h5>
                            <br>
                            <form action="/admin" method="GET">
                                <input type="hidden" name="type" value="transaksi">
                                <div class="form-group row mb-2">
                                    <label for="" class="col-md-1">Filter</label>
                                    <div class="col-md-4">
                                        <select name="filter" id="filter_transaksi" class="form-control">
                                            <option value="tanggal">Tanggal</option>
                                            <option value="bulan">Bulan</option>
                                            <option value="tahun">Tahun</option>
                                            <option value="periode_tanggal">Periode Tanggal</option>
                                            <option value="periode_bulan">Periode Bulan</option>
                                            <option value="periode_tahun">Periode Tahun</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="tanggal_transaksi">
                                    <label for="" class="col-md-1">Tanggal</label>
                                    <div class="col-md-4">
                                        <input type="date" class="form-control" name="tanggal">
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="bulan_transaksi">
                                    <label for="" class="col-md-1">Bulan</label>
                                    <div class="col-md-4">
                                        <input type="month" class="form-control" name="bulan">
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="tahun_transaksi">
                                    <label for="" class="col-md-1">Tahun</label>
                                    <div class="col-md-4">
                                        <input type="years" class="form-control date-own" name="tahun" value="<?= date('Y') ?>">
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="tanggal_transaksi_periode1">
                                    <label for="" class="col-md-1">Tanggal Awal</label>
                                    <div class="col-md-4">
                                        <input type="date" class="form-control" name="tanggal_periode1">
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="tanggal_transaksi_periode2">
                                    <label for="" class="col-md-1">Tanggal Akhir</label>
                                    <div class="col-md-4">
                                        <input type="date" class="form-control" name="tanggal_periode2">
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="bulan_transaksi_periode1">
                                    <label for="" class="col-md-1">Bulan Awal</label>
                                    <div class="col-md-4">
                                        <input type="month" class="form-control" name="bulan_periode1">
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="bulan_transaksi_periode2">
                                    <label for="" class="col-md-1">Bulan Akhir</label>
                                    <div class="col-md-4">
                                        <input type="month" class="form-control" name="bulan_periode2">
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="tahun_transaksi_periode1">
                                    <label for="" class="col-md-1">Tahun Awal</label>
                                    <div class="col-md-4">
                                        <input type="year" class="form-control date-own" name="tahun_periode1">
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="tahun_transaksi_periode2">
                                    <label for="" class="col-md-1">Tahun Akhir</label>
                                    <div class="col-md-4">
                                        <input type="year" class="form-control date-own" name="tahun_periode2">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <div class="col-md-1">
                                        <button type="submit" class="btn btn-primary btn-sm">Proses</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body text-bg-light">
                            <b class="keteranganPendapatan" id="keteranganPendapatan" name="keteranganPendapatan">
                                <?= $judulTransaksi; ?>
                            </b>
                            <center>
                                <div class="chart-container" style="position: relative; height:50vh; width:75vw">
                                    <canvas id="transaksiChart"></canvas>
                                </div>
                            </center>
                        </div>
                    </div><br>
                    <!-- card Total Pengembalian-->
                    <div class="card mb-3" style="max-width: 1300px;">
                        <div class="card-header text-bg-danger">
                            <h5>Pengembalian</h5>
                            <br>
                            <form action="/admin" method="GET">
                                <input type="hidden" name="type" value="pengembalian">
                                <div class="form-group row mb-2">
                                    <label for="" class="col-md-1">Filter</label>
                                    <div class="col-md-4">
                                        <select name="filter" id="filter_pengembalian" class="form-control">
                                            <option value="tanggal">Tanggal</option>
                                            <option value="bulan">Bulan</option>
                                            <option value="tahun">Tahun</option>
                                            <option value="periode_tanggal">Periode Tanggal</option>
                                            <option value="periode_bulan">Periode Bulan</option>
                                            <option value="periode_tahun">Periode Tahun</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="tanggal_pengembalian">
                                    <label for="" class="col-md-1">Tanggal</label>
                                    <div class="col-md-4">
                                        <input type="date" class="form-control" name="tanggal">
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="bulan_pengembalian">
                                    <label for="" class="col-md-1">Bulan</label>
                                    <div class="col-md-4">
                                        <input type="month" class="form-control" name="bulan">
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="tahun_pengembalian">
                                    <label for="" class="col-md-1">Tahun</label>
                                    <div class="col-md-4">
                                        <input type="years" class="form-control date-own" name="tahun" value="<?= date('Y') ?>">
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="tanggal_pengembalian_periode1">
                                    <label for="" class="col-md-1">Tanggal Awal</label>
                                    <div class="col-md-4">
                                        <input type="date" class="form-control" name="tanggal_periode1">
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="tanggal_pengembalian_periode2">
                                    <label for="" class="col-md-1">Tanggal Akhir</label>
                                    <div class="col-md-4">
                                        <input type="date" class="form-control" name="tanggal_periode2">
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="bulan_pengembalian_periode1">
                                    <label for="" class="col-md-1">Bulan Awal</label>
                                    <div class="col-md-4">
                                        <input type="month" class="form-control" name="bulan_periode1">
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="bulan_pengembalian_periode2">
                                    <label for="" class="col-md-1">Bulan Akhir</label>
                                    <div class="col-md-4">
                                        <input type="month" class="form-control" name="bulan_periode2">
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="tahun_pengembalian_periode1">
                                    <label for="" class="col-md-1">Tahun Awal</label>
                                    <div class="col-md-4">
                                        <input type="year" class="form-control date-own" name="tahun_periode1">
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="tahun_pengembalian_periode2">
                                    <label for="" class="col-md-1">Tahun Akhir</label>
                                    <div class="col-md-4">
                                        <input type="year" class="form-control date-own" name="tahun_periode2">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <div class="col-md-1">
                                        <button type="submit" class="btn btn-primary btn-sm">Proses</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body text-bg-light">
                            <b class="keteranganPendapatan" id="keteranganPendapatan" name="keteranganPendapatan">
                                <?= $judulPengembalian; ?>
                            </b>
                            <center>
                                <div class="chart-container" style="position: relative; height:50vh; width:75vw">
                                    <canvas id="pengembalianChart"></canvas>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<br><br>
<br><br><br><br><br>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.0/chart.min.js" integrity="sha512-qKyIokLnyh6oSnWsc5h21uwMAQtljqMZZT17CIMXuCQNIfFSFF4tJdMOaJHL9fQdJUANid6OB6DRR0zdHrbWAw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- <script>
    // untuk Chart
    
    const ctx = document.getElementById('produkChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: '',
            datasets: [{
                label: 'Jumlah Produk',
                data: '',
                borderWidth: 1,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ]
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script> -->
<script>
    $(document).ready(function() {
        $("#stokkategoriChart").show();
        $("#stokproduksChart").hide();
        $("#stokkategori").click(function() {
            $("#stokkategoriChart").show();
            $("#stokproduksChart").hide();
        });
        $("#stokbrg").click(function() {
            $("#stokproduksChart").show();
            $("#stokkategoriChart").hide();
        });
    });
</script>
<script>
    // untuk semua stok barang per kategori
    const ctx = document.getElementById('stokkategoriChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($namaKategori) ?>,
            datasets: [{
                label: 'Jumlah Stok Produk Perkategori',
                data: <?= json_encode($stok_chart) ?>,
                borderWidth: 1,
                backgroundColor: [
                    'rgba(255, 205, 86, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 205, 86)'
                ]
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script>
    // untuk Chart stok produk
    <?php
    foreach ($produks as $key => $value) {
        $db = \Config\Database::connect();
        $stok_produks[] = $value['stok'];
        $label_produks[] = $value['nama_produk'];
    }
    ?>

    const spd = document.getElementById('stokproduksChart');
    new Chart(spd, {
        type: 'bar',
        data: {
            labels: <?= json_encode($label_produks); ?>,
            datasets: [{
                label: 'Jumlah Produk',
                data: <?= json_encode($stok_produks); ?>,
                borderWidth: 1,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgb(54, 162, 235)'
                ]
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script>
    // untuk Pendapatan
    const pdt = document.getElementById('pendapatanChart');

    new Chart(pdt, {
        type: 'bar',
        data: {
            labels: <?= json_encode($namaBulanPendapatan) ?>,
            datasets: [{
                label: 'Jumlah Pendapatan',
                data: <?= json_encode($pendapatan) ?>,
                borderWidth: 1,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgb(75, 192, 192)'
                ]
            }, {
                label: 'Jumlah Pengeluran',
                data: <?= json_encode($pengeluaran) ?>,
                borderWidth: 1,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                ]
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script>
    // untuk Pengembalian
    const pbl = document.getElementById('pengembalianChart');

    new Chart(pbl, {
        type: 'line',
        data: {
            labels: <?= json_encode($namaBulanPengembalian); ?>,
            datasets: [{
                label: 'Jumlah Pengembalian',
                data: <?= json_encode($pengembalian_chart) ?>,
                borderWidth: 1,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)'
                ]
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script>
    const trx = document.getElementById('transaksiChart');

    new Chart(trx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($namaBulanTransaksi); ?>,
            datasets: [{
                label: 'Jumlah Transaksi',
                data: <?= json_encode($transaksi_chart) ?>,
                borderWidth: 1,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgb(54, 162, 235)'
                ]
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
    $(document).ready(function() {
        $(".date-own").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true
        });

        $('#bulan_pendapatan').hide();
        $('#tahun_pendapatan').hide();
        $('#bulan_transaksi').hide();
        $('#tahun_transaksi').hide();
        $('#bulan_pengembalian').hide();
        $('#tahun_pengembalian').hide();
        // periode pendapatan hide
        $('#tanggal_pendapatan_periode1').hide();
        $('#tanggal_pendapatan_periode2').hide();
        $('#bulan_pendapatan_periode1').hide();
        $('#bulan_pendapatan_periode2').hide();
        $('#tahun_pendapatan_periode1').hide();
        $('#tahun_pendapatan_periode2').hide();
        // periode transaksi hide
        $('#tanggal_transaksi_periode1').hide();
        $('#tanggal_transaksi_periode2').hide();
        $('#bulan_transaksi_periode1').hide();
        $('#bulan_transaksi_periode2').hide();
        $('#tahun_transaksi_periode1').hide();
        $('#tahun_transaksi_periode2').hide();
        // periode pengembalian hide
        $('#tanggal_pengembalian_periode1').hide();
        $('#tanggal_pengembalian_periode2').hide();
        $('#bulan_pengembalian_periode1').hide();
        $('#bulan_pengembalian_periode2').hide();
        $('#tahun_pengembalian_periode1').hide();
        $('#tahun_pengembalian_periode2').hide();

        $('#filter_pendapatan').on('change', function() {
            var filter = $(this).val();

            if (filter == 'tanggal') {
                $('#tanggal_pendapatan').show();
                $('#bulan_pendapatan').hide();
                $('#tahun_pendapatan').hide();
                $('#tanggal_pendapatan_periode1').hide();
                $('#tanggal_pendapatan_periode2').hide();
                $('#bulan_pendapatan_periode1').hide();
                $('#bulan_pendapatan_periode2').hide();
                $('#tahun_pendapatan_periode1').hide();
                $('#tahun_pendapatan_periode2').hide();
            } else if (filter == 'bulan') {
                $('#tanggal_pendapatan').hide();
                $('#bulan_pendapatan').show();
                $('#tahun_pendapatan').hide();
                $('#tanggal_pendapatan_periode1').hide();
                $('#tanggal_pendapatan_periode2').hide();
                $('#bulan_pendapatan_periode1').hide();
                $('#bulan_pendapatan_periode2').hide();
                $('#tahun_pendapatan_periode1').hide();
                $('#tahun_pendapatan_periode2').hide();
            } else if (filter == 'periode_tanggal') {
                $('#tanggal_pendapatan').hide();
                $('#bulan_pendapatan').hide();
                $('#tahun_pendapatan').hide();
                $('#tanggal_pendapatan_periode1').show();
                $('#tanggal_pendapatan_periode2').show();
                $('#bulan_pendapatan_periode1').hide();
                $('#bulan_pendapatan_periode2').hide();
                $('#tahun_pendapatan_periode1').hide();
                $('#tahun_pendapatan_periode2').hide();
            } else if (filter == 'periode_bulan') {
                $('#tanggal_pendapatan').hide();
                $('#bulan_pendapatan').hide();
                $('#tahun_pendapatan').hide();
                $('#tanggal_pendapatan_periode1').hide();
                $('#tanggal_pendapatan_periode2').hide();
                $('#bulan_pendapatan_periode1').show();
                $('#bulan_pendapatan_periode2').show();
                $('#tahun_pendapatan_periode1').hide();
                $('#tahun_pendapatan_periode2').hide();
            } else if (filter == 'periode_tahun') {
                $('#tanggal_pendapatan').hide();
                $('#bulan_pendapatan').hide();
                $('#tahun_pendapatan').hide();
                $('#tanggal_pendapatan_periode1').hide();
                $('#tanggal_pendapatan_periode2').hide();
                $('#bulan_pendapatan_periode1').hide();
                $('#bulan_pendapatan_periode2').hide();
                $('#tahun_pendapatan_periode1').show();
                $('#tahun_pendapatan_periode2').show();
            } else {
                $('#tanggal_pendapatan').hide();
                $('#bulan_pendapatan').hide();
                $('#tahun_pendapatan').show();
                $('#tanggal_pendapatan_periode1').hide();
                $('#tanggal_pendapatan_periode2').hide();
            }
        });

        $('#filter_transaksi').on('change', function() {
            var filter = $(this).val();

            if (filter == 'tanggal') {
                $('#tanggal_transaksi').show();
                $('#bulan_transaksi').hide();
                $('#tahun_transaksi').hide();
                $('#tanggal_transaksi_periode1').hide();
                $('#tanggal_transaksi_periode2').hide();
                $('#bulan_transaksi_periode1').hide();
                $('#bulan_transaksi_periode2').hide();
                $('#tahun_transaksi_periode1').hide();
                $('#tahun_transaksi_periode2').hide();
            } else if (filter == 'bulan') {
                $('#tanggal_transaksi').hide();
                $('#bulan_transaksi').show();
                $('#tahun_transaksi').hide();
                $('#tanggal_transaksi_periode1').hide();
                $('#tanggal_transaksi_periode2').hide();
                $('#bulan_transaksi_periode1').hide();
                $('#bulan_transaksi_periode2').hide();
                $('#tahun_transaksi_periode1').hide();
                $('#tahun_transaksi_periode2').hide();
            } else if (filter == 'periode_tanggal') {
                $('#tanggal_transaksi').hide();
                $('#bulan_transaksi').hide();
                $('#tahun_transaksi').hide();
                $('#tanggal_transaksi_periode1').show();
                $('#tanggal_transaksi_periode2').show();
                $('#bulan_transaksi_periode1').hide();
                $('#bulan_transaksi_periode2').hide();
                $('#tahun_transaksi_periode1').hide();
                $('#tahun_transaksi_periode2').hide();
            } else if (filter == 'periode_bulan') {
                $('#tanggal_transaksi').hide();
                $('#bulan_transaksi').hide();
                $('#tahun_transaksi').hide();
                $('#tanggal_transaksi_periode1').hide();
                $('#tanggal_transaksi_periode2').hide();
                $('#bulan_transaksi_periode1').show();
                $('#bulan_transaksi_periode2').show();
                $('#tahun_transaksi_periode1').hide();
                $('#tahun_transaksi_periode2').hide();
            } else if (filter == 'periode_tahun') {
                $('#tanggal_transaksi').hide();
                $('#bulan_transaksi').hide();
                $('#tahun_transaksi').hide();
                $('#tanggal_transaksi_periode1').hide();
                $('#tanggal_transaksi_periode2').hide();
                $('#bulan_transaksi_periode1').hide();
                $('#bulan_transaksi_periode2').hide();
                $('#tahun_transaksi_periode1').show();
                $('#tahun_transaksi_periode2').show();
            } else {
                $('#tanggal_transaksi').hide();
                $('#bulan_transaksi').hide();
                $('#tahun_transaksi').show();
                $('#tanggal_transaksi_periode1').hide();
                $('#tanggal_transaksi_periode2').hide();
                $('#bulan_transaksi_periode1').hide();
                $('#bulan_transaksi_periode2').hide();
                $('#tahun_transaksi_periode1').hide();
                $('#tahun_transaksi_periode2').hide();
            }
        });

        $('#filter_pengembalian').on('change', function() {
            var filter = $(this).val();

            if (filter == 'tanggal') {
                $('#tanggal_pengembalian').show();
                $('#bulan_pengembalian').hide();
                $('#tahun_pengembalian').hide();
                $('#tanggal_pengembalian_periode1').hide();
                $('#tanggal_pengembalian_periode2').hide();
                $('#bulan_pengembalian_periode1').hide();
                $('#bulan_pengembalian_periode2').hide();
                $('#tahun_pengembalian_periode1').hide();
                $('#tahun_pengembalian_periode2').hide();
            } else if (filter == 'bulan') {
                $('#tanggal_pengembalian').hide();
                $('#bulan_pengembalian').show();
                $('#tahun_pengembalian').hide();
                $('#tanggal_pengembalian_periode1').hide();
                $('#tanggal_pengembalian_periode2').hide();
                $('#bulan_pengembalian_periode1').hide();
                $('#bulan_pengembalian_periode2').hide();
                $('#tahun_pengembalian_periode1').hide();
                $('#tahun_pengembalian_periode2').hide();
            } else if (filter == 'periode_tanggal') {
                $('#tanggal_pengembalian').hide();
                $('#bulan_pengembalian').hide();
                $('#tahun_pengembalian').hide();
                $('#tanggal_pengembalian_periode1').show();
                $('#tanggal_pengembalian_periode2').show();
                $('#bulan_pengembalian_periode1').hide();
                $('#bulan_pengembalian_periode2').hide();
                $('#tahun_pengembalian_periode1').hide();
                $('#tahun_pengembalian_periode2').hide();
            } else if (filter == 'periode_bulan') {
                $('#tanggal_pengembalian').hide();
                $('#bulan_pengembalian').hide();
                $('#tahun_pengembalian').hide();
                $('#tanggal_pengembalian_periode1').hide();
                $('#tanggal_pengembalian_periode2').hide();
                $('#bulan_pengembalian_periode1').show();
                $('#bulan_pengembalian_periode2').show();
                $('#tahun_pengembalian_periode1').hide();
                $('#tahun_pengembalian_periode2').hide();
            } else if (filter == 'periode_tahun') {
                $('#tanggal_pengembalian').hide();
                $('#bulan_pengembalian').hide();
                $('#tahun_pengembalian').hide();
                $('#tanggal_pengembalian_periode1').hide();
                $('#tanggal_pengembalian_periode2').hide();
                $('#bulan_pengembalian_periode1').hide();
                $('#bulan_pengembalian_periode2').hide();
                $('#tahun_pengembalian_periode1').show();
                $('#tahun_pengembalian_periode2').show();
            } else {
                $('#tanggal_pengembalian').hide();
                $('#bulan_pengembalian').hide();
                $('#tahun_pengembalian').show();
                $('#tanggal_pengembalian_periode1').hide();
                $('#tanggal_pengembalian_periode2').hide();
                $('#bulan_pengembalian_periode1').hide();
                $('#bulan_pengembalian_periode2').hide();
                $('#tahun_pengembalian_periode1').hide();
                $('#tahun_pengembalian_periode2').hide();
            }
        });
    });
</script>
<!-- <script>
    $(document).ready(function() {
        $("#btnPendapatan").click(function() {
            var tanggal = $('input[name="tanggal"]').val();
            var bulan = $('input[name="bulan"]').val();
            var tahun = $('input[name="tahun"]').val();
            var tanggal_periode1 = $('input[name="tanggal_periode1"]').val();
            var tanggal_periode2 = $('input[name="tanggal_periode2"]').val();
            var bulan_periode1 = $('input[name="bulan_periode1"]').val();
            var bulan_periode2 = $('input[name="bulan_periode2"]').val();
            var tahun_periode1 = $('input[name="tahun_periode1"]').val();
            var tahun_periode2 = $('input[name="tahun_periode2"]').val();

            var hasil =

                $("#keteranganPendapatan")
        })
    })
</script> -->

<?= $this->endSection(); ?>