<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Report</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/report') ?>">Report</a></li>
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
                                            <b>Table</b>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="text-primary">
                                                <?= $data->table_name ?>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <b>Total</b>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="text-primary number">
                                                Rp. <?= number_format($data->total, 0, ',', '.'); ?>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <b>Money Paid</b>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="text-primary number">
                                                Rp. <?= number_format($data->money_paid, 0, ',', '.'); ?>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <b>Money Changes</b>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="text-primary number">
                                                Rp. <?= number_format($data->money_changes, 0, ',', '.'); ?>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <b>Created at</b>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="text-primary">
                                                <?= $data->created_at ?>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="float-end">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <table id="dataTable" class="dataTable table table-striped table-bordered" style="width:100%">
                                    </table>
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
    var grid;
    $(document).ready(function() {
        grid = $('#dataTable').DataTable({
            ajax: {
                url: "<?= site_url('admin/report/bindingOrder') ?>",
                "data": function(d) {
                    d.idTable = <?= $data->id ?>
                },
                dataFilter: function(response) {
                    // this to see what exactly is being sent back
                    total = JSON.parse(response).totalPrice
                    totalTxt = new Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR"
                    }).format(total)
                    $("#total_payment").val(totalTxt)
                    $(".totalPriceTxt").text(totalTxt);
                    return response
                },
                type: 'POST',
            },
            scrollX: true,
            responsive: false,
            paging: true,
            sPaginationType: "full_numbers",
            pageLength: 10,
            bServerSide: true,
            bProcessing: true,
            fnDrawCallback: function() {
                $('.custom-toogle').bootstrapToggle();
            },
            columns: [{
                    title: "Name food",
                    data: "name_food",
                    name: "name_food"
                },
                {
                    title: "Price",
                    data: "price",
                    name: "price"
                },
                {
                    title: "Qty",
                    data: "qty",
                    name: "qty"
                },
                {
                    title: "Total",
                    data: "total",
                    name: "total"
                },
                {
                    title: "Note",
                    data: "note",
                    name: "note"
                },
            ]
        });
    })
</script>