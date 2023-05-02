<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="HMIF Management">
    <meta name="author" content="Radheya">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/images/hmif.png">
    <title><?= $title ?></title>

    <?php if ($this->uri->segment('1') == 'Bendahara') { ?>
        <link href="<?= base_url() ?>assets/extra-libs/multicheck/multicheck.css" rel="stylesheet" type="text/css">
    <?php } ?>
    <link href="<?= base_url() ?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="<?= base_url() ?>dist/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper">
        <?php
        $this->load->view('template/topbar');
        $this->load->view('template/sidebar');
        ?>
        <div class="page-wrapper">
            <?php if ($title != 'Dashboard') { ?>
                <div class="page-breadcrumb">
                    <div class="row">
                        <div class="col-12 d-flex no-block align-items-center">
                            <h4 class="page-title"><?= $title ?></h4>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="container-fluid">