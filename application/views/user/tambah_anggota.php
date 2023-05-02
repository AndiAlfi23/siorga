                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <form class="form-horizontal" method="POST" action="<?= base_url("Anggota") ?>">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="npm" class="col-sm-3 text-left control-label col-form-label">NPM</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="npm" id="npm" value="<?= set_value('npm') ?>" placeholder="NPM" autofocus>
                                            <?= form_error('npm', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fnama" class="col-sm-3 text-left control-label col-form-label">Nama Lengkap</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="fnama" name="fnama" value="<?= set_value('fnama') ?>" placeholder="Nama Lengkap">
                                            <?= form_error('fnama', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jabatan" class="col-sm-3 text-left control-label col-form-label">Jabatan</label>
                                        <div class="col-sm-9">
                                            <select name="jabatan" id="jabatan" class="form-control custom-select" style="width: 100%; height:36px;">
                                                <option value=""></option>
                                                <?php foreach ($jabatan as $j) : ?>
                                                    <option value="<?= $j['id_jabatan'] ?>"><?= $j['nama_jabatan'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?= form_error('jabatan', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
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