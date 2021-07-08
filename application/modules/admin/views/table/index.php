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
                        <li class="breadcrumb-item active" aria-current="page">Table</li>
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
                                <div class="float-end">
                                    <a href="<?= site_url('admin/table/create') ?>" class="btn btn-secondary"><?= $this->lang->line('label_CREATE') ?></a>
                                </div>
                            </div>
                            <div class="card-body order-datatable">
                                <table id="dataTable" class="dataTable table table-striped table-bordered" style="width:100%">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section>
</div>
<script>
    var grid;
    $(document).ready(function() {
        $(document).on('click.bs.toggle', 'div.change-data', function(e) {
            e.stopImmediatePropagation()
            var checkbox = $(this).children('input[type=checkbox]')
            var url = '<?= site_url("admin/table/deleteData") ?>'
            deleteData(checkbox, url)
        })
        grid = $('#dataTable').DataTable({
            ajax: {
                url: "<?= site_url('admin/table/binding') ?>",
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
                    title: "Name",
                    data: "name",
                    name: "name"
                },
                {
                    title: "Code",
                    data: "code",
                    name: "code"
                },
                {
                    data: null,
                    orderable: false,
                    width: "10%",
                    mRender: function(data, type, row) {
                        var checked = ""
                        if (row['is_active'] == true) {
                            checked = "checked"
                        }
                        var toogleButton = '';
                        toogleButton = '<input class="custom-toogle" type="checkbox" ' + checked + ' data-toggle="toggle" data-onstyle="info" data-id="' + row["id"] + '" data-style="change-data" data-offstyle="secondary">';
                        return '<div class="text-center">' +
                            toogleButton +
                            '</div>';
                    }
                },
                {
                    data: null,
                    orderable: false,
                    width: "20%",
                    mRender: function(data, type, row) {
                        var viewButton = '';
                        var editButton = '';
                        var deleteButton = ''
                        viewButton = '<a href="table/detail?id=' + row['id'] + '" class="editor_edit btn btn-info"><i class="bi bi-eye"></i></a>';
                        editButton = '<a href="table/update?id=' + row['id'] + '" class="editor_edit btn btn-warning"><i class="bi bi-pencil text-white"></i></a>';
                        deleteButton = '<button onClick="removeRow(' + row['id'] + ')" class="editor_edit btn btn-danger"><i class="bi bi-trash text-white"></i></button>';
                        return '<div class="text-center"><div class="btn-group">' +
                            // viewButton +
                            editButton +
                            deleteButton +
                            '</div></div>';
                    }
                }
            ]
        });
    })

    function removeRow(id) {
        var url = '<?= site_url('admin/table/delete?id=') ?>' + id
        removeData(url)
    }
</script>