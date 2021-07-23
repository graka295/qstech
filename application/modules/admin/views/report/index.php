<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>REPORT</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Report</li>
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
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                Purchases Per Month
                            </div>
                            <div class="card-body order-datatable">
                                <div class="row">
                                    <div class="col-4">
                                        <select class="selectYear" id="yearBar"></select>
                                    </div>
                                    <div class="pt-2" id="loadingBar">
                                        <h3>Loading...</h3>
                                    </div>
                                    <canvas id="myChartBar"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                Report Order Table
                            </div>
                            <div class="card-body order-datatable">
                                <div class="col-8">
                                    <select class="selectMonth" id="monthPie"></select>
                                    <select class="selectYear" id="yearPie"></select>
                                </div>
                                <div class="pt-2" id="loadingPie">
                                    <h3>Loading...</h3>
                                </div>
                                <div class="row">
                                    <canvas id="myChartPie"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                Report Data
                            </div>
                            <div class="card-body order-datatable">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            Range date
                                            <div class="form-group position-relative has-icon-left mb-4">
                                                <input type="text" id="daterange" name="daterange" class="form-control" placeholder="Select range date">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table id="dataTable" class="dataTable table table-striped table-bordered" style="width:100%">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.min.js" integrity="sha512-5vwN8yor2fFT9pgPS9p9R7AszYaNn0LkQElTXIsZFCL7ucT8zDCAqlQXDdaqgA1mZP47hdvztBMsIoFxq/FyyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var grid;
    var startDate = "";
    var endDate = "";
    var dataBar = [];
    var dataPie = [];
    var myChartBar;
    var myChartPie;
    $(document).ready(function() {
        selectYear();
        selectMonth();
        $("#yearBar").change(function() {
            initBar($(this).val());
        })
        $("#loadingBar").hide();
        $("#loadingPie").hide();
        $("#monthPie").change(function() {
            initPie($("#yearPie").val(), $("#monthPie").val());
        })
        $("#yearPie").change(function() {
            initPie($("#yearPie").val(), $("#monthPie").val());
        })
        $('#daterange').daterangepicker({
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('#daterange').on('cancel.daterangepicker', function(ev, picker) {
            //do something, like clearing an input
            $('#daterange').val('');
        });


        $('#daterange').daterangepicker();
        $('#daterange').on('apply.daterangepicker', function(ev, picker) {
            startDate = picker.startDate.format('YYYY-MM-DD');
            endDate = picker.endDate.format('YYYY-MM-DD');
            grid.ajax.reload();
        });
        grid = $('#dataTable').DataTable({
            ajax: {
                url: "<?= site_url('admin/report/binding') ?>",
                type: 'POST',
                "data": function(d) {
                    d.startDate = startDate
                    d.endDate = endDate
                },
            },
            scrollX: true,
            responsive: false,
            paging: true,
            sPaginationType: "full_numbers",
            pageLength: 10,
            bServerSide: true,
            "order": [[ 4, "desc" ]],
            bProcessing: true,
            fnDrawCallback: function() {
                $('.custom-toogle').bootstrapToggle();
            },
            columns: [{
                    title: "Table",
                    data: "table_name",
                    name: "table_name"
                },
                {
                    title: "Total Payment",
                    data: null,
                    name: "total",
                    mRender: function(data, type, row) {
                        var price = new Intl.NumberFormat("id-ID", {
                            style: "currency",
                            currency: "IDR"
                        }).format(row['total'])
                        return price
                    }
                },
                {
                    title: "Money Paid",
                    data: null,
                    name: "money_paid",
                    mRender: function(data, type, row) {
                        var price = new Intl.NumberFormat("id-ID", {
                            style: "currency",
                            currency: "IDR"
                        }).format(row['money_paid'])
                        return price
                    }
                },
                {
                    title: "Money Chages",
                    data: null,
                    name: "money_changes",
                    mRender: function(data, type, row) {
                        var price = new Intl.NumberFormat("id-ID", {
                            style: "currency",
                            currency: "IDR"
                        }).format(row['money_changes'])
                        return price
                    }
                },
                {
                    title: "Created at",
                    data: "created_at",
                    name: "created_at"
                },
                {
                    data: null,
                    orderable: false,
                    width: "20%",
                    mRender: function(data, type, row) {
                        var viewButton = '';
                        var editButton = '';
                        var deleteButton = ''
                        viewButton = '<a href="report/detail?id=' + row['id'] + '" class="editor_edit btn btn-info"><i class="bi bi-eye"></i></a>';
                        return '<div class="text-center"><div class="btn-group">' +
                            viewButton +
                            '</div></div>';
                    }
                }
            ]
        });
        initBar(0, true);
        initPie(0, 0, true);
    })

    function selectYear() {
        var min = 2000;
        var d = new Date();
        var max = d.getFullYear();
        select = $('.selectYear');
        select.map(function(e) {
            for (var i = min; i <= max; i++) {
                var opt = document.createElement('option');
                opt.value = i;
                opt.innerHTML = i;
                $(this)[0].appendChild(opt);
            }

            $(this)[0].value = new Date().getFullYear();
        })
    }

    function selectMonth() {
        var min = 1;
        var d = new Date();
        var max = 12;
        select = $('.selectMonth');
        select.map(function(e) {
            for (var i = min; i <= max; i++) {
                var opt = document.createElement('option');
                opt.value = i;
                var b = ""
                switch (i) {
                    case 1:
                        b = "January";
                        break;
                    case 2:
                        b = "February";
                        break;
                    case 3:
                        b = "March";
                        break;
                    case 4:
                        b = "April";
                        break;
                    case 5:
                        b = "May";
                        break;
                    case 6:
                        b = "June";
                        break;
                    case 7:
                        b = "July";
                        break;
                    case 8:
                        b = "August";
                        break;
                    case 9:
                        b = "September";
                        break;
                    case 10:
                        b = "October";
                        break;
                    case 11:
                        b = "November";
                        break;
                    case 12:
                        b = "December";
                        break;
                }
                opt.innerHTML = b;
                $(this)[0].appendChild(opt);
            }

            $(this)[0].value = new Date().getMonth() + 1;
        })
    }

    function OnSuccessBar(init = false) {
        var color = []
        var label = []
        var value = []
        dataBar.map(function(e) {
            var b = ""
            switch (e.name) {
                case 1:
                    b = "January";
                    break;
                case 2:
                    b = "February";
                    break;
                case 3:
                    b = "March";
                    break;
                case 4:
                    b = "April";
                    break;
                case 5:
                    b = "May";
                    break;
                case 6:
                    b = "June";
                    break;
                case 7:
                    b = "July";
                    break;
                case 8:
                    b = "August";
                    break;
                case 9:
                    b = "September";
                    break;
                case 10:
                    b = "October";
                    break;
                case 11:
                    b = "November";
                    break;
                case 12:
                    b = "December";
                    break;
            }
            label.push(b)
            value.push(e.val)
            color.push(dynamicColors())
        })
        var ctx = document.getElementById('myChartBar').getContext('2d');
        if (!init) {
            myChartBar.destroy();
        }
        myChartBar = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: label,
                datasets: [{
                    label: 'Purchases per month',
                    data: value,
                    backgroundColor: color,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        $("loadingBar").hide();
        $("myChartBar").show();
    }

    function OnSuccessPie(init = false) {
        var ctx = document.getElementById('myChartPie').getContext('2d');
        var color = []
        var label = []
        var value = []
        dataPie.map(function(e) {
            label.push(e.name)
            value.push(e.val)
            color.push(dynamicColors())
        })
        if (!init) {
            myChartPie.destroy();
        }
        myChartPie = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: label,
                datasets: [{
                    data: value,
                    backgroundColor: color,
                    borderWidth: 1
                }]
            },
        });
    }

    function initBar(year = 0, init = false) {
        if (year == 0) {
            year = new Date().getFullYear();
        }
        $.ajax({
            data: {
                "year": year,
            },
            url: "<?= site_url('admin/report/cartBar') ?>",
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
                    dataBar = e.data;
                    OnSuccessBar(init);
                }
            },
            beforeSend: function() {
                $("loadingBar").show();
                $("myChartBar").hide();
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
    }

    function initPie(year = 0, month = 0, init = false) {
        if (year == 0) {
            year = new Date().getFullYear();
        }
        if (month == 0) {
            month = new Date().getMonth() + 1;
        }
        $.ajax({
            data: {
                "year": year,
                "month": month,
            },
            url: "<?= site_url('admin/report/cartPie') ?>",
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
                    dataPie = e.data;
                    OnSuccessPie(init);
                }
            },
            beforeSend: function() {
                $("loadingPie").show();
                $("myChartPie").hide();
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
    }

    function dynamicColors() {
        var r = Math.floor(Math.random() * 255);
        var g = Math.floor(Math.random() * 255);
        var b = Math.floor(Math.random() * 255);
        return "rgb(" + r + "," + g + "," + b + ")";
    };
</script>