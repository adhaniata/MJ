<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!-- form data Konfirmasi -->
<br>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <h5 class="card-header text-bg-dark">Form Konfirmasi Pembayaran</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label" for="rincian"><b>Detail Transaksi</b></label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 form-label">Nama</label>
                                        <div class="col-md-8">
                                            <input type="text" name="" value="<?= $transaksi['nama'] ?>" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 form-label">Telp</label>
                                        <div class="col-md-8">
                                            <input type="text" name="" value="<?= $transaksi['telp'] ?>" class="form-control" readonly>
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
                                        <tr align="center">
                                            <th><?= $i++ ?></th>
                                            <td><?= $td['nama_produk'] ?></td>
                                            <td><img src="/img/produk/<?= $td['gambar']; ?>" width="100"> </td>
                                            <td><?= $td['total_harga'] ?></td>
                                            <td><?= $td['qty'] ?></td>
                                            <td><?= $td['subtotal_harga'] ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                    <tr class="table-info" align="center">
                                        <th scope="row" colspan="5">Total Harga</th>
                                        <td><?= $subtotal ?></td>
                                    </tr>
                                    <tr class="table-info" align="center">
                                        <th scope="row" colspan="5">Total Ongkir</th>
                                        <td><?= $transaksi['ongkir'] ?></td>
                                    </tr>
                                    <tr class="table-info" align="center">
                                        <th scope="row" colspan="5">Total Tagihan</th>
                                        <td><?= $transaksi['ongkir'] + $subtotal ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 d-none d-md-block">
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
                            </tbody>
                        </table>
                    </div>

                    <form action="/transaksi/konfirmasi/save" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi'] ?>">
                        <label class="form-label" for="gambarBukti">Bukti Pembayaran</label>
                        <input class="form-control <?= ($validation->hasError('gambarBukti')) ? 'is-invalid' : ''; ?>" type="file" id="gambarBukti" name="gambarBukti" onchange="previewImgBukti()">

                        <div class="invalid-feedback">
                            <?= $validation->getError('gambarBukti'); ?>
                        </div>

                        <br>

                        <div class="col-sm-2">
                            <img src="/img/paymentlogo.png" class="img-thumbnail img-preview">
                        </div>
                        <br>

                        <div class="pt-1 mb-4">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
                            <a href="/keranjang" class="btn btn-dark btn-lg btn-block">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div><br>
<br><br><br><br><br><br><br><br>
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
<?= $this->endSection(); ?>