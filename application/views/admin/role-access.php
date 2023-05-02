		<div class="row">
			<div class="col-lg-6">
				<?= $this->session->flashdata('message'); ?>
				<div class="card">
					<div class="card-header bg-dark text-white">
						<h5>Role Access : <?= $role['role'] ?></h5>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="zero_config" class="table table-bordered" cellspacing="0">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Controller</th>
										<th scope="col">Access</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1;
									foreach ($tmenu as $m) : ?>
										<tr>
											<th scope="row" class="text-center"><?= $i ?></th>
											<td><?= $m['menu'] ?></td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="checkbox" value="" <?= check_access($role['level'], $m['id_menu']) ?> data-role="<?= $role['level'] ?>" data-menu="<?= $m['id_menu'] ?>">
												</div>
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