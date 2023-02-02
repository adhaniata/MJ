<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!-- form data pembelian -->
<br>
<div class="container">
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
                                        <td><?= $transaksi['ongkir'] ?></td>
                                    </tr>
                                    <tr class="table-info">
                                        <th scope="row" colspan="5">Total Pengembalian Dana</th>
                                        <td><?= $transaksi['ongkir'] + $subtotal ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <?php if ($cek_pengembalian == 1) : ?>
                            <?php if ($pengembalian['validasi'] == 'Valid' and $pengembalian['status'] == 'null') : ?>
                                <label class="form-label"><b>Status Validasi : <?= $pengembalian['validasi'] ?></b></label>
                                <form action="/transaksi/pengembalian/update/<?= $pengembalian['id_pengembalian'] ?>" method="post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <!--menambahkan input bertype hidden-->
                                    <input type="hidden" name="id_pengembalian" value="<?= $pengembalian['id_pengembalian']; ?>">
                                    <div class="col-12">
                                        <label class="form-label" for="">Alamat Pengembalian</label>
                                        <textarea placeholder="Jl. Penyelesaian Tomang IV No.1, North Meruya, Kembangan, West Jakarta City, Jakarta 11620" class="form-control" readonly><?= $transaksi['alamat'] ?></textarea><br>
                                        <label class="form-label" for="resi_pengembalian">No Resi Pengembalian (Biaya Ditanggung Pembeli)</label>
                                        <input type="text" id="resi_pengembalian" name="resi_pengembalian" placeholder="Misal: JD19099210921 (JNT)" class="form-control" /><br>
                                        <label class="form-label" for="telp">Rekening Pengembalian Dana</label>
                                        <input type="text" id="rek_pengembalian" name="rek_pengembalian" placeholder="Misal: 1892380129 (Budi)" class="form-control" /><br>
                                    </div>
                                    <p>Pastikan Form Diisi Dengan Benar. Pengembalian Dana Akan Dilakukan Setelah Produk Sampai Ke Alamat Tujuan</p>
                                    <button class="btn btn-primary" type="submit">Update</button>
                                    <small>Pengisian Form Hanya Diperbolehkan Satu Kali Saja</small>
                                </form>
                            <?php elseif ($pengembalian['validasi'] == 'Valid' and $pengembalian['status'] == 'Pengiriman Produk Retur') : ?>
                                <label class="form-label"><b>Status Pengembalian: <?= $pengembalian['status'] ?></b></label>
                                <p>Dana Akan Dikembalikan Jika Produk Sudah Sampai. Mohon Menunggu</p>
                            <?php elseif ($pengembalian['validasi'] == 'Valid' and $pengembalian['status'] == 'Pengembalian Dana Selesai') : ?>
                                <label class="form-label"><b>Status Pengembalian: <?= $pengembalian['status'] ?></b></label>
                                <p>Dana Sudah Dikembalikan Ke No Rekening Anda : <?= $pengembalian['rek_pengembalian']; ?>.</p>
                                <p>Maaf Atas Ketidaknyamanannya. Terimakasih</p>
                            <?php else : ?>
                                <label class="form-label"><b>Status Validasi: <?= $pengembalian['validasi'] ?></b></label>
                            <?php endif ?>

                        <?php else : ?>
                            <form action="/transaksi/proses-pengembalian/<?= $transaksi['id_transaksi'] ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="col-12">
                                    <label class="form-label" for="alasan">Alasan</label>
                                    <textarea id="alasan" name="alasan" placeholder="Pastikan Barang Dalam Kondisi Baru (Tag Komplit, Tidak Digunakan, dan Tidak Dicuci). Jelaskan Alasan Pengembalian." class="form-control"></textarea><br>
                                    <label class="form-label" for="gambar">Gambar</label>
                                    <input class="form-control" type="file" id="gambar" name="gambar"><br>
                                    <label class="form-label" for="validasi">Validasi (Permintaan Pengembalian Produk Akan Segera Di Validasi Admin, Mohon Ditunggu)</label>
                                    <input type="text" id="validasi" name="validasi" value="Menunggu Validasi" class="form-control" readonly /><br>
                                    <!-- <label class="form-label" for="">Alamat Pengembalian</label>
                                    <textarea placeholder="Jl. Penyelesaian Tomang IV No.1, North Meruya, Kembangan, West Jakarta City, Jakarta 11620" class="form-control" readonly><?= $transaksi['alamat'] ?></textarea><br>
                                    <label class="form-label" for="resi_pengembalian">No Resi Pengembalian (Biaya Ditanggung Pembeli)</label>
                                    <input type="text" id="resi_pengembalian" name="resi_pengembalian" placeholder="Misal: JD19099210921 (JNT)" class="form-control" /><br>
                                    <label class="form-label" for="telp">Rekening Pengembalian Dana</label>
                                    <input type="text" id="rek_pengembalian" name="rek_pengembalian" placeholder="Misal: 1892380129 (Budi)" class="form-control" /><br> -->
                                </div>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </form>
                        <?php endif ?>
                    </div>
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