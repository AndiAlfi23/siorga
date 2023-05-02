<div class="row">
    <div class="col-md-6">
        <div class="card">
            <form class="form-horizontal" action="<?= base_url("Anggota/p_e_jabatan/" . $anggota['npm']) ?>" method="POST">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="nm" class="col-sm-3 text-left control-label col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" id="nm" class="form-control" value="<?= $anggota['nama'] ?>" disabled />
                            <input type="hidden" name="id_mhs" value="<?= $anggota['id_mhs'] ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jabatan" class="col-sm-3 text-left control-label col-form-label">Jabatan</label>
                        <div class="col-sm-9">
                            <select name="jabatan" id="jabatan" class="form-control">
                                <option value="<?= $anggota['id_jabatan'] ?>" hidden> <?= $anggota['nama_jabatan'] ?></option>
                                <?php foreach ($role as $r) { ?>
                                    <option value="<?= $r['id_jabatan'] ?>"><?= $r['nama_jabatan']; ?></option>
                                <?php } ?>
                            </select>
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