<div class="row">
	<div class="col-lg-6">
		<?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
		<?= $this->session->flashdata('message'); ?>
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#Modal2">Tambah Role Baru</a>
					<table class="table table-bordered table-hover" cellspacing="0">
						<thead>
							<tr>
								<th scope="col" class="text-center">Level</th>
								<th scope="col" class="text-center">Role</th>
								<th scope="col" class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;
							foreach ($role as $r) : ?>
								<tr>
									<th scope="row" class="text-center"><?= $r['level'] ?></th>
									<td><?= $r['role'] ?></td>
									<td class="text-center">
										<a class="btn btn-sm btn-warning" href="<?= base_url("Admin/roleaccess/") . $r['level'] ?>">access</a>
										<?php if ($r['level'] != '1') { ?>
											<a class="btn btn-sm btn-success" href="<?= base_url("Admin/e_role/" . $r['level']) ?>">edit</a>
											<a class="btn btn-sm btn-danger" href="<?= base_url("Admin/del_role/" . $r['level']) ?>">
												<i class="mdi mdi-delete"></i>
											</a>
										<?php } ?>
									</td>
								</tr>
							<?php $i++;
							endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Role</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url("Admin/role") ?>" method="post">
				<div class="modal-body">
					<div class="form-group m-t-20">
						<input type="text" name="level" id="level" class="form-control" placeholder="Level">
					</div>
					<div class="form-group m-t-20">
						<input type="text" name="role" id="role" class="form-control" placeholder="Role Name">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add</button>
				</div>
			</form>
		</div>
	</div>
</div>