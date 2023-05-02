		<div class="row">
			<?php
			$pm = $this->db->query("select sum(nominal_bayar) as total_pm from t_pembayaran")->row_array();
			$pk = $this->db->query("select sum(jml_pk) as total_pk from t_pengeluaran")->row_array();
			$sisa = $pm['total_pm'] - $pk['total_pk'];
			?>
			<div class="col-lg-3 col-md-4 col-sm-6">
				<a href="<?= base_url("Member/anggota") ?>">
					<div class="card card-hover">
						<div class="box bg-primary text-center">
							<h6 class="text-white">Jumlah Anggota</h6>
							<h1 class="font-light text-white"><i class="mdi mdi-account"></i></h1>
							<h6 class="text-white"><?= $jA['jmlAnggota'] ?> Anggota</h6>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-3 col-md-4 col-sm-6">
				<a href="<?= base_url("Member/kegiatan") ?>" alt="Kegiatan">
					<div class="card card-hover">
						<div class="box bg-warning text-center">
							<h6 class="text-white">Jumlah Kegiatan</h6>
							<h1 class="font-light text-white"><i class="mdi mdi-calendar-multiple-check"></i></h1>
							<h6 class="text-white"><?= $jK['jmlKegiatan'] ?> Kegiatan</h6>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-3 col-md-4 col-sm-6">
				<div class="card card-hover">
					<div class="box bg-success text-center">
						<h6 class="text-white">Uang yang masuk</h6>
						<h1 class="font-light text-white"><i class="mdi mdi-arrow-down-bold-circle"></i></h1>
						<h6 class="text-white">Rp <?= number_format($pm['total_pm']); ?></h6>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-4 col-sm-6">
				<a href="<?= base_url("Member/history_pk") ?>" alt="Uang Pengeluaran">
					<div class="card card-hover">
						<div class="box bg-danger text-center">
							<h6 class="text-white">Uang yang keluar</h6>
							<h1 class="font-light text-white"><i class="mdi mdi-arrow-up-bold-circle"></i></h1>
							<h6 class="text-white"> Rp <?= number_format($pk['total_pk']); ?></h6>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2 col-md-4 col-sm-6">
				<div class="card-hover m-b-15 text-center">
					<img src="<?= base_url("assets/logo/" . $app['logo_organisasi']) ?>" width="146px" />
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12">
				<div class="card">
					<div class="card-body">
						<h5>Kas <?= $app['singkatan_organisasi'] ?></h5>
						<hr>
						<?php
						$pm = $this->db->query("select sum(nominal_bayar) as total_pm from t_pembayaran")->row_array();
						$pk = $this->db->query("select sum(jml_pk) as total_pk from t_pengeluaran")->row_array();
						$sisa = $pm['total_pm'] - $pk['total_pk'];
						echo "Pemasukkan : <b>Rp " . number_format($pm['total_pm']) . "</b></br>";
						echo "Pengeluaran : <b>Rp " . number_format($pk['total_pk']) . "</b></br>";
						echo "Uang Kas (sekarang) : <b>Rp " . number_format($sisa) . "</b>";
						?>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card">
					<div class="card-body">
						<h5>Peraturan Keuangan</h5>
						<?php foreach ($cr as $r) : ?>
							- <?= $r['cash_rule'] ?></br>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Grafik Keuangan</h5>
						<div id="graph_line" style="width:100%; height:280px;"></div>
					</div>
				</div>
			</div>
		</div>