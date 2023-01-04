<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!--navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="/img/Artboard 1.png" alt="Bootstrap" width="40" height="34">
            MJ Sport | Form Pembelian</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>


<!-- form data pembelian -->
<section class="vh-100" style="background-color: white;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-15">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-10 p-lg-5 text-black">
                                <form>
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <span class="h1 fw-bold mb-0"> <img src="/img/Artboard 1.png" width="70" height="64">MJ Sport</span>
                                    </div>

                                    <h4 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;"><b>Form Pembelian</b></h4>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="nama">Nama Lengkap</label>
                                        <input type="text" id="nama" name="nama" class="form-control form-control-lg" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="telp">No Telepon Aktif</label>
                                        <input type="text" id="telp" name="telp" class="form-control form-control-lg" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label for="id_ongkirFK" class="col-sm-2 col-form-label">Kota</label>
                                        <div>
                                            <select class="form-select <?= ($validation->hasError('id_ongkirFK')) ? 'is-invalid' : ''; ?>" name="id_ongkirFK" id="id_ongkirFK" aria-label="Default select example">
                                                <!--<option selected>Pilih Kota Untuk Ongkir </option>-->
                                                <?php foreach ($listKota as $lk) {
                                                    echo '<option value="' . $lk['id_ongkir'] . '">' . $lk['kota'] . ' Rp.' . $lk['harga'] . '</option>';
                                                } ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('id_ongkirFK'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="alamat">Alamat Lengkap</label>
                                        <textarea name="alamat" id="alamat" class="form-control form-control-lg"></textarea>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="rincian">Detail Tagihan</label>
                                        <table class="table table-bordered table-striped">
                                            <?php $i = 1; ?>
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Produk</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col"> Jumlah Harga </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($keranjang as $key => $value) : ?>
                                                    <?php ($subtotal += $value['subtotal_harga']) + $ongkir['harga']; ?>
                                                    <tr>
                                                        <th scope="row"><?= $i++; ?></th>
                                                        <td><?= $value['nama_produk']; ?></td>
                                                        <td><?= $value['harga_produk']; ?></td>
                                                        <td><?= $value['qty']; ?></td>
                                                        <td><?= $value['harga_produk'] * $value['qty']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <tr class="table-info">
                                                    <th scope="row">Biaya Pengiriman</th>
                                                    <td colspan="4"><?= $ongkir['harga']; ?></td>
                                                </tr>
                                                <tr class="table-info">
                                                    <th scope="row">Total Harga</th>
                                                    <td colspan="4"><?= $subtotal ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="total_tagihan">Total Tagihan</label>
                                        <input type="text" readonly id="total_tagihan" name="total_tagihan" value="Rp. " class="form-control form-control-lg" />
                                    </div>

                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Pastikan Data Yang Anda Masukan Sudah Benar Dan Sesuai</p>

                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
                                        <a href="/keranjang" class="btn btn-dark btn-lg btn-block">Kembali</a>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 d-none d-md-block">
                            <br><br><br><br><br><br><br>
                            <label class="form-label"><b>Metode Pembayaran Transfer</b></label>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Bank</th>
                                        <th scope="col">No. Rekening</th>
                                        <th scope="col">Atas Nama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td><img src="/img/bri.png" width="100"></td>
                                        <td>7778192034</td>
                                        <td>Arif Santoso</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td><img src="/img/bca.jpg" width="100"></td>
                                        <td>881928391</td>
                                        <td>Arif Santoso</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><br><br><br><br><br><br><br><br><br><br><br>
<?= $this->endSection(); ?>