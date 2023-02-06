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
                    <div class="form">
                        <div class="card text-bg-success mb-3" style="max-width: 650px;">
                            <div class="card-header">
                                <i class="fa-brands fa-android"></i> Mr. MJ
                            </div>
                            <div class="card-body mb-0">
                                <p>Hai Ada Yang Bisa Saya Bantu?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <div class="input-group mb-3">
                        <input type="text" id="text-pesan" class="form-control" placeholder="Ketikan Sesuatu">
                        <button class="btn btn-outline-dark" type="button" id="send-btn">Kirim</button>
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

<script>
    $(document).ready(function() {
        //jika tombol kirim diklik
        $("#send-btn").on("click", function() {
            //mengambil inputan pesan
            $pesan = $("#text-pesan").val();
            //tampung pesan ke variabel msg
            // $msg = '<div class="card text-bg-success mb-3" style="max-width: 700px;"><div class="card-header"><i class="fa-brands fa-android"></i> Mr. MJ</div><div class="card-body mb-0"><p>' + $pesan + '</p></div></div>'
            $msg = '<div class="card text-bg-secondary mb-3" style="max-width: 700px; float:right;"><div class="card-header"><i class="fa-solid fa-user"></i> You </div><div class="card-body mb-0"><p>' + $pesan + '</p></div></div>'
            //memasukan ke form chat
            $(".form").append($msg);
            //kosongkan inputan pesan
            $("#text-pesan").val('')

            //belum bisa masih error
            //persiapan ajax
            $.ajax({
                url: 'chatbot',
                type: 'POST',
                data: 'isi_pesan=' + $pesan,
                dataType: 'json',
                success: function(result) {
                    //jika sukses ambil data, tampung kedalam variable balasan
                    // $balasan = ' <div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>' + result + ' </p></div></div>'
                    $balasan = '<div class="card text-bg-success mb-3" style="max-width: 700px;"><div class="card-header"><i class="fa-brands fa-android"></i> Mr. MJ</div><div class="card-body mb-0"><p>' + result + '</p></div></div>'

                    //masukan kedalam form chat
                    $(".form").append($balasan);

                    // buat form otomatis scroll kebawah jika ada pesan baru
                    $(".form").scrollTop($(".form")[0].scrollHeight);

                }
            })
        });
    })
</script>

<?= $this->endSection(); ?>