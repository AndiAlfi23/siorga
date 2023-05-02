        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <?= $this->session->flashdata('message'); ?>
                <div class="card">
                    <div class="card-body">
                        <?php if ($UA->num_rows() > 0) { ?>
                            <div class="mb-3">
                                <a href="<?= base_url('Kegiatan') ?>" class="btn btn-primary">
                                    <i class="mdi mdi-calendar-plus"></i> Tambah Kegiatan</a>
                            </div>
                        <?php } ?>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-bordered table-hover" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Agenda Kegiatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($kegiatan as $r) : ?>
                                        <tr>
                                            <th class="text-center" scope="row"><?= $i ?>.</th>
                                            <td class="text-center"><?= $r['tgl_kegiatan'] ?></td>
                                            <td><a href="<?= base_url("Member/detail_kegiatan/" . $r['no_kegiatan']) ?>"><?= $r['nama_kegiatan'] ?></a></td>
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