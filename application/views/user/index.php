        <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-12">
                <div class="card-hover m-b-15 text-center">
                    <img src="<?= base_url("assets/logo/" . $app['logo_organisasi']) ?>" width="146px" />
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-hover">
                    <div class="card-body">
                        <h5>Kas <?= $app['singkatan_organisasi'] ?></h5>
                        <hr>
                        <?php
                        $pm = $this->db->query("select sum(nominal_bayar) as total_pm from t_pembayaran")->row_array();
                        $pk = $this->db->query("select sum(jml_pk) as total_pk from t_pengeluaran")->row_array();
                        $sisa = $pm['total_pm'] - $pk['total_pk'];
                        echo "Pemasukkan : <b>Rp " . number_format($pm['total_pm']) . "</b></br>";
                        echo "Pengeluaran : <b>Rp " . number_format($pk['total_pk']) . "</b></br>";
                        echo "Uang Kas (sekarang) : <b>Rp " . number_format($sisa) . "</b>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-5 col-sm-12">
                <div class="card card-hover">
                    <div class="card-body">
                        <h5>Peraturan Keuangan</h5>
                        <?php foreach ($cr as $r) : ?>
                            - <?= $r['cash_rule'] ?></br>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($UA->num_rows() > 0) { ?>
            <div class="row">
                <div class="col-12">
                    <h4>Tagihan Anggota</h4>
                </div>
            </div>
            <div class="row">
                <?php foreach ($nggk as $g) : ?>
                    <div class="col-lg-4">
                        <div class="card card-hover">
                            <div class="card-body">
                                <h4 class="card-title text-danger"><b>Rp <?= number_format($g['sisa']) ?></h4>
                                <h5 class="card-title"><?= $g['nm'] ?></b></h5>
                                <p>
                                <table class="table">
                                    <?php
                                    $ta = $this->db->query("select a.*, nama_tagihan,jml_tagihan from t_tagihan_anggota a, t_tagihan b
                                    where a.no_tg = b.no_tg
                                    AND dibayar!=jml_tagihan
                                    and id_mhs='" . $g['id'] . "'")->result_array();
                                    foreach ($ta as $at) {
                                        $sisa = $at['jml_tagihan'] - $at['dibayar'];
                                    ?>
                                        <tr>
                                            <td><?= $at['nama_tagihan'] ?></td>
                                            <td>Rp <?= number_format($sisa); ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="col-12 text-center m-b-10">
                    <a href="<?= base_url("Bendahara/tagihan") ?>" class="btn btn-dark">Tagihan Lainnya</a>
                </div>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Grafik Keuangan</h5>
                        <div id="graph_line" style="width:100%; height:280px;"></div>
                    </div>
                </div>
            </div>
        </div>