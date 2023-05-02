		<div class="row">
			<div class="col">
				<?php if (validation_errors()) { ?>
					<div class="alert alert-danger" role="alert">
						<?= validation_errors(); ?>
					</div>
				<?php } ?>
				<?= $this->session->flashdata('message'); ?>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Tambah Menu baru</a>
							<table id="zero_config" class="table table-bordered table-hover" cellspacing="0">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Nama Menu</th>
										<th scope="col">Controller</th>
										<th scope="col">URL</th>
										<th scope="col">Icon</th>
										<th scope="col">Active</th>
										<th scope="col">--</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1;
									foreach ($subm as $t) : ?>
										<tr>
											<th scope="row" class="text-center"><?= $i ?></th>
											<td><?= $t['title'] ?></td>
											<td><?= $t['menu'] ?></td>
											<td><?= $t['url'] ?></td>
											<td><?= $t['icon'] ?></td>
											<td class="text-center">
												<?php if ($t['is_active'] == '1') { ?>
													<a href="<?= base_url("Admin/s_submenu/" . $t['id_sm'] . '/0') ?>" class="badge badge-pill badge-success">Active</a>
												<?php } else { ?>
													<a href="<?= base_url("Admin/s_submenu/" . $t['id_sm'] . '/1') ?>" class="badge badge-pill badge-danger">Non-Active</a>
												<?php } ?>
											</td>
											<td class="text-center">
												<a class="btn btn-sm btn-info" href="<?= base_url("Admin/e_submenu/" . $t['id_sm']) ?>">edit</a>
												<a class="btn btn-sm btn-danger" href="<?= base_url("Admin/del_submenu/" . $t['id_sm']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus menu ini?')">
													<i class="mdi mdi-delete"></i>
												</a>
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

		<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Tambah Menu Baru</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= base_url("Admin/submenu") ?>" method="post">
						<div class="modal-body">
							<div class="form-group m-t-20">
								<input type="text" name="title" id="title" class="form-control" placeholder="Nama Menu" autofocus="">
							</div>
							<div class="form-group m-t-20">
							
								<select name="menu_id" id="menu_id" class="form-control">
									<option value="">Pilih Kelompok</option>
										
									<option value="IKAN"> IKAN </option>
								
								</select>
								
								
							</div>
							<div class="form-group m-t-20">
								<input type="text" name="url" id="url" class="form-control" placeholder="URL">
							</div>
							<div class="form-group m-t-20">
								<input type="text" name="icon" id="icon" class="form-control" placeholder="Icon Menu">
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