                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <form class="form-horizontal" method="POST" action="<?= base_url("Kegiatan/e_kegiatan/" . $k['no_kegiatan']) ?>">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="tgl" class="col-sm-3 text-left control-label col-form-label">Tanggal</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="tgl" id="tgl" value="<?= $k['tgl_kegiatan'] ?>">
                                            <?= form_error('tgl', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kegiatan" class="col-sm-3 text-left control-label col-form-label">Nama Kegiatan</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="kegiatan" id="kegiatan" value="<?= $k['nama_kegiatan'] ?>">
                                            <?= form_error('kegiatan', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
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