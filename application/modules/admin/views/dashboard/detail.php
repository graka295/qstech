<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>DASHBOARD</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Dashboard</a></li>
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
                                            <b>Meja</b>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="text-primary">
                                                <?= $data->name ?>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <b>Total</b>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="text-primary totalPriceTxt">
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="float-end">
                                                <button data-bs-toggle="modal" data-bs-target="#exampleModal" href="<?= site_url('admin/list-admin/create') ?>" class="btn btn-secondary">PAY TRANSACTION</button>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">PAYMENT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-lg-12 mb-1">
                        <label class="form-control-label">AMOUNT</label>
                        <input maxlength="30" type="text" name="total" id="total_payment" class="form-control frm uppercase" placeholder="" readonly>
                    </div>
                    <div class="col-lg-12 mb-1">
                        <label class="form-control-label">BALANCE</label>
                        <input maxlength="30" type="number" name="balance" id="balance" class="form-control frm uppercase" placeholder="">
                    </div>
                    <div class="col-lg-12 mb-1">
                        <label class="form-control-label">CHANGE MONEY</label>
                        <input maxlength="30" type="text" name="change_money" id="change_money" class="form-control frm uppercase" placeholder="" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitPayment">Submit</button>
            </div>
        </div>
    </div>
</div>
<script>
    var grid;
    var total = 0
    var changeMoney = 0
    $(document).ready(function() {
        $("#balance").focusout(function() {
            var change = parseInt($(this).val()) - parseInt(total)
            changeMoney = change
            console.log(changeMoney);
            if (change >= 0) {
                $("#change_money").val(new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR"
                }).format(changeMoney))
            } else {
                changeMoney = 0
                $("#change_money").val("")
            }
        })
        $("#submitPayment").click(function(e) {
            if (total <= 0) {
                iziToast.warning({
                    title: 'Info',
                    message: 'no orders to pay',
                    position: 'topRight'
                });
                return false
            }
            var change = parseInt($("#balance").val()) - parseInt(total)
            if (change < 0) {
                iziToast.warning({
                    title: 'Info',
                    message: 'Not enough balance',
                    position: 'topRight'
                });
                return false
            }
            var data = {
                id_table: <?= $data->id ?>,
                money_paid: parseInt($("#balance").val()),
                money_changes: change,
                total: parseInt(total),
            }
            $.ajax({
                data: data,
                url: '<?= site_url("admin/dashboard/payment") ?>',
                type: "POST",
                dataType: 'json',
                success: function(e) {
                    if (!e.success) {
                        swal.close();
                        e.message.map(function(ex) {
                            iziToast.warning({
                                title: 'Info',
                                message: ex,
                                position: 'topRight'
                            });
                        })
                    } else {
                        swal.close();
                        location.reload();
                    }
                },
                beforeSend: function() {
                    showLoading();
                },
                error: function(e) {
                    swal.close();
                    iziToast.error({
                        title: 'Warning',
                        message: "Bad Request",
                        position: 'topRight'
                    });
                }
            });
        })
        $(document).on('click.bs.toggle', 'div.change-data', function(e) {
            e.stopImmediatePropagation()
            var checkbox = $(this).children('input[type=checkbox]')
            var url = '<?= site_url("admin/dashboard/changeOrderServed") ?>'
            deleteData(checkbox, url)
        })
        grid = $('#dataTable').DataTable({
            ajax: {
                url: "<?= site_url('admin/dashboard/bindingOrder') ?>",
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
                    title: "Ready served",
                    data: null,
                    orderable: false,
                    width: "15%",
                    mRender: function(data, type, row) {
                        var checked = ""
                        if (row['is_served'] == true) {
                            checked = "checked"
                        }
                        var toogleButton = '';
                        toogleButton = '<input class="custom-toogle" type="checkbox" ' + checked + ' data-toggle="toggle" data-onstyle="info" data-id="' + row["id"] + '" data-style="change-data" data-offstyle="secondary">';
                        return '<div class="text-center">' +
                            toogleButton +
                            '</div>';
                    }
                },
            ]
        });
    })
</script>