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
                        <div class="col-5">
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
                        <div class="col-7">
                            <label class="form-label" for="alasan">Alasan</label>
                            <textarea id="alasan" name="alasan" placeholder="Jelaskan Alasan Pengembalian" class="form-control"></textarea><br>
                            <label class="form-label" for="telp">Gambar</label>
                            <input class="form-control" type="file" id="gambarPengembalian" name="gambarPengembalian"><br>
                            <label class="form-label" for="validasi">Validasi</label>
                            <input type="text" id="validasi" name="validasi" value="Menunggu Validasi" class="form-control" readonly /><br>
                            <label class="form-label" for="">Alamat Pengembalian</label>
                            <textarea placeholder="Jl. Penyelesaian Tomang IV No.1, North Meruya, Kembangan, West Jakarta City, Jakarta 11620" class="form-control" readonly></textarea><br>
                            <label class="form-label" for="no_resi">No Resi Pengembalian (Biaya Ditanggung Pembeli)</label>
                            <input type="text" id="no_resi" name="no_resi" placeholder="Misal: JD19099210921 (JNT)" class="form-control" /><br>
                            <label class="form-label" for="telp">Rekening Pengembalian Dana</label>
                            <input type="text" id="telp" name="telp" placeholder="Misal: 1892380129 (Budi)" class="form-control" /><br>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit</button>
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