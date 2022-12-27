<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!--navbar-->
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
                    <a class="nav-link" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/user/keranjang"><i class="fa-solid fa-cart-shopping"></i> Keranjang</a>
                </li>
                <?php if (logged_in() == false) {
                    echo '
                    <li class="nav-item">
                    <a class="nav-link" href="/login"><i class="fa-solid fa-user"></i> Login</a>
                    </li>
                    ';
                } else {
                    echo '
                    <li class="nav-item">
                        <a class="nav-link" href="' . base_url('logout') . '"><i class="fa-solid fa-user"></i> Logout</a>
                    </li>
                    ';
                } ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-store"></i>
                        e-commerce
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="https://www.shopee.co.id/" target="_blank">Shopee</a></li>
                        <li><a class="dropdown-item" href="https://www.tokopedia.coma/" target="_blank">Tokopedia</a></li>
                        <li><a class="dropdown-item" href="https://www.lazada.co.id/" target="_blank">Lazada</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa-solid fa-robot"></i> Chatbot</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ongkir/"><i class="fa-solid fa-robot"></i> Biaya Kirim</a>
                </li>
                <?php if (in_groups('admin')) {
                    echo '
                    <li class="nav-item">
                        <a class="nav-link" href="/admin"><i class="fa-solid fa-lock"></i></i> Admin</a>
                    </li>
                    ';
                } ?>
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
        <div class="col">
            <h2 class="mt-3">Keranjang</h2>
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
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $subtotal = 0; ?>
                    <?php foreach ($keranjang as $key => $value) : ?>
                        <?php $subtotal += $value['subtotal_harga']; ?>
                        <tr class="table-light">
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $value['nama_produk']; ?></td>
                            <td><img src="/img/produk/<?= $value['gambar']; ?>" width="100"> </td>
                            <td><?= $value['harga_produk']; ?></td>
                            <td><input type="number" id="qty" name="qty" value="1" min="1" max="<?= $value['stok']; ?>"></td>
                            <td><?= $value['harga_produk'] * $value['qty']; ?></td>
                            <td><a href="/user/keranjang/" class="btn btn-danger">Hapus</a></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="table-info">
                        <th scope="row">Total Harga</th>
                        <td colspan="5"><?= $subtotal ?></td>
                        <td><a href="/user/keranjang/" class="btn btn-warning">Checkout</a></td>
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