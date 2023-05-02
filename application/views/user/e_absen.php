                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <form class="form-horizontal" method="POST" action="<?= base_url("Kegiatan/p_e_absen/" . $k['no_kegiatan'] . "/" . $k['id_mhs'])  ?>">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="nama" class="col-sm-3 text-left control-label col-form-label">Nama</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nama" id="nama" value="<?= $k['nama'] ?>" disabled>
                                            <input type="text" name="id" value="<?= $k['id_mhs'] ?>" style="display:none">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="status" class="col-sm-3 text-left control-label col-form-label">Status</label>
                                        <div class="col-sm-9">
                                            <select name="status" id="status" class="form-control">
                                                <option value="<?= $k['status'] ?>" hidden><?= $k['status'] ?></option>
                                                <option value="Hadir">Hadir</option>
                                                <option value="Sakit">Sakit</option>
                                                <option value="Izin">Izin</option>
                                                <option value="Alfa">Alfa</option>
                                            </select>
                                            <?= form_error('status', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                                        </div>
                                    </div>
                                    <div class=" form-group row">
                                        <div class="col-sm-12 text-center">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>