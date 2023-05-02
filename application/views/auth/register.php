	<div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                <div>
                    <div class="text-center p-b-5">
                        <h3 class="text-white">REGISTRATION</h3>
                    </div>
                    <form class="form-horizontal m-t-5" method="post" action="<?= base_url("Auth/registration")?>">
                        <div class="row p-b-10">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" name="name" id="name" placeholder="Full Name" aria-describedby="basic-addon1" value="<?= set_value('name')?>">
									<?= form_error('name','<div class="col-12"><small class="text-warning">','</small></div>')?>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" name="email" id="email" placeholder="Enter Email Address" aria-describedby="basic-addon1" value="<?= set_value('email')?>">
									<?= form_error('email','<div class="col-12"><small class="text-warning">','</small></div>')?>
                                </div>
								<div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" name="password1" id="password1" placeholder="Password" aria-describedby="basic-addon1">
									<?= form_error('password1','<div class="col-12"><small class="text-warning">','</small></div>')?>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" name="password2" id="password2" placeholder=" Confirm Password" aria-describedby="basic-addon1">
									<?= form_error('password2','<div class="col-12"><small class="text-warning">','</small></div>')?>
                                </div>
								<div class="form-group">
                                    <button class="btn btn-block btn-lg btn-info" type="submit">Register Account</button>
                                </div>
                            </div>
                        </div>
						<div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20 text-center">
                                        <a class="text-white" href="<?= base_url("Auth") ?>">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>