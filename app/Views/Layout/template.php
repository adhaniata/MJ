<html>

<head>
    <title><?= $title; ?></title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <!--font awesome-->
    <link rel="stylesheet" href="/fontawesome/css/all.css">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <script language="JavaScript" type="text/javascript" src="/jquery.js"></script>
    <script language="JavaScript" type="text/javascript" src="/bootstrap/js/bootstrap.js"></script>
    <script language="JavaScript" type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
    <script>
        function previewImgOngkir() {
            const gambarOngkir = document.querySelector('#gambarOngkir');
            const gambarOngkirLabel = document.querySelector('.form-label')
            const imgPreview = document.querySelector('.img-preview');
            gambarOngkirLabel.textContent = gambarOngkir.files[0].name;
            const fileGambar = new FileReader();
            fileGambar.readAsDataURL(gambarOngkir.files[0]);
            fileGambar.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }

        function previewImgProduk() {
            const gambarProduk = document.querySelector('#gambarProduk');
            const gambarProdukLabel = document.querySelector('.form-label')
            const imgPreview = document.querySelector('.img-preview');
            gambarProdukLabel.textContent = gambarProduk.files[0].name;
            const fileGambar = new FileReader();
            fileGambar.readAsDataURL(gambarProduk.files[0]);
            fileGambar.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }

        function previewImgBukti() {
            const gambarBukti = document.querySelector('#gambarBukti');
            const gambarBuktiLabel = document.querySelector('.form-label')
            const imgPreview = document.querySelector('.img-preview');
            gambarBuktiLabel.textContent = gambarBukti.files[0].name;
            const fileGambar = new FileReader();
            fileGambar.readAsDataURL(gambarBukti.files[0]);
            fileGambar.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>

<body>
    <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="/img/Artboard 1.png" alt="Bootstrap" width="40" height="34">
                MJ Sport</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <?php if (logged_in() == false) {
                        echo '
                        <li class="nav-item">
                        <a class="nav-link disabled" href="keranjang"><i class="fa-solid fa-cart-shopping"></i> Keranjang</a>
                        </li>
                        ';
                    } else {
                        if (in_groups('user')) {
                            echo '
                            <li class="nav-item">
                            <a class="nav-link" href="/keranjang"><i class="fa-solid fa-cart-shopping"></i> Keranjang</a>
                        </li>
                        ';
                        }
                    } ?>
                    <?php if (logged_in() == false) {
                        echo '
                        <li class="nav-item">
                        <a class="nav-link" href="/login"><i class="fa-solid fa-sign-in"></i> Login</a>
                        </li>
                        ';
                    } else {
                        echo '
                        <li class="nav-item">
                            <a class="nav-link" href="' . base_url('logout') . '"><i class="fa-solid fa-sign-out"></i> Logout</a>
                        </li>
                        ';
                    } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/chatbot"><i class="fa-solid fa-robot"></i> Chatbot</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/ongkir/"><i class="fa-solid fa-truck-fast"></i></i> Biaya Kirim</a>
                    </li>
                    <?php if (logged_in() == true && in_groups('user')) {
                        echo '
                        <li class="nav-item">
                            <a class="nav-link" href="/transaksi"><i class="fa-solid"></i> Transaksi Saya</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-user"></i>
                                Akun
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/akun/profil">Profil</a></li>
                                <li><a class="dropdown-item" href="/akun/password">Ubah Password</a></li>
                            </ul>
                        </li>
                        ';
                    } ?>

                    <?php if (in_groups('admin')) {
                        echo '
                        <li class="nav-item">
                            <a class="nav-link" href="/admin"><i class="fa-solid fa-lock"></i></i> Admin</a>
                        </li>
                        ';
                    } ?>
                </ul>
                <!-- <form class="d-flex pt-2" role="search">
                    <input class="form-control me-2" type="search" placeholder="Cari..." aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form> -->
            </div>
        </div>
    </nav>

    <?= $this->renderSection('content'); ?>

    <!--Footer-->
    <footer class="bg-light text-center-light text-lg-start">
        <!-- Grid container -->
        <div class="container p-4">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase"><img src="/img/Artboard 1.png" alt="Bootstrap" width="50" height="44">Contact</h5>
                    <p>
                        <b>For any question & suggestion regarding our services please contact :</b><br>
                        Monday - Friday : 09.00 - 17.00<br>
                        Saturday 09.00 - 15.00<br>
                        (Except public holiday)<br>
                    </p>
                    <a href="https://wa.me/6281285173625" target="_black" style="color:black"><i class="fa-brands fa-whatsapp"></i> Whatsapp: 081285173625</a> <br>
                    <a href="#" target="_black" style="color:black"><i class="fa-solid fa-envelope"></i></a>
                    Arifsantoso@gmail.com <br>
                    <a href="#" target="_black" style="color:black"><i class="fa-solid fa-store"></i></a> Shopee
                    <p>

                    </p>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Location</h5>
                    <div class="col-md-4">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.4772407521145!2d106.72581169828007!3d-6.200596798781982!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f71b52e99b17%3A0x5d03f22df7cf89e9!2sMj%20Sport%20Collection!5e0!3m2!1sid!2sid!4v1668593138809!5m2!1sid!2sid" width="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center text-light p-3" style="background-color: #29292A ;">
            2022 MJ Sport
            <a class="text-light" href=""></a>
        </div>
        <!-- Copyright -->
    </footer>
</body>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>

</html>