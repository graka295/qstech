<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>My Profile</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
                            <div class="card-body order-datatable">
                                <div class="container emp-profile">
                                    <form method="post">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="text-center">
                                                    <img src="<?= $user["image"] != "" ? $user["image"] : base_url() . "/assets/custom/admin/img/default_avatar.png"; ?>" width="200">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile-head">
                                                    <div>
                                                        <h5 class="text-uppercase">
                                                            <?= $user["first_name"] . " " . $user["last_name"] ?>
                                                        </h5>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <b><?= $this->lang->line("label_email") ?></b>
                                                        </div>
                                                        <div class="col-6">
                                                            <h6 class="text-primary">
                                                                <?= $user["email"] ?>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <b><?= $this->lang->line("label_phone_number") ?></b>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="text-muted"><?= $user["phone_number"] ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="container mt-4">
                                                        <div class="border-top pl-1 pt-3">
                                                            <a href="<?= site_url('admin/user/edit-profile') ?>" class="btn btn-secondary"><i class="fa fa-edit text-white"></i> CHANGE PROFILE</a>
                                                            <a href="<?= site_url('admin/user/change-password') ?>" class="btn btn-success">CHANGE PASSWORD</a>
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