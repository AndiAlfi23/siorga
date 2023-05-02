		<aside class="left-sidebar" data-sidebarbg="skin5">
			<div class="scroll-sidebar">
				<nav class="sidebar-nav">
					<ul id="sidebarnav" class="p-t-0">
						<?php
						$lvl = $this->session->userdata('role_id');
						$qMenu = "SELECT * FROM t_menu_access WHERE level = '" . $lvl . "' ORDER BY id_menu ASC";
						$menu = $this->db->query($qMenu)->result_array();
						foreach ($menu as $m) {
							$menuId = $m['id_menu'];
							$qSubMenu = "SELECT * FROM t_sub_menu WHERE id_menu = '" . $menuId . "' AND is_active = '1'";
							$subMenu = $this->db->query($qSubMenu)->result_array();
							foreach ($subMenu as $sm) {
								if ($lvl == '1') {
									if (($sm['icon'] != 'mdi mdi-home')) {
						?>
										<li class="sidebar-item">
											<a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url($sm['url']) ?>">
												<i class="<?= $sm['icon'] ?>"></i><span class="hide-menu"><?= $sm['title'] ?></span>
											</a>
										</li>
									<?php
									}
								} else {
									?>
									<li class="sidebar-item">
										<a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url($sm['url']) ?>">
											<i class="<?= $sm['icon'] ?>"></i><span class="hide-menu"><?= $sm['title'] ?></span>
										</a>
									</li>
						<?php
								}
							}
						}
						?>
					</ul>
				</nav>
			</div>
		</aside>