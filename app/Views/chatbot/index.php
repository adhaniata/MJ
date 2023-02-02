<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!--isi-->

<!--chatbot-->
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="card text-center">
                <div class="card-header text-bg-dark">
                    Chatbot | MJ Sport
                </div>
                <div class="card-body">
                    <form>
                        <div class="card text-bg-success mb-3" style="max-width: 700px;">
                            <div class="card-header">
                                <i class="fa-brands fa-android"></i> Mr. MJ
                            </div>
                            <div class="card-body mb-0">
                                <p>Hai Ada Yang Bisa Saya Bantu?</p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-muted">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Ketikan Sesuatu" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-dark" type="button" id="button-addon2">Kirim</button>
                    </div>

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