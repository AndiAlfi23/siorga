        <div class="row">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <?= $this->session->flashdata('message'); ?>
                <div class="card">
                    <?php
                    $lvl = $this->session->userdata('role_id');
                    foreach ($kegiatan as $k) {
                    ?>
                        <div class="card-header bg-dark text-white text-justify">
                            <h4><?= $k['nama_kegiatan'] ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php
                                if ($UA->num_rows() > 0) {
                                    $total_absen = $total['total'] + $total_no_hadir['total'];
                                    $total_anggota = $jml['jmlAnggota'];
                                    if ($total_absen < $total_anggota) {

                                        echo '<a href="' . base_url("Kegiatan/absensi/" . $k['no_kegiatan']) . '" class="btn btn-primary mb-3">Proses Absensi</a>';

                                        $on = '0';
                                        if ($on == '1') {
                                            echo '<a href="' . base_url("Kegiatan/scan/" . $k['no_kegiatan']) . '" class="btn btn-success mb-3">Scan QR-Code</a>';
                                        }
                                    }
                                }
                                ?>
                                <p>Tanggal : <?= $k['tgl_kegiatan'] ?></p>
                                <p>Total Kehadiran : <?= $total['total']; ?></p>
                                <table class="table table-bordered">
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($hadir as $r) : ?>
                                            <tr>
                                                <td class="text-center"><?= $i . '.'; ?></td>
                                                <td class="text-center"><?= $r['npm'] ?></td>
                                                <td><?= $r['nama'] ?></td>
                                                <?php if ($UA->num_rows() > 0) { ?>
                                                    <td class="text-center">
                                                        <a href="<?= base_url("Kegiatan/e_absen/" . $k['no_kegiatan'] . '/' . $r['id_mhs']) ?>" class="btn btn-info">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <a href="<?= base_url("Kegiatan/del_absen/" . $k['no_kegiatan'] . '/' . $r['id_mhs']) ?>" class="btn btn-danger">
                                                            <i class="mdi mdi-delete"></i>
                                                        </a>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php $i++;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                                <br>
                                <?php if ($total_no_hadir['total'] != '0') { ?>
                                    <p>Tidak hadir : <?= $total_no_hadir['total']; ?></p>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <?php foreach ($no_hadir as $n) : ?>
                                                <tr>
                                                    <td style="padding:10px;"><?= $n['nama'] ?></td>
                                                    <td style="padding:10px;align:center;"><?= $n['status'] ?></td>
                                                    <?php if ($UA->num_rows() > 0) { ?>
                                                        <td class="text-center">
                                                            <a href="<?= base_url("Kegiatan/e_absen/" . $k['no_kegiatan'] . '/' . $n['id_mhs']) ?>" class="btn btn-info">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                            <a href="<?= base_url("Kegiatan/del_absen/" . $k['no_kegiatan'] . '/' . $n['id_mhs']) ?>" class="btn btn-danger">
                                                                <i class="mdi mdi-delete"></i>
                                                            </a>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </div>
                        </div>
                        <?php if ($UA->num_rows() > 0) { ?>
                            <div class="card-footer bg-dark text-white text-right">
                                <a href="<?= base_url("Kegiatan/e_kegiatan/" . $k['no_kegiatan']) ?>" class="btn btn-info">
                                    <i class="mdi mdi-pencil"></i> Edit Kegiatan
                                </a>
                                <a href="<?= base_url("Kegiatan/del/" . $k['no_kegiatan']) ?>" class="btn btn-danger">
                                    <i class="mdi mdi-delete"></i> Hapus Kegiatan
                                </a>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>