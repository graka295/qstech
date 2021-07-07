<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>CHANGE PASSWORD</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/user/profile') ?>">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <section class="row">
        <div class="container-fluid">
            <div class="ecommerce-widget">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">INPUT PASSWORD</h4>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <form class="form-horizontal" method="POST" id="form-update" action="<?= site_url("admin/user/doChangePassword") ?>" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label class="form-control-label"><?= $this->lang->line("label_current_password") ?></label>
                                                <input maxlength="30" type="password" name="current_password" id="current_password" class="form-control frm" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label class="form-control-label"><?= $this->lang->line("label_new_password") ?></label>
                                                <input maxlength="30" type="password" name="new_password" id="new_password" class="form-control frm" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label class="form-control-label"><?= $this->lang->line("label_confirm_password") ?></label>
                                                <input maxlength="30" type="password" name="confirm_password" id="confirm_password" class="form-control frm" placeholder="">
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <div class="border-top pl-1 pt-3 text-right">
                                                <button type="submit" class="btn btn-secondary frm"><?= $this->lang->line("label_submit") ?></button>
                                                <a href="<?= site_url("admin/user/profile") ?>" class="btn btn-danger frm"><?= $this->lang->line("label_cancel") ?></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready(function() {
        $("#form-update").validate({
            rules: {
                current_password: {
                    required: true,
                },
                new_password: {
                    required: true,
                    minlength: 5,
                },
                confirm_password: {
                    equalTo: "#new_password"
                },
            },
            submitHandler: function(form) {
                if ($("#form-update").hasClass("success")) {
                    return true;
                } else {
                    var data = {
                        current_password: $("#current_password").val(),
                        new_password: $("#new_password").val(),
                        confirm_password: $("#confirm_password").val(),
                        id: <?= $user["id"] ?>,
                    }
                    validate(data, '<?= site_url("admin/user/validate-change-password") ?>', "#form-update")
                }
            },
        });
    })
</script>