        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <?= $this->session->flashdata('message'); ?>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-12">
                <div class="card mb-3">
                    <div class="card-header bg-dark text-white text-center">
                        <img src="<?= base_url() ?>assets/images/users/<?= $t_user['picture'] ?>" width="150px" height="auto" class="mb-2" />
                        <h4 class="card-title"><?= $t_user['nama_jabatan'] ?></h4>
                    </div>
                    <div class="card-body">
                        <?php
                        $lvl = $this->session->userdata('role_id');
                        if ($lvl == '1') {
                            $name = '[Lvl.' . $t_user['level'] . '] ' . $t_user['nama'];
                        } else {
                            $name = $t_user['nama'];
                        }
                        ?>
                        <h5 class="card-title"><?= $name; ?></h5>
                        <h5 class="card-title">NPM : <?= $t_user['npm'] ?></h5>
                        <p class="card-text">
                            <i class="mdi mdi-account-location"></i> <?= $t_user['alamat'] ?></br>
                            <i class="mdi mdi-gmail"></i> <?= $t_user['email'] ?></br>
                            <i class="mdi mdi-whatsapp"></i> <?= $t_user['telp'] ?>
                        </p>
                        <h6>Kehadiran :
                            <?php
                            $tH = $tHadir['total_hadir'];
                            $tA = $tAbsen['total_absen'];
                            echo $tH . ' / ' . $tA, ' kegiatan';
                            ?>
                        </h6>
                        <hr>
                        <?php if ($UA1->num_rows() > 0) { ?>
                            <div class="col text-right mb-3">
                                <a href="<?= base_url("Admin/e_lvl/" . $t_user['npm']) ?>" class="btn btn-info">Edit Level</a>
                            </div>
                        <?php }
                        if ($UA2->num_rows() > 0) { ?>
                            <div class="col text-right">
                                <a href="<?= base_url("Anggota/e_jabatan/" . $t_user['npm']) ?>" class="btn btn-info">Ganti Jabatan</a>

                                <a href="<?= base_url("Anggota/del/" . $t_user['npm']) ?>" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus Anggota</a>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="card-footer bg-dark text-white text-right">
                        <p class="card-text"><small>Update At : <?= $t_user['update_at']; ?></small></p>
                        <p class="card-text"><small>Created At : <?= $t_user['created_at']; ?></small></p>
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