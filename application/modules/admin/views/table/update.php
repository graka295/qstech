<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>MANAGE TABLE</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/table') ?>">Table</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update</li>
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
                                    <b><?= $this->lang->line('label_UPDATE') ?></b>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <label class="form-control-label">QR ORDER</label>
                                            <div>
                                                <img src="#" id="qr1" alt="" />
                                            </div>
                                            <button class="btn" onclick="downloadqr()">Download the QR code</button>
                                        </div>
                                    </div>
                                    <form class="form-horizontal" method="POST" id="form-update" action="<?= site_url("admin/table/doUpdate") ?>">
                                        <input type="hidden" id="id" name="id" value="<?= $data->id; ?>">
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label class="form-control-label">Name</label>
                                                <input maxlength="20" type="text" name="name" id="name" class="form-control frm" placeholder="" value="<?= $data->name ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label class="form-control-label">Desc</label>
                                                <textarea id="desc" class="form-control" name="desc"><?= $data->description ?></textarea>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <div class="border-top pl-1 pt-3 text-right">
                                                <button type="submit" class="btn btn-secondary frm"><?= $this->lang->line("label_submit") ?></button>
                                                <a href="<?= site_url("admin/table") ?>" class="btn btn-danger frm"><?= $this->lang->line("label_cancel") ?></a>
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
    function downloadqr() {
        var src = $("#qr1").attr('src');
        window.open(src, 'blank');
    }
    $(document).ready(function() {
        $("#qr1").ClassyQR({
            type: 'text',
            text: '<?= site_url() ?>/frontend/order?codeTable=<?= $data->code ?>'
        });
        $("#form-update").validate({
            rules: {
                name: {
                    required: true,
                },
                desc: {
                    required: true,
                },
            },
            submitHandler: function(form) {
                if ($("#form-update").hasClass("success")) {
                    save = true;
                    return true;
                } else {
                    var data = {
                        name: $("#name").val(),
                        id: $("#id").val(),
                    }
                    validate(data, '<?= site_url("admin/table/validateUpdate") ?>', "#form-update")
                }
            },
        });
    })
</script>