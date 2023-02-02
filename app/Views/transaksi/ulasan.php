<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!--isi-->
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-3">Ulasan</h2>
            <!-- card -->
            <?php foreach ($transaksi_detail as $td) : ?>
                <?php if ($td['isi_ulasan'] == '') : ?>
                    <div class="card">
                        <!--menambahkan action berisi method save untuk menyimpan data-->
                        <form action="/transaksi/ulasan/save/<?= $td['id_transaksi_detail'] ?>" method="post" enctype="multipart/form-data">
                            <!--fitur agar tidak ada pemalsuan, hanya bisa digunakan dihalaman ini saja-->
                            <?= csrf_field(); ?>
                            <h5 class="card-header text-bg-dark">Produk</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <img src="/img/produk/<?= $td['gambar']; ?>" width="250" class="img-fluid rounded-start" alt="..."><br>
                                    </div>
                                    <div class="col-9">
                                        <!--menambahkan input slug bertype hidden-->
                                        <input type="hidden" name="id_transaksiFK" value="<?= $td['id_transaksiFK']; ?>">
                                        <label class="col-md-4 form-label">Nama Produk</label>
                                        <div class="col-md-8">
                                            <input type="text" name="nama_produk" value="<?= $td['nama_produk'] ?>" class="form-control" readonly>
                                        </div>
                                        <label class="col-md-4 form-label">Ulasan</label>
                                        <div class="col-md-8">
                                            <textarea name="isi_ulasan" placeholder="Berikan ulasan anda" class="form-control <?= ($validation->hasError('isi_ulasan')) ? 'is-invalid' : ''; ?>"></textarea>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('isi_ulasan'); ?>
                                            </div>
                                        </div><br>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div><br>
                <?php else: ?>
                    <div class="card">
                    <!--menambahkan action berisi method save untuk menyimpan data-->
                        <form action="/transaksi/ulasan/save/<?= $td['id_produkFK'] ?>" method="post" enctype="multipart/form-data">
                                    <!--fitur agar tidak ada pemalsuan, hanya bisa digunakan dihalaman ini saja-->
                        <?= csrf_field(); ?>
                            <h5 class="card-header text-bg-dark">Produk</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <img src="/img/produk/<?= $td['gambar']; ?>" width="250" class="img-fluid rounded-start" alt="..."><br>
                                    </div>
                                    <div class="col-9">
                                        <!--menambahkan input slug bertype hidden-->
                                        <input type="hidden" name="id_transaksiFK" value="<?= $td['id_transaksiFK']; ?>">
                                        <label class="col-md-4 form-label">Nama Produk</label>
                                        <div class="col-md-8">
                                            <input type="text" name="nama_produk" value="<?= $td['nama_produk'] ?>" class="form-control" readonly>
                                        </div>
                                        <label class="col-md-4 form-label">Ulasan</label>
                                        <div class="col-md-8">
                                            <textarea name="isi_ulasan" placeholder="Berikan ulasan anda" class="form-control <?= ($validation->hasError('isi_ulasan')) ? 'is-invalid' : ''; ?>" readonly><?= $td['isi_ulasan'] ?></textarea>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('isi_ulasan'); ?>
                                            </div>
                                        </div><br>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div><br>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    </div>
</div>
<br><br>
<br><br><br><br><br>
</body>

</html>

<?= $this->endSection(); ?>