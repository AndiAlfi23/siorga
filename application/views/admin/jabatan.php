        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= $this->session->flashdata('message'); ?>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Tambah Jabatan</a>
                            <table id="zero_config" class="table table-bordered table-hover">
                                <thead>
                                    <tr class="bg-dark text-white">
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Jabatan</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($jabatan as $r) : ?>
                                        <tr>
                                            <th class="text-center" scope="row"><?= $i ?></th>
                                            <td><?= $r['nama_jabatan'] ?></td>
                                            <td class="text-center">
                                                <a class="badge badge-pill badge-info" href="<?= base_url("Jabatan/e_jabatan/" . $r['id_jabatan']) ?>">edit</a>
                                                <a class="badge badge-pill badge-danger" href="<?= base_url("Jabatan/del_jabatan/" . $r['id_jabatan']) ?>">delete</a>
                                            </td>
                                        </tr>
                                    <?php $i++;
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Jabatan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url("Jabatan") ?>" method="post">
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label for="nm_jabatan" class="col-sm-3 text-left control-label col-form-label">Nama Jabatan</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nm_jabatan" id="nm_jabatan" value="<?= set_value('nm_jabatan') ?>" placeholder="Nama Jabatan" autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>