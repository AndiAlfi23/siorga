        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= $this->session->flashdata('message'); ?>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-bordered bg-white" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Datetime</th>

                                        <?php
                                        if ($UA->num_rows() > 0) {
                                            echo '<th>Username</th>';
                                        }
                                        ?>

                                        <th>IP Address</th>
                                        <th>Browser</th>
                                        <th>Platform</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($login as $t) { ?>
                                        <tr>
                                            <td><?= $t['dt'] ?></td>

                                            <?php
                                            if ($UA->num_rows() > 0) {
                                                echo '<th>' . $t['username'] . '</th>';
                                            }
                                            ?>

                                            <td><?= $t['ip_address'] ?></td>
                                            <td><?= $t['browser'] ?></td>
                                            <td><?= $t['platform'] ?></td>
                                        </tr>
                                    <?phP } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>