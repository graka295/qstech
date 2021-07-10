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
    <script src="<?= base_url(); ?>assets/custom/vendor/qrcode/jquery.classyqr.min.js"></script>
    <script src="<?= base_url(); ?>assets/custom/vendor/jquery-validation-master/jquery.validate.js"></script>
    <script src="<?= base_url(); ?>assets/custom/vendor/sweetalert2/sweetalert2@10.js"></script>
    <script src="<?= base_url(); ?>assets/custom/vendor/iziToast/iziToast.min.js"></script>
    <script src="<?= base_url(); ?>assets/custom/vendor/datatable/datatables.min.js"></script>
    <script src="<?= base_url(); ?>assets/custom/vendor/dropify/dropify.min.js"></script>
    <script src="<?= base_url(); ?>assets/custom/vendor/bootstrap4-toggle/bootstrap4-toggle.min.js"></script>
    <script src="<?= base_url(); ?>/assets/custom/vendor/cropper.min/cropper.min.js"></script>
    <script src="<?= base_url(); ?>assets/custom/js/custom.js"></script>
    <script>
        var messageCount = <?= $messageCount ?>;
        $(document).ready(function() {
            var url = window.location + "";
            var path = url.replace(window.location.protocol + "//" + window.location.host + "/", "");
            var element = $('ul.menu a').filter(function() {
                return url.includes(this.href) || path.includes(this.href); // || url.href.indexOf(this.href) === 0;
            });
            // document.querySelector('.sidebar-item.active').scrollIntoView(false)
            $(element[0]).parentsUntil(".menu").each(function(index) {
                if ($(this).is("li")) {
                    $(this).addClass("active")
                }
                if ($(this).is("ul")) {
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
            $('#myDropdown').on('hide.bs.dropdown', function() {
                $(".not-read-message").remove();
                messageCount = 0;
            })
            $('#myDropdown').on('show.bs.dropdown', function() {
                $.ajax({
                    // data: data,
                    url: '<?= site_url("admin/dashboard/readAllMessage") ?>',
                    type: "POST",
                    dataType: 'json',
                    success: function(e) {
                        // if (!e.success) {
                        //     swal.close();
                        //     e.message.map(function(ex) {
                        //         iziToast.warning({
                        //             title: 'Info',
                        //             message: ex,
                        //             position: 'topRight'
                        //         });
                        //     })
                        // } else {
                        $("#badgeCount").remove();
                        // }
                    },
                    beforeSend: function() {},
                    error: function(e) {
                        // iziToast.error({
                        //     title: 'Warning',
                        //     message: "Bad Request",
                        //     position: 'topRight'
                        // });
                    }
                });
            })
        })
    </script>
    <style>
        .sidebar-wrapper .sidebar-header img {
            height: 4.2rem;
            padding-left: 13px;
        }

        .dropdown-menu {
            max-height: 280px;
            overflow-y: auto;
        }
    </style>
</body>
<!-- Insert these scripts at the bottom of the HTML, but before you use any Firebase services -->

<!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>

<!-- If you enabled Analytics in your project, add the Firebase SDK for Analytics -->
<script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-analytics.js"></script>

<!-- Add Firebase products that you want to use -->
<script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-firestore.js"></script>
<script>
    // Initialize Firebase
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional    
    const firebaseConfig = {
        apiKey: "AIzaSyAZseQFJlNanx2Onq6BIn8dnNijQqPUAoo",
        authDomain: "qstech-7fe08.firebaseapp.com",
        projectId: "qstech-7fe08",
        storageBucket: "qstech-7fe08.appspot.com",
        messagingSenderId: "79164655702",
        appId: "1:79164655702:web:89523210aa08af9c6c93f7",
        measurementId: "G-GYELT24XB9"
    };
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    messaging.getToken({
        vapidKey: 'BHM7uXt7LM25OlJcV7Whb8MMgdLvARaaYz6jFmWUu4MU-2gi-K9K-DLiyeWtcnaj4tJH3QL74ztv0zcpVxgM6lI'
    }).then((currentToken) => {
        if (currentToken) {
            console.log(currentToken)
            $.ajax({
                data: {
                    token: currentToken,
                },
                url: '<?= site_url("admin/dashboard/saveToken") ?>',
                type: "POST",
                dataType: 'json',
                success: function(e) {},
                beforeSend: function() {},
                error: function(e) {}
            });
            // Send the token to your server and update the UI if necessary
            messaging.onMessage(function(payLoad) {
                console.log("Message Received");
                console.log(payLoad);
                notificationTitle = payLoad.notification.title;
                notificationOptions = {
                    body: payLoad.notification.body,
                    // icon: payLoad.notification.icon,
                };
                messageCount += 1
                if (messageCount == 1) {
                    $("#divbadgeCount").append('<span class="badge bg-primary" id="badgeCount">' + messageCount + '</span>');
                } else {
                    $("#divbadgeCount").html('<span class="badge bg-primary" id="badgeCount">' + messageCount + '</span>');
                }
                var notif = ' <li>' +
                    '<a href="<?= site_url('/admin/dashboard') ?>" class="dropdown-item">' +
                    '<div>' +
                    '<h6><span class="text-danger not-read-message">* </span>' + payLoad.notification.body + '</h6>' +
                    '<p class="text-subtitle text-muted">' +
                    payLoad.data.time +
                    '</p>' +
                    '</div>' +
                    '</a>' +
                    '</li>'
                $("#list-notif").prepend(notif)
                var notification = new Notification(notificationTitle, notificationOptions);
            });
            // ...
        } else {
            // Show permission request UI
            console.log('No registration token available. Request permission to generate one.');
            // ...
        }
    }).catch((err) => {
        console.log('An error occurred while retrieving token. ', err);
        // ...
    });
</script>

</html>