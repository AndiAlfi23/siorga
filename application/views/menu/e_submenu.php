                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <form class="form-horizontal" method="POST" action="<?= base_url("Admin/e_submenu/" . $subm['id_sm']) ?>">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="title" class="col-sm-3 text-left control-label col-form-label">Nama Menu</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="title" id="title" value="<?= $subm['title'] ?>" autofocus>
                                            <?= form_error('title', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="menu_id" class="col-sm-3 text-left control-label col-form-label">Controller</label>
                                        <div class="col-sm-9">
                                            <select name="menu_id" id="menu_id" class="form-control">
                                                <option value="<?= $subm['id_menu'] ?>"></option>
                                                <?php foreach ($men as $mn) { ?>
                                                    <option value="<?= $mn['id_menu'] ?>"><?= $mn['menu'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <?= form_error('menu_id', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="url" class="col-sm-3 text-left control-label col-form-label">URL</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="url" id="url" value="<?= $subm['url'] ?>">
                                            <?= form_error('url', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="icon" class="col-sm-3 text-left control-label col-form-label">Icon Menu</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="icon" id="icon" value="<?= $subm['icon'] ?>">
                                            <?= form_error('icon', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 text-center">
                                            <button type="submit" class="btn btn-primary">Ubah</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>