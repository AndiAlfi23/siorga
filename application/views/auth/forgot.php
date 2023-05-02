        <div class="main-wrapper">
            <div class="preloader">
                <div class="lds-ripple">
                    <div class="lds-pos"></div>
                    <div class="lds-pos"></div>
                </div>
            </div>
            <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
                <div class="auth-box bg-dark border-top border-secondary">
                    <div id="loginform">
                        <div class="text-center p-t-3 p-b-3">
                            <span class="db"><img src="<?= base_url() ?>assets/logo/<?= $app['logo_organisasi'] ?>" alt="logo" width="125" /></span>
                        </div>
                        <form class="form-horizontal m-t-20" method="POST" action="<?= base_url("Auth/forgotPassword") ?>">
                            <div class="row m-b-5">
                                <div class="col-lg">
                                    <?= $this->session->flashdata('message'); ?>
                                </div>
                            </div>
                            <div class="row p-b-30">
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="mdi mdi-email"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-lg" placeholder="Enter Email Address..." name="email" id="email" aria-describedby="basic-addon1" value="<?= set_value('email') ?>">
                                        <?= form_error('email', '<div class="col-12"><small class="text-warning">', '</small></div>') ?>
                                    </div>
                                    <div class="form-group mb-3">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">Reset Password</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row border-top border-secondary">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="p-t-20">
                                            <a href="<?= base_url("Auth") ?>" class="btn btn-success"><i class="fa fa-lock m-r-5"></i> Back to Login</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>