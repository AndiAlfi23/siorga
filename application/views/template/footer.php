		</div>
		<footer class="footer text-center">
			Copyright &copy; <?= $app['singkatan_organisasi'] ?> <?= date("Y") ?>
			<br> v.2.0
		</footer>
		</div>
		</div>

		<script src="<?= base_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
		<script src="<?= base_url() ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="<?= base_url() ?>assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
		<script src="<?= base_url() ?>assets/extra-libs/sparkline/sparkline.js"></script>
		<script src="<?= base_url() ?>dist/js/waves.js"></script>
		<script src="<?= base_url() ?>dist/js/sidebarmenu.js"></script>

		<?php if (($this->uri->segment('2') == null) || ($this->uri->segment('2') == 'index')) { ?>

			<script src="<?= base_url() ?>assets/extra-libs/raphael/raphael.min.js"></script>
			<script src="<?= base_url() ?>assets/extra-libs/morris.js/morris.min.js"></script>
			<script>
				function init_morris_charts() {
					if (typeof(Morris) === 'undefined') {
						return;
					}
					console.log('init_morris_charts');
					if ($('#graph_line').length) {
						Morris.Line({
							element: 'graph_line',
							xkey: 'per',
							ykeys: ['pm', 'pk'],
							labels: ['Pemasukkan', 'Pengeluaran'],
							hideHover: 'auto',
							lineColors: ['green', 'red', '#ACADAC', '#3498DB'],
							data: [
								<?php $n1 = 0;
								foreach ($pm as $p1) {
									if ($n1 != '0') {
										echo ",";
									}
									$pk = $this->mydb->bar_pk($p1['tgl']);
									if ($pk['total_pk'] != null) {
										$tampil = $pk['total_pk'];
									} else {
										$tampil = "0";
									}

								?> {
										per: '<?= $p1['tgl']; ?>',
										pm: <?= $p1['total']; ?>,
										pk: <?= $tampil ?>
									}
								<?php $n1++;
								} ?>
							],
							resize: true
						});

						$MENU_TOGGLE.on('click', function() {
							$(window).resize();
						});

					}
				};
				$(document).ready(function() {
					init_morris_charts();
				});
			</script>
		<?php } ?>
		<script src="<?= base_url() ?>dist/js/custom.min.js"></script>

		<?php if ($this->uri->segment('2') == 's_tg') { ?>
			<script src="<?= base_url() ?>assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
			<script src="<?= base_url() ?>assets/extra-libs/multicheck/jquery.multicheck.js"></script>
		<?php } ?>

		<script src="<?= base_url() ?>assets/extra-libs/DataTables/datatables.min.js"></script>

		<script>
			$('#zero_config').DataTable();
			$('.custom-file-input').on('change', function() {
				let fileName = $(this).val().split('\\').pop();
				$(this).next('.custom-file-label').addClass("selected").html(fileName);
			});
			<?php if ($this->session->userdata('role_id') == '1') { ?>
				$('.form-check-input').on('click', function() {
					const menuId = $(this).data('menu');
					const roleId = $(this).data('role');
					$.ajax({
						url: "<?= base_url('Admin/changeaccess'); ?>",
						type: 'post',
						data: {
							menuId: menuId,
							roleId: roleId
						},
						success: function() {
							document.location.href = "<?= base_url('Admin/roleaccess/'); ?>" + roleId;
						}
					});
				});
			<?php } ?>
		</script>

		</body>

		</html>