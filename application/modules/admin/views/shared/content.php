<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QS Tech</title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>assets/custom/admin/img/favicon.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>assets/css/bootstrap.css">

    <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>assets/css/app.css">
    <link href="<?= base_url(); ?>assets/custom/css/custom.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/custom/vendor/iziToast/iziToast.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/custom/vendor/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/custom/vendor/dropify/dropify.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/custom/vendor/bootstrap4-toggle/bootstrap4-toggle.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/custom/vendor/cropper.min/cropper.min.css" rel="stylesheet">   
    <script src="<?= base_url("assets/admin/") ?>assets/vendors/jquery/jquery.min.js"></script>
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="<?php echo site_url("admin/dashboard") ?>"><img src="<?= base_url(); ?>assets/custom/admin/img/logo_1.png" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <?= $_side_menu; ?>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main" class='layout-navbar'>
            <?= $_top_menu; ?>
            <div id="main-content">

                <?php if ($this->session->flashdata('messageError') || $this->session->flashdata('messageSuccess')) { ?>
                    <?php if ($this->session->flashdata('messageSuccess')) { ?>
                        <div class="alert pt-3 alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('messageSuccess'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } else { ?>
                        <div class="alert pt-3 alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('messageError'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                <?php } ?>

                <?= $_content; ?>


                <footer>
                    <?= $_bottom_menu; ?>
                </footer>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/admin/') ?>assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url('assets/admin/') ?>assets/js/bootstrap.bundle.min.js"></script>

    <script src="<?= base_url('assets/admin/') ?>assets/js/main.js"></script>
    <script src="<?= base_url(); ?>assets/custom/vendor/jquery-validation-master/jquery.validate.js"></script>
    <script src="<?= base_url(); ?>assets/custom/vendor/sweetalert2/sweetalert2@10.js"></script>
    <script src="<?= base_url(); ?>assets/custom/vendor/iziToast/iziToast.min.js"></script>
    <script src="<?= base_url(); ?>assets/custom/vendor/datatable/datatables.min.js"></script>
    <script src="<?= base_url(); ?>assets/custom/vendor/dropify/dropify.min.js"></script>
    <script src="<?= base_url(); ?>assets/custom/vendor/bootstrap4-toggle/bootstrap4-toggle.min.js"></script>
    <script src="<?= base_url(); ?>/assets/custom/vendor/cropper.min/cropper.min.js"></script>
    <script src="<?= base_url(); ?>assets/custom/js/custom.js"></script>
    <script>
        $(document).ready(function() {
            var url = window.location + "";
            var path = url.replace(window.location.protocol + "//" + window.location.host + "/", "");
            var element = $('ul.menu a').filter(function() {
                return url.includes(this.href) || path.includes(this.href); // || url.href.indexOf(this.href) === 0;
            });
            // document.querySelector('.sidebar-item.active').scrollIntoView(false)
            $(element[0]).parentsUntil(".menu").each(function(index) {
                if ($(this).is("li")){
                    $(this).addClass("active")
                }
                if ($(this).is("ul")){
                    $(this).addClass("active")
                }
                // if ($(this).is("li") && $(this).children("a").length !== 0) {
                //     $(this).children("a").addClass("active");
                //     $(this).parent("ul.menu").length === 0 ?
                //         $(this).addClass("active") :
                //         $(this).addClass("selected");
                // } else if (!$(this).is("ul") && $(this).children("a").length === 0) {
                //     $(this).addClass("selected");

                // } else if ($(this).is("ul")) {
                //     $(this).addClass('in');
                // }
            });
            element.addClass("active");
            $('.dropify').dropify();
            $("#btn-logout").click(function() {
                Swal.fire({
                    title: "<?= $this->lang->line("label_confirm_logout"); ?>",
                    showCancelButton: true,
                    confirmButtonText: "<?= $this->lang->line("label_logout"); ?>",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.replace("<?= site_url("/admin/auth/logout") ?>");
                    }
                })
            })
        })
    </script>
    <style>
        .sidebar-wrapper .sidebar-header img {
            height: 4.2rem;
            padding-left: 13px;
        }
    </style>
</body>

</html>