                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <form class="form-horizontal" method="POST" action="<?= base_url("Admin/e_lvl/" . $anggota['npm']) ?>">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="nm" class="col-sm-3 text-left control-label col-form-label">Nama</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="nm" class="form-control" value="<?= $anggota['nama'] ?>" disabled />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nj" class="col-sm-3 text-left control-label col-form-label">Jabatan</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="nj" class="form-control" value="<?= $anggota['nama_jabatan'] ?>" disabled />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="level" class="col-sm-3 text-left control-label col-form-label">Level</label>
                                        <div class="col-sm-9">
                                            <select name="level" id="level" class="form-control">
                                                <option value="<?= $anggota['level'] ?>"> <?= $anggota['level'] ?></option>
                                                <?php foreach ($role as $r) { ?>
                                                    <option value="<?= $r['level'] ?>"><?= $r['level'] . ' | ' . $r['role'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <?= form_error('level', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
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