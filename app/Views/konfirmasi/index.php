<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!-- form data pembelian -->
<div class="container">
    <div class="row">
        <div class="col">
            <form action="/transaksi/konfirmasi/save" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <!--menambahkan input slug bertype hidden-->
                <input type="hidden" name="id_transaksiFK" value="<?= $transaksi['id_transaksi']; ?>">
                <div class="d-flex align-items-center mb-3 pb-1">
                    <span class="h1 fw-bold mb-0"> <img src="/img/Artboard 1.png" width="70" height="64">MJ Sport</span>
                </div>

                <h4 class="fw-normal mt-3 mb-3 pb-3" style="letter-spacing: 1px;"><b>Konfirmasi Pembayaran</b></h4>

                <label class="form-label"><b>Detail Transaksi</b></label>
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
                <br>

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
                            <tr>
                                <th scope="row">2</th>
                                <td><img src="/img/bca.jpg" width="100"></td>
                                <td>881928391</td>
                                <td>Arif Santoso</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <form>
                    <div class="row mb-3">
                        <label for="gambar" class="col-sm-2 col-form-label">Bukti Transfer</label>
                        <div class="col-sm-10">
                            <div class="mb-3">
                                <label for="gambarBukti" class="form-label">Upload Bukti</label>
                                <input class="form-control <?= ($validation->hasError('gambarBukti')) ? 'is-invalid' : ''; ?>" type="file" id="gambarBukti" name="gambarBukti" onchange="previewImgBukti()">
                                <br>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('gambarBukti'); ?>
                                </div>
                                <div class="col-sm-2">
                                    <img src="/img/paymentlogo.png" class="img-thumbnail img-preview">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-1 mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
                        <a href="/keranjang" class="btn btn-dark btn-lg btn-block">Kembali</a>
                    </div>
                </form>
        </div>
    </div>
</div>
<br><br><br><br>
<?= $this->endSection(); ?>