        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-12">
                <?= $this->session->flashdata('message'); ?>
                <div class="card">
                    <div class="card-body">
                        <?php if ($UA->num_rows() > 0) { ?>
                            <div class="mb-3">
                                <a href="<?= base_url('Anggota') ?>" class="btn btn-primary">
                                    <i class="mdi mdi-account-plus"></i> Tambah Anggota</a>
                            </div>
                        <?php } ?>
                        <div class="table-responsive">
                            <table id="zero_config" cellspacing="0" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">NPM</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jabatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($anggota as $r) : ?>
                                        <tr>
                                            <td class="text-center"><?= $r['npm'] ?></td>
                                            <td><a href="<?= base_url("Member/s_anggota/" . $r['npm']) ?>"><?= $r['nama'] ?></a></td>
                                            <td><?= $r['nama_jabatan'] ?></td>
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