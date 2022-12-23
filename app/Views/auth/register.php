<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>

<!--isi-->
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
                    <a class="nav-link" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i> Keranjang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/login/"><i class="fa-solid fa-user"></i> Login</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-store"></i>
                        e-commerce
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="https://www.shopee.co.id/" target="_blank">Shopee</a></li>
                        <li><a class="dropdown-item" href="https://www.tokopedia.coma/" target="_blank">Tokopedia</a></li>
                        <li><a class="dropdown-item" href="https://www.lazada.co.id/" target="_blank">Lazada</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa-solid fa-robot"></i> Chatbot</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Link</a>
                </li>
            </ul>
            <form class="d-flex pt-2" role="search">
                <input class="form-control me-2" type="search" placeholder="Cari..." aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>


<!-- Register -->
<section class="vh-100" style="background-color: white;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="/img/Account-amico.svg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">

                                <?= view('Myth\Auth\Views\_message_block') ?>

                                <form action="<?= url_to('register') ?>" method="post" class="user">
                                    <?= csrf_field() ?>

                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <span class="h1 fw-bold mb-0"> <img src="/img/Artboard 1.png" width="70" height="64">MJ Sport</span>
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;"><?= lang('Auth.register') ?></h5>

                                    <div class="form-group">
                                        <label class="form-label" for="email"><?= lang('Auth.email') ?></label>
                                        <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                                        <small id="emailHelp" class="form-text text-muted"><?= lang('Auth.weNeverShare') ?></small>
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        <label class="form-label" for="username"><?= lang('Auth.username') ?></label>
                                        <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="password"><?= lang('Auth.password') ?></label>
                                        <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                                        <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                                    </div>
                                    <br>

                                    <!--<div class="form-outline mb-4">
                                        <label class="form-label" for="nama">Nama Lengkap</label>
                                        <input type="text" id="nama" class="form-control form-control-lg" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="alamat">Alamat</label>
                                        <input type="text" id="alamat" class="form-control form-control-lg" />
                                    </div>
                                        -->

                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-dark btn-lg btn-block" type="submit"><?= lang('Auth.register') ?></button>
                                    </div>
                                </form>

                                <!--<a class="small text-muted" href="#!">Forgot password?</a>-->
                                <p><?= lang('Auth.alreadyRegistered') ?> <a href="<?= url_to('login') ?>"><?= lang('Auth.signIn') ?></a></p>
                                <!--<p class="mb-5 pb-lg-2" style="color: #393f81;">Already have an account? login now <a href="/login" style="color: #393f81;">Login here</a></p>
                                    <a href="#!" class="small text-muted">Terms of use.</a>
                                    <a href="#!" class="small text-muted">Privacy policy</a>-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><br><br><br><br><br><br><br><br><br><br><br>
<?= $this->endSection(); ?>