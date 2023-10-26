<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!-- form data pembelian -->
<section class="vh-100" style="background-color: white;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-15">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-12 col-lg-12 d-flex align-items-center">
                            <div class="card-body p-10 p-lg-5 text-black">
                                <form action="/transaksi/save" method="post">
                                    <?= csrf_field(); ?>
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <span class="h1 fw-bold mb-0"> <img src="/img/Artboard 1.png" width="70" height="64">MJ Sport</span>
                                    </div>

                                    <h4 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;"><b>Form Pembelian</b></h4>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="nama"><b>Nama Lengkap</b></label>
                                        <input type="text" id="nama" name="nama" value="<?= $user['nama'] ?>" class="form-control" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="telp"><b>No Telepon Aktif</b></label>
                                        <input type="text" id="telp" name="telp" value="<?= $user['telp'] ?>" class="form-control" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label for="ongkos_kirim" class="col-sm-2 col-form-label"><b>Kota</b></label>
                                        <div>
                                            <select class="form-select <?= ($validation->hasError('ongkos_kirim')) ? 'is-invalid' : ''; ?>" name="ongkos_kirim" id="ongkos_kirim" aria-label="Default select example">
                                                <!--<option selected>Pilih Kota Untuk Ongkir </option>-->
                                                <?php foreach ($ongkir as $lk) {
                                                    echo '<option value="' . $lk['harga'] . '">' . $lk['kota'] . ' Rp.' . $lk['harga'] . '</option>';
                                                } ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('ongkos_kirim'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="alamat"><b>Alamat Lengkap</b></label>
                                        <textarea name="alamat" id="alamat" class="form-control"><?= $user['alamat'] ?></textarea>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="rincian"><b>Detail Tagihan</b></label>
                                        <table class="table table-bordered table-striped">
                                            <?php $i = 1; ?>
                                            <thead>
                                                <tr>
                                                    <th scope="col" width="10px">No.</th>
                                                    <th scope="col">Produk</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col"> Jumlah Harga </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $subtotal = 0; ?>
                                                <?php foreach ($keranjang as $key => $value) : ?>
                                                    <?php $subtotal += $value['subtotal_harga']; ?>
                                                    <tr class="table-light">
                                                        <th scope="row"><?= $i++; ?></th>
                                                        <td><?= $value['nama_produk']; ?></td>
                                                        <td><?= $value['harga_produk']; ?></td>
                                                        <td><?= $value['qty'] ?></td>
                                                        <td><?= $value['harga_produk'] * $value['qty']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <tr class="table-info">
                                                    <th scope="row" colspan="4">Total Harga</th>
                                                    <td id="total_harga"><?= $subtotal ?></td>
                                                </tr>
                                                <tr class="table-info">
                                                    <th scope="row" colspan="4">Biaya Pengiriman</th>
                                                    <td id="biaya_pengiriman"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="total_tagihan"><b>Total Tagihan</b></label>
                                        <input type="text" readonly id="total_tagihan" name="total_tagihan" class="form-control" />
                                    </div>
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
                                                <td><img src="/img/bca.jpg" width="100"></td>
                                                <td>
                                                    2871451887
                                                    <input type="hidden" value="2871451887" id="myRek">
                                                    <button type="button" class=" btn btn-secondary ml-2" onclick="myFunction()">Copy</button>
                                                </td>
                                                <td>Muhammad Arif Santoso</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <p class="mb-2 pb-lg-2" style="color: #393f81;">Pastikan Data Yang Anda Masukan Sudah Benar Dan Sesuai</p>

                                    <div class="pt-1 mb-2">
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
                                        <a href="/keranjang" class="btn btn-dark btn-lg btn-block">Kembali</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- <div class="col-md-6 col-lg-4 d-none d-md-block">
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
                                        <th scope="row">1</th>
                                        <td><img src="/img/bca.jpg" width="100"></td>
                                        <td>
                                            2871451887
                                            <input type="hidden" value="2871451887" id="myRek">
                                            <button class=" btn btn-dark mt-2" onclick="myFunction()">Copy</button>
                                        </td>
                                        <td>Muhammad Arif Santoso</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<script type="text/javascript">
    $(document).ready(function() {
        var total_harga = $('#total_harga').text();
        var ongkir = $('#ongkos_kirim').val();
        var hitung = parseInt(total_harga) + parseInt(ongkir);

        $('#biaya_pengiriman').text(ongkir);
        $('#total_tagihan').val(hitung);

        $('#ongkos_kirim').on('change', function() {
            var ongkir = $(this).val();
            var hitung = parseInt(total_harga) + parseInt(ongkir);

            $('#biaya_pengiriman').text(ongkir);
            $('#total_tagihan').val(hitung);
        })
    })
</script>

<script>
    function myFunction() {
        // Get the text field
        var copyText = document.getElementById("myRek");

        // Select the text field
        copyText.select();
        // copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);

        // Alert the copied text
        alert("Copied Rek: " + copyText.value);
    }
</script>
<?= $this->endSection(); ?>