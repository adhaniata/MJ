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
                        <div class="card-header text-bg-dark">Pendapatan</div>
                        <div class="card-body text-bg-light">
                            <center>
                                <div class="chart-container" style="position: relative; height:50vh; width:75vw">
                                    <canvas id="pendapatanChart"></canvas>
                                </div>
                            </center>
                        </div>
                    </div><br>
                    <!-- card Total Kategori dan Produk-->
                    <!-- <div class="card mb-3" style="max-width: 1300px;">
                        <div class="card-header text-bg-primary">Kategori dan Produk</div>
                        <div class="card-body text-bg-light">
                            <center>
                                <div class="chart-container" style="position: relative; height:50vh; width:75vw">
                                    <canvas id="produkChart"></canvas>
                                </div>
                            </center>
                        </div>
                    </div><br> -->
                    <!-- card stok Produk-->
                    <div class="card mb-3" style="max-width: 1300px;">
                        <div class="card-header text-bg-primary">Stok Produk</div>
                        <div class="card-body text-bg-light">
                            <center>
                                <div class="chart-container" style="position: relative; height:50vh; width:75vw">
                                    <canvas id="stokproduksChart"></canvas>
                                </div>
                            </center>
                        </div>
                    </div><br>
                    <!-- card Total Transaksi-->
                    <div class="card mb-3" style="max-width: 1300px;">
                        <div class="card-header text-bg-success">Transaksi</div>
                        <div class="card-body text-bg-light">
                            <center>
                                <div class="chart-container" style="position: relative; height:50vh; width:75vw">
                                    <canvas id="transaksiChart"></canvas>
                                </div>
                            </center>
                        </div>
                    </div><br>
                    <!-- card Total Transaksi-->
                    <div class="card mb-3" style="max-width: 1300px;">
                        <div class="card-header text-bg-danger">Pengembalian</div>
                        <div class="card-body text-bg-light">
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
    <?php
    foreach ($kategori as $key => $value) {
        $db = \Config\Database::connect();
        $data_produk_kategori[] = $db->table('produk')
            ->where('id_kategoriFK', $value['id_kategori'])
            ->countAllResults();
        $label_produk_kategori[] = $value['nama_kategori'];
    }
    ?>
    const ctx = document.getElementById('produkChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($label_produk_kategori); ?>,
            datasets: [{
                label: 'Jumlah Produk',
                data: <?= json_encode($data_produk_kategori); ?>,
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
    // untuk Chart
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
</script>
<script>
    // untuk Pendapatan
    const pdt = document.getElementById('pendapatanChart');

    new Chart(pdt, {
        type: 'bar',
        data: {
            labels: <?= json_encode($namaBulan) ?>,
            datasets: [{
                label: 'Jumlah Pendapatan',
                data: <?= json_encode($pendapatan) ?>,
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
            }, {
                label: 'Jumlah Pendapatan',
                data: <?= json_encode($pendapatan) ?>,
                type: 'line',
                backgroundColor: [
                    'rgb(58, 86, 190)'
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
        type: 'bar',
        data: {
            labels: <?= json_encode($namaBulan); ?>,
            datasets: [{
                label: 'Jumlah Pengembalian',
                data: <?= json_encode($pengembalian_chart) ?>,
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
</script>
<script>
    const trx = document.getElementById('transaksiChart');

    new Chart(trx, {
        type: 'line',
        data: {
            labels: <?= json_encode($namaBulan); ?>,
            datasets: [{
                label: 'Jumlah Transaksi',
                data: <?= json_encode($transaksi_chart) ?>,
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
</script>

</body>

</html>

<?= $this->endSection(); ?>