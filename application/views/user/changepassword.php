
            <div class="row">
				<div class="col-lg-6">
					<?= $this->session->flashdata('message');?>
					<div class="card">
						<div class="card-body">
							<form action="<?= base_url("Member/changepassword")?>" method="post">
								<div class="form-group row">
									<label for="current_password" class="col-sm-4 text-right control-label col-form-label">Current Password</label>
									<div class="col-sm-8">
										<input type="password" class="form-control" id="current_password" name="current_password">
										<?= form_error('current_password','<div class="col-12"><small class="text-danger">','</small></div>')?>
									</div>
								</div>
								<div class="form-group row">
									<label for="new_password1" class="col-sm-4 text-right control-label col-form-label">New Password</label>
									<div class="col-sm-8">
										<input type="password" class="form-control" id="new_password1" name="new_password1">
										<?= form_error('new_password1','<div class="col-12"><small class="text-danger">','</small></div>')?>
									</div>
								</div>
								<div class="form-group row">
									<label for="new_password2" class="col-sm-4 text-right control-label col-form-label">Repeat Password</label>
									<div class="col-sm-8">
										<input type="password" class="form-control" id="new_password2" name="new_password2">
										<?= form_error('new_password2','<div class="col-12"><small class="text-danger">','</small></div>')?>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-lg text-center">
										<button type="submit" class="btn btn-primary">Change Password</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
            