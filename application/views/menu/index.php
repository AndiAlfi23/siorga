<div class="row">
	<div class="col-lg-6">
		<?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
		<?= $this->session->flashdata('message'); ?>
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#Modal2">Tambah Controller</a>
					<table class="table table-bordered table-hover" cellspacing="0">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Controller</th>
								<th scope="col">--</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;
							foreach ($menu as $t) : ?>
								<tr>
									<th scope="row" class="text-center"><?= $i ?> .</th>
									<td><?= $t['menu'] ?></td>
									<td class="text-center">
										<?php if ($t['menu'] != 'Admin') { ?>
											<a class="btn btn-sm btn-danger" href="<?= base_url("Admin/del_menu/" . $t['id_menu']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus Controller ini?')">
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
				<h5 class="modal-title" id="exampleModalLabel">Tambah Controller</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url("Admin/menu") ?>" method="post">
				<div class="modal-body">
					<div class="form-group m-t-20">
						<input type="text" name="menu" id="menu" class="form-control" placeholder="Nama Controller">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Tambahkan</button>
				</div>
			</form>
		</div>
	</div>
</div>