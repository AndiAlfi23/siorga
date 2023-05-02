<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="mdi mdi-view-sequential mdi-close"></i></a>
            <a class="navbar-brand" href="<?= base_url() ?>">
                <b class="logo-icon p-l-10">
                    <img src="<?= base_url() ?>assets/images/<?= $app['img_topbar'] ?>" alt="homepage" class="light-logo " />
                </b>
                <span class="logo-text">
                    <?= $app['singkatan_organisasi'] ?>
                </span>
            </a>
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="mdi mdi-more"></i></a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <ul class="navbar-nav float-left mr-auto">
                <li class="nav-item d-none d-md-block">
                    <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-view-sequential font-24"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav float-right">
                <li class="nav-item dropdown show">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <img src="<?= base_url("assets/images/users/" . $user['picture']) ?>" alt="user" class="rounded-circle" width="31">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated">
                        <a class="dropdown-item" href="<?= base_url("Member/profile") ?>">
                            <i class="mdi mdi-account m-r-5 m-l-5"></i> My Profile</a>
                        <a class="dropdown-item" href="<?= base_url("Member/edit") ?>">
                            <i class="mdi mdi-account-edit m-r-5 m-l-5"></i> Edit Profile</a>
                        <a class="dropdown-item" href="<?= base_url("Member/changepassword") ?>">
                            <i class="mdi mdi-account-key m-r-5 m-l-5"></i> Change Password</a>
                        <div class="dropdown-divider"></div>
                        <?php
                        $setting = $this->session->userdata('role_id');
                        if ($setting == '1') {
                        ?>
                            <a class="dropdown-item" href="<?= base_url("Admin/settings") ?>">
                                <i class="mdi mdi-settings m-r-5 m-l-5"></i> Settings</a>
                            <div class="dropdown-divider"></div>
                        <?php } ?>
                        <a class="dropdown-item" href="<?= base_url('Auth/logout') ?>">
                            <i class="mdi mdi-power m-r-5 m-l-5"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>