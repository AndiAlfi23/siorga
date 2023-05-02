           <div class="row">
           	<div class="col-lg-6">
           		<div class="card">
           			<div class="card-body">
           				<form action="<?= base_url("Member/p_e_anggota") ?>" method="post" enctype="multipart/form-data">
           					<div class="form-group row">
           						<label for="npm" class="col-sm-2 control-label col-form-label">NPM</label>
           						<div class="col-sm-9">
           							<input type="text" class="form-control" id="npm" name="npm" value="<?= $user['npm'] ?>">
           							<?= form_error('npm', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
           						</div>
           					</div>
           					<div class="form-group row">
           						<label for="fnama" class="col-sm-2 control-label col-form-label">Nama</label>
           						<div class="col-sm-9">
           							<input type="text" class="form-control" id="fnama" name="fnama" value="<?= $user['nama'] ?>">
           							<?= form_error('fnama', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
           						</div>
           					</div>
           					<div class="form-group row">
           						<label for="alamat" class="col-sm-2 control-label col-form-label">Alamat</label>
           						<div class="col-sm-9">
           							<input type="text" class="form-control" id="alamat" name="alamat" value="<?= $user['alamat'] ?>">
           							<?= form_error('alamat', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
           						</div>
           					</div>
           					<div class="form-group row">
           						<label for="email" class="col-sm-2 control-label col-form-label">Email</label>
           						<div class="col-sm-9">
           							<input type="text" class="form-control" id="email" name="email" value="<?= $user['email'] ?>">
           							<?= form_error('email', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
           						</div>
           					</div>
           					<div class="form-group row">
           						<label for="telp" class="col-sm-2 control-label col-form-label">Telepon</label>
           						<div class="col-sm-9">
           							<input type="text" class="form-control" id="telp" name="telp" value="<?= $user['telp'] ?>">
           							<?= form_error('telp', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
           						</div>
           					</div>
           					<div class="form-group row">
           						<label for="image" class="col-sm-2 control-label col-form-label">Picture</label>
           						<div class="col-sm-9">
           							<div class="row">
           								<div class="col-sm-3">
           									<img src="<?= base_url('assets/images/users/') . $user['picture']; ?>" class="img-thumbnail">
           								</div>
           								<div class="col-sm-9">
           									<div class="custom-file">
           										<input type="file" class="custom-file-input" id="image" name="image">
           										<label class="custom-file-label" for="image">Choose file...</label>
           									</div>
           								</div>
           							</div>
           						</div>
           					</div>
           					<div class="form-group row justify-content-end">
           						<div class="col-sm-9">
           							<button type="submit" class="btn btn-primary">Edit</button>
           						</div>
           					</div>
           				</form>
           			</div>
           		</div>
           	</div>
           </div>