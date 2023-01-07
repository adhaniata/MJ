<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!--isi-->
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="mt-3">Password</h2>
            <div class="card">
                <div class="card-body">
                    <form action="/akun/update-password" method="post">
                    <?= csrf_field(); ?>
                        <div class="form-group row mt-2">
                            <label class="col-md-4">Password Baru</label>
                            <div class="col-md-8">
                                <input type="password" name="pass_baru" class="form-control">
                                <small style="color: red;"><?= $validation->getError('pass_baru') ?></small>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label class="col-md-4">Konfirmasi Password</label>
                            <div class="col-md-8">
                                <input type="password" name="pass_konf" class="form-control">
                                <small style="color: red;"><?= $validation->getError('pass_konf') ?></small>
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