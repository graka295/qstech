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
            <div class="col-md-8 col-sm-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4 class="card-title">KRITIK DAN SARAN</h4>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" id="form-update" action="<?= site_url("admin/table/doCreate") ?>">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label class="form-control-label">Nama</label>
                                    <input maxlength="20" type="text" name="name" id="name" class="form-control frm" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label class="form-control-label">Judul</label>
                                    <input maxlength="20" type="text" name="title" id="title" class="form-control frm" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label class="form-control-label">Saran</label>
                                    <textarea id="desc" class="form-control" name="desc"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 mt-4">
                                <button type="submit" class="btn btn-success btn-block rounded-pill" id="submit">
                                    SUBMIT
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url(); ?>assets/custom/vendor/jquery-validation-master/jquery.validate.js"></script>
    <script src="<?= base_url(); ?>assets/custom/vendor/sweetalert2/sweetalert2@10.js"></script>
    <script src="<?= base_url(); ?>assets/custom/js/custom.js"></script>
    <script>
        $(document).ready(function() {
            $("#form-update").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    title: {
                        required: true,
                    },
                    desc: {
                        required: true,
                    },
                },
                submitHandler: function(form) {
                    $.ajax({
                        data: {
                            name: $("#name").val(),
                            title: $("#title").val(),
                            desc: $("#desc").val(),
                        },
                        url: '<?= site_url("frontend/suggestions/doSuggestions") ?>',
                        type: "POST",
                        dataType: 'json',
                        success: function(e) {
                            if (!e.success) {
                                swal.close();
                                console.log(e)
                                e.message.map(function(ex) {
                                    iziToast.warning({
                                        title: 'Info',
                                        message: ex,
                                        position: 'topRight'
                                    });
                                })
                            } else {
                                swal.close();
                                location.reload();
                            }
                        },
                        beforeSend: function() {
                            showLoading();
                        },
                        error: function(e) {
                            swal.close();
                            iziToast.error({
                                title: 'Warning',
                                message: "Bad Request",
                                position: 'topRight'
                            });
                        }
                    });
                    return false
                }
            })
        })
    </script>
</body>

</html>