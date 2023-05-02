    <div class="row">
        <div class="col-sm-12">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <h4>Aplikasi</h4>
                </div>
                <div class="card-body">
                    <form action="<?= base_url("Admin/settings") ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="fnama" class="col-sm-4 control-label col-form-label">Nama Organisasi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="fnama" name="fnama" value="<?= $orga['nama_organisasi'] ?>">
                                <?= form_error('fnama', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="snk" class="col-sm-4 control-label col-form-label">Singkatan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="snk" name="snk" value="<?= $orga['singkatan_organisasi'] ?>">
                                <?= form_error('snk', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="logo" class="col-sm-4 control-label col-form-label">Logo Organisasi</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="<?= base_url('assets/logo/') . $orga['logo_organisasi']; ?>" class="img-thumbnail">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="logo" name="logo">
                                            <label class="custom-file-label" for="logo">Choose file...</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="img_tb" class="col-sm-4 control-label col-form-label">Logo Topbar</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="<?= base_url('assets/images/') . $orga['img_topbar']; ?>" class="img-thumbnail">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="img_tb" name="img_tb">
                                            <label class="custom-file-label" for="img_tb">Choose file...</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center border-top pt-3">
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <h4>Data</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Data</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">--</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($tbl as $t) {
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no; ?>.</td>
                                    <td><?= $t['table_name'] ?></td>
                                    <td class="text-center">
                                        <?php
                                        $jml = $this->db->query('select count(' . $t['primary'] . ') as jml from ' . $t['table_name'])->row_array();
                                        if ($jml['jml'] > 0) {
                                            echo $jml['jml'];
                                        } else {
                                            echo "Kosong";
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        if ($jml['jml'] > 0) {
                                            $name = $t['table_name'];
                                            $tombol = '<a href="' . base_url('Admin/truncate/' . $name) . '" class="btn btn-danger btn-sm">Kosongkan</a>';
                                            $lock = '<i class="mdi mdi-lock"></i>';
                                            if (
                                                $name == 't_history' || $name == 't_pengeluaran' || $name == 't_pembayaran' ||
                                                $name == 't_cash_rule' || $name == 't_absen'
                                            ) {
                                                echo $tombol;
                                            } else if ($name == 't_kegiatan') {
                                                $cek_absen = $this->db->query('select count(no_absen) as jml from t_absen')->row_array();
                                                if ($cek_absen['jml'] == '0') {
                                                    echo $tombol;
                                                } else {
                                                    echo $lock;
                                                }
                                            } elseif ($name == 't_tagihan_anggota') {
                                                $cek_pb = $this->db->query('select count(no_pb) as jml from t_pembayaran')->row_array();
                                                if ($cek_pb['jml'] == '0') {
                                                    echo $tombol;
                                                } else {
                                                    echo $lock;
                                                }
                                            } elseif ($name == 't_tagihan') {
                                                $cek_ta = $this->db->query('select count(no_ta) as jml from t_tagihan_anggota')->row_array();
                                                if ($cek_ta['jml'] == '0') {
                                                    echo $tombol;
                                                } else {
                                                    echo $lock;
                                                }
                                            } else {
                                                echo $lock;
                                            }
                                        } else {
                                            echo $lock;
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php $no++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php
    $ah = $this->db->query('SELECT a.*, nama_jabatan FROM t_anggota a, t_jabatan b 
    WHERE a.id_jabatan = b.id_jabatan AND a.level=0 ')->result_array();
    if ($ah) :
    ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-dark text-light">
                        <h4>Data anggota yang dihapus</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" cellspacing="0" id="zero_config">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NPM</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Hadir</th>
                                        <th>Tidak Hadir</th>
                                        <th>--</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no2 = 1;
                                    foreach ($ah as $a) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no2; ?></td>
                                            <td><?= $a['npm'] ?></td>
                                            <td><?= $a['nama'] ?></td>
                                            <td><?= $a['nama_jabatan'] ?></td>
                                            <td class="text-center">
                                                <?php
                                                $query = 'SELECT count(id_mhs) as jml FROM t_absen WHERE id_mhs="' . $a['id_mhs'] . '" AND';
                                                $a1 = $this->db->query($query . ' status="Hadir"')->row_array();
                                                if ($a1['jml'] > 0) {
                                                    echo $a1['jml'] . ' Kagiatan';
                                                } else {
                                                    echo "-";
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                $a2 = $this->db->query($query . ' status!="Hadir"')->row_array();
                                                if ($a2['jml'] > 0) {
                                                    echo $a2['jml'] . ' Kegiatan';
                                                } else {
                                                    echo "-";
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url('admin/e_lvl/' . $a['npm']) ?>" class="btn btn-success" alt="Kembalikan"><i class="mdi mdi-rotate-left"></i></a>
                                                <a href="<?= base_url('admin/del_user/' . $a['id_mhs']) ?>" class="btn btn-danger" onclick="return confirm('Apa kamu yakin ingin menghapus data ini?')"><i class="mdi mdi-delete"></i> </a>
                                            </td>
                                        </tr>
                                    <?php $no2++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    <?php endif; ?>