<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<?= $this->session->flashdata('message'); ?>
	</div>
	<div class="col-lg-4 col-md-8 col-sm-12">
		<div class="card mb-3">
			<div class="card-header bg-dark text-white text-center">
				<img src="<?= base_url() ?>assets/images/users/<?= $user['picture'] ?>" width="150px" height="auto" class="mb-2" />
				<h4 class="card-title"><?= $user['nama_jabatan'] ?></h4>
			</div>
			<div class="card-body">
				<?php
				$lvl = $this->session->userdata('role_id');
				if ($lvl == '1') {
					$name = '[Lvl.' . $user['level'] . '] ' . $user['nama'];
				} else {
					$name = $user['nama'];
				}
				?>
				<h5 class="card-title"><?= $name; ?></h5>
				<h5 class="card-title">NPM : <?= $user['npm'] ?></h5>
				<p class="card-text">
					<i class="mdi mdi-account-location"></i> <?= $user['alamat'] ?></br>
					<i class="mdi mdi-gmail"></i> <?= $user['email'] ?></br>
					<i class="mdi mdi-whatsapp"></i> <?= $user['telp'] ?>
				</p>
				<h6>Kehadiran :
					<?php
					$tH = $tHadir['total_hadir'];
					$tA = $tAbsen['total_absen'];
					echo $tH . ' / ' . $tA, ' kegiatan';
					?>
				</h6>
			</div>
			<div class="card-footer bg-dark text-white text-right">
				<p class="card-text"><small>Update At : <?= $user['update_at']; ?></small></p>
				<p class="card-text"><small>Created At : <?= $user['created_at']; ?></small></p>
			</div>
		</div>
	</div>
	<div class="col-lg-8 col-md-12 col-sm-12">
		<div class="card">
			<div class="card-header bg-dark text-white">
				<h4>Kehadiran </h4>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="zero_config" class="table table-bordered table-hover" cellspacing="0">
						<thead>
							<tr>
								<th scope="col">Tanggal</th>
								<th scope="col">Agenda Kegiatan</th>
								<th scope="col">Status</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($absen as $r) : ?>
								<tr>
									<td class="text-center"><?= $r['tgl_kegiatan'] ?></td>
									<td><a href="<?= base_url("Member/detail_kegiatan/" . $r['no_kegiatan']) ?>"><?= $r['nama_kegiatan'] ?></a></td>
									<td class="text-center"><?= $r['status'] ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>