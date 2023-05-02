        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <?php foreach ($kegiatan as $k) { ?>
                        <form action="<?= base_url("Kegiatan/proses_absensi") ?>" method="post">
                            <div class="card-header bg-dark text-white">
                                <h4><?= $k['nama_kegiatan'] ?></h4>
                                <h5><?= $k['tgl_kegiatan'] ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <?php $i = 1;
                                            foreach ($anggota as $r) :
                                                $cek_absen = $this->db->query("SELECT count(id_mhs) as mhs FROM t_absen WHERE id_mhs='" . $r['id_mhs'] . "' AND no_kegiatan='" . $k['no_kegiatan'] . "'")->row_array();
                                                if ($cek_absen['mhs'] != '1') {
                                            ?>
                                                    <tr>
                                                        <td><?= $r['nama'] ?></td>
                                                        <td>
                                                            <input type="text" name="mhs[]" value="<?= $r['id_mhs'] ?>" style="display:none;">
                                                            <select name="status[]" id="status" class="form-control">
                                                                <option value="Hadir">Hadir</option>
                                                                <option value="Sakit">Sakit</option>
                                                                <option value="Izin">Izin</option>
                                                                <option value="Alfa">Tanpa Keterangan</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                            <?php }
                                                $i++;
                                            endforeach; ?>
                                            <tr>
                                                <td colspan='2' class="text-center">
                                                    <input type="text" name="kegiatan" id="kegiatan" value="<?= $k['no_kegiatan'] ?>" style="display:none" />
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>