<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QS Tech</title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>assets/custom/admin/img/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url("assets/admin/") ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url("assets/admin/") ?>assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url("assets/admin/") ?>assets/css/app.css">
    <link rel="stylesheet" href="<?= base_url("assets/admin/") ?>assets/css/pages/auth.css">
    <link href="<?= base_url(); ?>assets/custom/css/custom.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/custom/vendor/iziToast/iziToast.css" rel="stylesheet">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a class="logo" href="<?= base_url(); ?>"><img src="<?= base_url(); ?>assets/custom/admin/img/logo_1.png" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Log in.</h1>

                    <form class="form-horizontal m-t-20" id="login-form" method="POST" action="<?= site_url("admin/auth/login") ?>">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input name="email" id="email" type="email" maxlength="40" class="form-control form-control-xl" placeholder="<?= $this->lang->line('form_email_address') ?>" aria-label="Username" aria-describedby="basic-addon1" required="">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input name="password" id="password" type="password" maxlength="30" class="form-control form-control-xl" placeholder="<?= $this->lang->line('form_password') ?>" aria-label="Password" aria-describedby="basic-addon1" required="">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p><a class="font-bold" href="<?= site_url("/admin/forgot-password")?>">Forgot password?</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url("assets/admin/") ?>assets/vendors/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/custom/vendor/jquery-validation-master/jquery.validate.js"></script>
    <script src="<?= base_url(); ?>assets/custom/vendor/sweetalert2/sweetalert2@10.js"></script>
    <script src="<?= base_url(); ?>assets/custom/vendor/iziToast/iziToast.min.js"></script>
    <script src="<?= base_url(); ?>assets/custom/js/custom.js"></script>
    <style>
        .invalid-feedback {
            color: #dc3545;
            display: none;
            font-size: .875em;
            margin-top: .25rem;
            width: 100%;
            position: absolute;
        }

        #auth #auth-left .auth-logo {
            margin-bottom: 1rem;
        }

        #auth #auth-left .auth-logo img {
            height: 5rem;
        }
    </style>
    <script>
        $(document).ready(function() {
            $("#login-form").validate({
                rules: {
                    email: {
                        email: true,
                        maxlength: 40,
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                },
                submitHandler: function(form) {
                    if ($("#login-form").hasClass("success")) {
                        return true;
                    } else {
                        var data = {
                            email: $("#email").val(),
                            password: $("#password").val(),
                        }
                        validate(data, '<?= site_url("admin/auth/validate") ?>', "#login-form")
                    }
                },
            });
        });
    </script>
</body>

</html>