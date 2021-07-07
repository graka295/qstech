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
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
                                    <b><?= $this->lang->line('label_DETAIL') ?></b>
                                </div>
                            </div>
                            <div class="card-body order-datatable">
                                <div class="container emp-profile">
                                    <form method="post">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="text-center">
                                                    <img src="<?= $users->image != "" ? base_url(PATH_IMAGE_ADMIN . $users->image) : base_url() . "/assets/custom/admin/img/default_avatar.png"; ?>" width="200">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile-head">
                                                    <div>
                                                        <h5 class="text-uppercase">
                                                            <?= $users->first_name . " " . $users->last_name ?>
                                                        </h5>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <b><?= $this->lang->line("label_email") ?></b>
                                                        </div>
                                                        <div class="col-6">
                                                            <h6 class="text-primary">
                                                                <?= $users->email ?>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <b><?= $this->lang->line("label_phone_number") ?></b>
                                                        </div>
                                                        <div class="col-6">
                                                            <?= $users->handphone ?>
                                                        </div>
                                                    </div>
                                                    <div class="mt-4">
                                                        <div class="border-top pl-1 pt-3 text-right">
                                                            <a href="<?= site_url("admin/list-admin/update?id=" . $users->id) ?>" class="btn btn-success frm"><?= $this->lang->line("label_update") ?></a>
                                                            <a href="<?= site_url("admin/list-admin") ?>" class="btn btn-danger frm"><?= $this->lang->line("label_back") ?></a>
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
    </section>
</div>