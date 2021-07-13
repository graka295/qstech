<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>MANAGE SUGGESTIONS</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/suggestions') ?>">Suggestions</a></li>
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
                            <div class="card-body">
                                <div class="card-body order-datatable">
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <b>Name</b>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="text-primary">
                                                <?= $data->name ?>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <b>Title</b>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="text-primary">
                                                <?= $data->title ?>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <b>Note</b>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="text-primary">
                                                <?= $data->value ?>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <b>Created at</b>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="text-primary">
                                                <?= $data->date_format ?>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <div class="border-top pl-1 pt-3 text-right">
                                            <a href="<?= site_url("admin/suggestions") ?>" class="btn btn-danger frm">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script></script>