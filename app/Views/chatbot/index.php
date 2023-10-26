<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!--isi-->

<!--chatbot-->
<div class="container mt-5">
    <div class="row">
        <!-- <div class="col-md-4"></div> -->
        <div class="col">
            <div class="card text-center mx-auto" style="max-width: 900px">
                <div class="card-header text-bg-dark">
                    Chatbot
                </div>
                <div class="card-body">
                    <div class="form">
                        <div class="card mb-3" style="min-width: 450px; max-width: 500px; float:left;">
                            <div class="card-header text-bg-success mb-0">
                                <div class="row">
                                    <div class="col-1">
                                        <img src="/img/rbt2.png" width="40px" class="rounded-circle">
                                    </div>
                                    <div class="col-11 mt-1">
                                        <p>Hai Ada Yang Bisa Saya Bantu?</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body mb-0">
                                <ul class="list-group list-group-flush">
                                    <?php $i = 1 ?>
                                    <?php foreach ($chatbot as $key => $value) : ?>
                                        <li class="list-group-item"><button class="btn btn-outline-success" type="button" id="tombol-list<?= $i++; ?>"><?= $value['pertanyaan']; ?></button></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                        </div><br>
                    </div><br>

                    <!-- dessign lama -->
                    <!-- <div class="form">
                        <div class="card text-bg-success mb-3" style="max-width: 650px;">
                            <div class="card-header">
                                <i class="fa-brands fa-android"></i> Mr. MJ
                            </div>
                            <div class="card-body mb-0">
                                <p>Hai Ada Yang Bisa Saya Bantu?</p>
                            </div>
                        </div>
                    </div> -->

                    <!-- design you baru -->
                    <!-- <div class="row">
                        <div class="col-11">
                            <div class="form">
                                <div class="card text-bg-success mb-3" style="max-width: 650px; float:right;">
                                    <div class="card-body mb-0">
                                        <p>Hai Ada Yang Bisa Saya Bantu?</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <img src="/img/rbt.png" width="85px" class="rounded-circle">
                        </div>
                    </div> -->


                </div>
                <div class="card-footer text-muted">
                    <div class="input-group mb-3">
                        <input type="text" id="text-pesan" class="form-control" placeholder="Ketikan Sesuatu">
                        <button class="btn btn-outline-dark" type="button" id="send-btn">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-4"></div> -->
    </div>
</div>
<br><br>
<br><br><br><br><br>
</body>

</html>

<script>
    $(document).ready(function() {
        <?php $i = 1 ?>
        <?php foreach ($chatbot as $key => $value) : ?>
            $("#tombol-list<?= $i++; ?>").click(function() {
                $("#text-pesan").val('<?= $value['pertanyaan']; ?>');
            });
        <?php endforeach; ?>
    });


    $(document).ready(function() {
        //jika tombol kirim diklik
        $("#send-btn").on("click", function() {
            //mengambil inputan pesan
            $pesan = $("#text-pesan").val();
            //tampung pesan ke variabel msg
            // $msg = '<div class="card text-bg-success mb-3" style="max-width: 700px;"><div class="card-header"><i class="fa-brands fa-android"></i> Mr. MJ</div><div class="card-body mb-0"><p>' + $pesan + '</p></div></div>'
            $msg = '<br><br><div class="card text-bg-dark mb-3 mt-12" style="min-width: 425px; max-width: 500px; float:right;"><div class="card-body mb-0"><div class="row"><div class="col-9"><p>' + $pesan + '</p></div><div class="col-3"><img src="/img/user2.png" width="40px" class="rounded-circle"></div></div></div></div><br><br>'
            // $msg = '<div class="card text-bg-secondary mb-3" style="max-width: 650px; float:right;"><div class="card-body mb-0"><p>' + $pesan + '<img src="/img/user.png" width="30px" class="rounded-circle"></p></div></div></div><br><br><br>'
            //memasukan ke form chat
            $(".form").append($msg);
            //kosongkan inputan pesan
            $("#text-pesan").val('')

            //persiapan ajax
            $.ajax({
                url: '/chatbot/kirim',
                type: 'POST',
                data: {
                    pesan: $pesan
                },
                dataType: 'json',
                // success: function(res) {
                //     //jika sukses ambil data, tampung kedalam variable balasan
                //     // $balasan = '<div class="card text-bg-success mb-3" style="max-width: 700px;"><div class="card-header"><i class="fa-brands fa-android"></i> Mr. MJ</div><div class="card-body mb-0"><p>' + res.result + '</p></div></div>'
                //     // $balasan = '<br><div class="card text-bg-success mb-3" style="max-width: 700px; float:left;"><div class="card-body mb-0"><p><img src="/img/rbt2.png" width="30px" class="rounded-circle">' + res.result + '</p></div></div></div><br>'
                //     $balasan = '<br><div class="card text-bg-success mb-3" style="min-width: 650px; max-width: 800px; float:left;"><div class="card-body mb-0"><div class="row"><div class="col-1"><img src="/img/rbt2.png" width="40px" class="rounded-circle"></div><div class="col-11"><p>' + res.result.jawaban + '</p></div></div></div></div><br><br><br>'

                // //masukan kedalam form chat
                // $(".form").append($balasan);

                // }
                success: function(res) {
                    if (res.result != null) {
                        var data = res.result.jawaban;
                    } else {
                        var data = "Maaf, tidak menemukan jawaban yang kamu maksud. Kamu bisa Menghubungi Kami Melalui WhatsApp <a href='http://wa.me/6281212740577' target='_blank'> Klik Disini</a>";
                    }

                    $balasan = '<br><div class="card text-bg-success mb-3" style="min-width: 425px; max-width: 500px; float:left;"><div class="card-body mb-0"><div class="row"><div class="col-1"><img src="/img/rbt2.png" width="40px" class="rounded-circle"></div><div class="col-11"><p>' + data + '</p></div></div></div></div><br><br><br>';

                    //masukan kedalam form chat
                    $(".form").append($balasan);
                }
            })
        });
    })
</script>

<?= $this->endSection(); ?>