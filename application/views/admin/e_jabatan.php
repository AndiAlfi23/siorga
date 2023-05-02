                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <form class="form-horizontal" method="POST" action="<?= base_url("Jabatan/e_jabatan/" . $jabatan['id_jabatan']) ?>">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="nm_jabatan" class="col-sm-3 text-left control-label col-form-label">Nama Jabatan</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nm_jabatan" id="nm_jabatan" value="<?= $jabatan['nama_jabatan'] ?>" autofocus>
                                            <?= form_error('nm_jabatan', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 text-center">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>