<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QS Tech</title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>assets/custom/admin/img/favicon.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/admin/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/admin/assets/css/app.css">
    <link href="<?= base_url(); ?>assets/custom/vendor/iziToast/iziToast.css" rel="stylesheet">
    <script src="<?= base_url("assets/admin/") ?>assets/vendors/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/admin/') ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/custom/vendor/iziToast/iziToast.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-light">
        <div class="container d-block">
            <a class="navbar-brand ms-4" href="index.html">
                <img src="<?= base_url() ?>/assets/custom/admin/img/logo_1.png" style="height: 4.5rem">
            </a>
        </div>
    </nav>


    <div class="container">
        <div class="row">
            <div class="col-md-10 col-sm-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4 class="card-title">DAFTAR MEJA</h4>
                    </div>
                    <div class="card-body">
                        <!-- table hover -->
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>NAME</th>
                                        <th>Desc</th>
                                        <th>KONDISI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dataTable as $val) { ?>
                                        <tr>
                                            <td><?= $val['name'] ?></td>
                                            <td><?= $val['description'] ?></td>
                                            <td><?php if ($val['table_order'] > 0) { ?>
                                                    <span class="badge bg-danger">Terisi</span>
                                                <?php } else { ?>
                                                    <span class="badge bg-success">Kosong</span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url(); ?>assets/custom/vendor/jquery-validation-master/jquery.validate.js"></script>
    <script src="<?= base_url(); ?>assets/custom/vendor/sweetalert2/sweetalert2@10.js"></script>
    <script src="<?= base_url(); ?>assets/custom/js/custom.js"></script>
    <script></script>
</body>

</html>