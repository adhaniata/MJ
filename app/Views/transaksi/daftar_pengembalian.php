<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>


<!-- isi edit -->
<div class="card">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link" aria-current="true" href="/transaksi">Semua</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/transaksi/belum-bayar">Belum Dibayar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/transaksi/proses">Proses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/transaksi/selesai">Selesai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/transaksi/batal">Dibatalkan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/transaksi/pengembalian">Pengembalian</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <!-- isi table -->
        <!--isi-->
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="mt-3">Daftar Pengembalian Barang</h2>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <dif class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </dif>
                    <?php endif ?>
                    <table class="table table-bordered" id="datatable">
                        <?php $i = 1; ?>
                        <thead>
                            <tr class="table-info">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Total Pengembalian</th>
                                <th scope="col">Validasi</th>
                                <th scope="col">No Rekening Pengembalian</th>
                                <th scope="col">Resi</th>
                                <th scope="col">Status Pengembalian</th>
                                <th scope="col">Tanggal Transaksi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transaksi as $t) : ?>
                                <tr>
                                    <th><?= $i++ ?></th>
                                    <td><?= $t['nama'] ?></td>
                                    <td><?= $t['total_tagihan'] ?></td>
                                    <td><?= $t['validasi'] ?></td>
                                    <td><?= $t['rek_pengembalian'] ?></td>
                                    <td><?= $t['resi_pengembalian'] ?></td>
                                    <td><?= $t['status'] ?></td>
                                    <td><?= $t['created_at'] ?></td>
                                    <td>
                                        <a href="/transaksi/detail-semua/<?= $t['id_transaksi'] ?>" class="btn btn-dark mb-2">Detail</a>
                                        <a href="/transaksi/pengembalian/<?= $t['id_transaksi'] ?>" class="btn btn-warning">Pengembalian Barang</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<br><br>
<br><br><br><br><br>
</body>

</html>

<?= $this->endSection(); ?>