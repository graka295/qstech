<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>MANAGE USERS</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/list-admin') ?>">Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
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
                                <div class="float-right">
                                    <b><?= $this->lang->line('label_CREATE') ?></b>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <form class="form-horizontal" method="POST" id="form-update" action="<?= site_url("admin/list-admin/doCreate") ?>" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="form-control-label"><?= $this->lang->line("label_avatar") ?></label>
                                                <input type="file" name="image" id="image" class="dropify" data-allowed-file-extensions="jpg jpeg png image" data-max-file-size="1M" accept="image/*" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label class="form-control-label"><?= $this->lang->line("label_first_name") ?></label>
                                                <input maxlength="30" type="text" name="first_name" id="first_name" class="form-control frm uppercase" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label class="form-control-label"><?= $this->lang->line("label_last_name") ?></label>
                                                <input maxlength="30" type="text" name="last_name" id="last_name" class="form-control frm uppercase" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label class="form-control-label"><?= $this->lang->line("label_email") ?></label>
                                                <input maxlength="40" type="text" name="email" id="email" class="form-control frm" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label class="form-control-label"><?= $this->lang->line("label_phone_number") ?></label>
                                                <input maxlength="15" type="text" name="no_hp" id="no_hp" class="form-control frm uppercase" placeholder="">
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <div class="border-top pl-1 pt-3 text-right">
                                                <button type="submit" class="btn btn-secondary frm"><?= $this->lang->line("label_submit") ?></button>
                                                <a href="<?= site_url("admin/list-admin") ?>" class="btn btn-danger frm"><?= $this->lang->line("label_cancel") ?></a>
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
                    }
                    validate(data, '<?= site_url("admin/list-admin/validate") ?>', "#form-update")
                }
            },
        });
    })
</script>