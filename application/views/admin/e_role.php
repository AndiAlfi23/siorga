                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <form class="form-horizontal" method="POST" action="<?= base_url("Admin/e_role/" . $role['level']) ?>">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="level" class="col-sm-3 text-left control-label col-form-label">Level</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="level" id="level" value="<?= $role['level'] ?>">
                                            <?= form_error('level', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="role" class="col-sm-3 text-left control-label col-form-label">Nama Role</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="role" id="role" value="<?= $role['role'] ?>">
                                            <?= form_error('role', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
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