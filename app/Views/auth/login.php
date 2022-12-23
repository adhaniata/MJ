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


<!-- login -->
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

                                <form action="<?= url_to('login') ?>" method="post" class="user">
                                    <?= csrf_field() ?>

                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <i class="fas fa-cubes fa-2x me-3" style="color: #B6BDC8;"></i>
                                        <span class="h1 fw-bold mb-0"> <img src="/img/Artboard 1.png" width="70" height="64">MJ Sport</span>
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="email"><?= lang('Auth.email') ?></label>
                                        <input type="email" id="email" class="form-control form-control-lg <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>" />
                                        <div class="invalid-feedback">
                                            <?= session('errors.login') ?>
                                        </div>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="password"><?= lang('Auth.password') ?></label>
                                        <input type="password" name="password" id="password" class="form-control form-control-lg <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" />
                                        <div class="invalid-feedback">
                                            <?= session('errors.password') ?>
                                        </div>
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-dark btn-lg btn-block" type="button"><?= lang('Auth.loginAction') ?></button>
                                    </div>
                                </form>
                                <!--<a class="small text-muted" href="#!">Forgot password?</a>-->
                                <?php if ($config->allowRegistration) : ?>
                                    <p><a href="<?= url_to('register') ?>"><?= lang('Auth.needAnAccount') ?></a></p>
                                <?php endif; ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<br><br><br><br><br><br><br><br><br><br><br>
<?= $this->endSection(); ?>