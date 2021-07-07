<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>CHANGE PROFILE</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/user/profile') ?>">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Change Profile</li>
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
                                <h4 class="card-title">EDIT PROFILE</h4>
                            </div>
                            <div class="card-body order-datatable">
                                <div class="container emp-profile">
                                    <form method="post" id="form-update" action="<?= site_url("admin/user/doEditProfile") ?>" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="text-center">
                                                    <img src="<?= $user["image"] != "" ? $user["image"] : base_url() . "/assets/custom/admin/img/default_avatar.png"; ?>" width="200">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pt-3">
                                                <div class="profile-head">
                                                    <div class="row mb-1">
                                                        <div class="col-9">
                                                            <input type="file" name="image" id="image" class="dropify" data-allowed-file-extensions="jpg jpeg png image" data-max-file-size="1M" accept="image/*" />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1">
                                                        <div class="col-3">
                                                            <b><?= $this->lang->line("label_first_name") ?></b>
                                                        </div>
                                                        <div class="col-6">
                                                            <input maxlength="30" type="text" name="first_name" id="first_name" class="form-control frm uppercase" value="<?= $user["first_name"] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1">
                                                        <div class="col-3">
                                                            <b><?= $this->lang->line("label_last_name") ?></b>
                                                        </div>
                                                        <div class="col-6">
                                                            <input maxlength="30" type="text" name="last_name" id="last_name" class="form-control frm uppercase" value="<?= $user["last_name"] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1">
                                                        <div class="col-3">
                                                            <b><?= $this->lang->line("label_email") ?></b>
                                                        </div>
                                                        <div class="col-6">
                                                            <input maxlength="30" type="text" name="email" id="email" class="form-control frm" value="<?= $user["email"] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1">
                                                        <div class="col-3">
                                                            <b><?= $this->lang->line("label_phone_number") ?></b>
                                                        </div>
                                                        <div class="col-6">
                                                            <input maxlength="30" type="text" name="no_hp" id="no_hp" class="form-control frm uppercase" value="<?= $user["phone_number"] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1">
                                                        <div class="container mt-4">
                                                            <div class="border-top pl-1 pt-3">
                                                                <button type="submit" class="btn btn-secondary frm"><?= $this->lang->line("label_submit") ?></button>
                                                                <a href="<?= site_url("admin/user/profile") ?>" class="btn btn-danger frm"><?= $this->lang->line("label_cancel") ?></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
        <section>
</div>
<script>
    $(document).ready(function() {
        $(".uppercase").keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });
        $("#form-update").validate({
            rules: {
                first_name: {
                    required: true,
                    alpha: true,
                },
                last_name: {
                    alphaWithSpace: true,
                },
                email: {
                    email: true,
                    required: true,
                },
                no_hp: {
                    required: true,
                    numeric: true,
                },
            },
            submitHandler: function(form) {
                if ($("#form-update").hasClass("success")) {
                    return true;
                } else {
                    var data = {
                        email: $("#email").val(),
                        id: <?= $user["id"] ?>,
                    }
                    validate(data, '<?= site_url("admin/user/validateEditProfile") ?>', "#form-update")
                }
            },
        });
    })
</script>