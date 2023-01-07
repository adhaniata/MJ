<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!--isi-->
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="mt-3">Profil</h2>
            <div class="card">
                <div class="card-body">
                    <form action="/admin/akun/update-profil" method="post">
                    <?= csrf_field(); ?>
                        <div class="form-group row">
                            <label class="col-md-4">Email</label>
                            <div class="col-md-8">
                                <input type="text" name="email" class="form-control" value="<?= $user['email'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label class="col-md-4">Username</label>
                            <div class="col-md-8">
                                <input type="text" name="username" class="form-control" value="<?= $user['username'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label class="col-md-4">Nama</label>
                            <div class="col-md-8">
                                <input type="text" name="nama" class="form-control" value="<?= $user['nama'] ?>">
                                <small style="color: red;"><?= $validation->getError('nama') ?></small>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label class="col-md-4">Telp</label>
                            <div class="col-md-8">
                                <input type="text" name="telp" class="form-control" value="<?= $user['telp'] ?>">
                                <small style="color: red;"><?= $validation->getError('telp') ?></small>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label class="col-md-4">Alamat</label>
                            <div class="col-md-8">
                                <textarea class="form-control" rows="3" name="alamat"><?= $user['alamat'] ?></textarea>
                                <small style="color: red;"><?= $validation->getError('alamat') ?></small>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
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