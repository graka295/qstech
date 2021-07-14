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
                        <li class="breadcrumb-item active" aria-current="page">Suggestions</li>
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
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">QR SUGGESTIONS</button>
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
    </section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">QR CODE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="#" id="qr1" alt="" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="downloadqr()">Download</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var grid;

    function downloadqr() {
        var src = $("#qr1").attr('src');
        window.open(src, 'blank');
    }
    $(document).ready(function() {
        $("#qr1").ClassyQR({
            type: 'text',
            text: '<?= site_url() ?>/frontend/suggestions'
        });
        $(document).on('click.bs.toggle', 'div.change-data', function(e) {
            e.stopImmediatePropagation()
            var checkbox = $(this).children('input[type=checkbox]')
            var url = '<?= site_url("admin/suggestions/deleteData") ?>'
            deleteData(checkbox, url)
        })
        grid = $('#dataTable').DataTable({
            ajax: {
                url: "<?= site_url('admin/suggestions/binding') ?>",
                type: 'POST',
            },
            order: [
                [2, "desc"]
            ],
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
                    title: "<?= $this->lang->line("label_account") ?>",
                    data: "name",
                    name: "name"
                },
                {
                    title: "Title",
                    data: "title",
                    name: "title"
                },
                {
                    title: "Created at",
                    data: "date_format",
                    name: "date_format"
                },
                {
                    data: null,
                    orderable: false,
                    width: "20%",
                    mRender: function(data, type, row) {
                        var viewButton = '';
                        var editButton = '';
                        var deleteButton = ''
                        viewButton = '<a href="suggestions/detail?id=' + row['id'] + '" class="editor_edit btn btn-info"><i class="bi bi-eye"></i></a>';
                        return '<div class="text-center"><div class="btn-group">' +
                            viewButton +
                            // editButton +
                            // deleteButton +
                            '</div></div>';
                    }
                }
            ]
        });
    })

    function removeRow(id) {
        var url = '<?= site_url('admin/suggestions/delete?id=') ?>' + id
        removeData(url)
    }
</script>