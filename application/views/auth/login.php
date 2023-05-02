<div class="main-wrapper">
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
        <div class="auth-box border-top border-secondary bg-dark">
            <div id="loginform">
                <div class="text-center p-t-3 p-b-3">
                    <span class="db"><img src="<?= base_url() ?>assets/logo/<?= $app['logo_organisasi'] ?>" alt="logo" width="125" /></span>
                </div>
                <form class="form-horizontal m-t-5" id="loginform" method="POST" action="<?= base_url("Auth") ?>">
                    <div class="row m-b-5">
                        <div class="col-lg">
                            <?= $this->session->flashdata('message'); ?>
                        </div>
                    </div>
                    <div class="row p-b-10">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-danger text-white" id="username"><i class="mdi mdi-account-key"></i></span>
                                </div>
                                <input type="text" class="form-control form-control-lg" placeholder="Username" name="username" id="username" value="<?= set_value('username') ?>" autofocus>
                                <?= form_error('username', '<div class="col-12"><small class="text-warning">', '</small></div>') ?>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-info text-white" id="password"><i class="mdi mdi-key"></i></span>
                                </div>
                                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                                <?= form_error('password', '<div class="col-12"><small class="text-warning">', '</small></div>') ?>
                            </div>
                            <div class="form-group mb-3">
                                <button class="btn btn-block btn-lg btn-success" type="submit">Login</button>
                            </div>
                        </div>
                    </div>
                    <div class="row border-top border-secondary">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="p-t-20">
                                    <a href="<?= base_url("Auth/forgotPassword") ?>" class="btn btn-info">
                                        <i class="fa fa-lock m-r-5"></i> Lupa password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>