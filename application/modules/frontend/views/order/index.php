<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QS Tech</title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>assets/custom/admin/img/favicon.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/admin/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/admin/assets/css/app.css">
    <link href="<?= base_url(); ?>assets/custom/vendor/iziToast/iziToast.css" rel="stylesheet">
    <script src="<?= base_url("assets/admin/") ?>assets/vendors/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/admin/') ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/custom/vendor/iziToast/iziToast.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-light">
        <div class="container d-block">
            <a class="navbar-brand ms-4" href="index.html">
                <img src="<?= base_url() ?>/assets/custom/admin/img/logo_1.png" style="height: 4.5rem">
            </a>
        </div>
    </nav>


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4 class="card-title">MENU</h4>
                    </div>
                    <div class="card-body">
                        <?php foreach ($menu as $val) { ?>
                            <div class="mb-3 mt-3">
                                <h4>-<?= $val['name'] ?></h4>
                            </div>
                            <div class="container">
                                <?php foreach ($val['food'] as $food) { ?>
                                    <div class="row menu">
                                        <div class="col-md-8 col-sm-7">
                                            <h5><?= $food['name'] ?></h5>
                                            <?php if ($food["recommended"] == 1) { ?>
                                                <span class='bi bi-star text-warning'></span>
                                            <?php } ?>
                                            <h6>Rp. <?= number_format($food['price'], 0, ',', '.'); ?></h6>
                                            <p class="text-subtitle text-muted">
                                                <?= $food['desc'] ?>
                                            </p>
                                        </div>
                                        <div class="col-md-4 col-sm-5 text-center">
                                            <img class="rounded img-fluid mb-2 image-preview" src="<?= base_url() ?>/<?= PATH_IMAGE_PRODUCT ?><?= $food['photo'] ?>">
                                            <div id="list-image">
                                                <?php foreach ($food['photoFood'] as $vals) { ?>
                                                    <div class="product-image">
                                                        <img src="<?= base_url() ?>/<?= PATH_IMAGE_PRODUCT ?><?= $vals['name'] ?>">
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 menu-option menu-option-<?= $food['id'] ?>">
                                                    <input maxlength="3" type="number" class="form-control qty qty-<?= $food['id'] ?>" attr-id='<?= $food['id'] ?>' class="form-control frm" value="1" max='100' min="1" placeholder="Qty">
                                                </div>
                                                <div class="col-md-12 col-sm-12 mt-1">
                                                    <div class="menu-option menu-option-<?= $food['id'] ?>">
                                                        <button type="button" class="btn btn-outline-secondary btn-block rounded-pill" onclick="noteFood(<?= $food['id'] ?>)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                                            </svg>
                                                            Catatan
                                                        </button>
                                                        <div class="col-md-12 col-sm-12 mt-1">
                                                            <button type="button" class="btn btn-outline-danger btn-block rounded-pill" onclick="removeFodd(<?= $food['id'] ?>)">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                                </svg>
                                                                Hapus
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="menu-add menu-add-<?= $food['id'] ?>">
                                                        <div class="col-md-12 col-sm-12 mt-1">
                                                            <button type="button" class="btn btn-outline-success btn-block rounded-pill" onclick="addFood(<?= $food['id'] ?>,'<?= $food['name'] ?>',<?= $food['price'] ?>)">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                                                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z" />
                                                                </svg>
                                                                Tambah
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <div class="col-md-12 col-sm-12 mt-4">
                            <button type="button" class="btn btn-success btn-block rounded-pill" id="submit">
                                PESAN
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4 class="card-title"><?= $table->name; ?></h4>
                        <p class="text-subtitle text-muted">
                            PESANAN YANG SUDAH DI PESAN
                        </p>
                    </div>
                    <div class="card-body">
                        <?php $total = 0;
                        foreach ($orderTable as $val) { ?>
                            <div class="row menu pb-0">
                                <div class="col-7">
                                    <h6><b>(<?= $val['qty'] ?>) <?= $val['name_food'] ?></b></h6>
                                    <p class="text-subtitle text-muted">
                                        <?php if ($val['note'] != "") {
                                            echo "*" . $val['note'];
                                        } ?>
                                    </p>
                                </div>
                                <div class="col-5">
                                    <h6>Rp. <?= number_format($val['total'], 0, ',', '.'); ?></h6>
                                </div>
                            </div>
                        <?php $total += $val['total'];
                        } ?>
                        <div class="row m-2">
                            <div class="col-7">
                                <h5><b>Total</b></h5>
                            </div>
                            <div class="col-5">
                                <h6>Rp. <?= number_format($total, 0, ',', '.'); ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="qtyModal" tabindex="-1" aria-labelledby="qtyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qtyModalLabel">Add Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <input type="hidden" id="note-id">
                        <div class="col-lg-12">
                            <label class="form-control-label">Note</label>
                            <textarea id="note-food" class="form-control" name="note-food" id="note-food"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="changenote()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">PESANAN</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="list-order">
                </div>
                <div class="modal-footer">
                    <span style="width: 60%;" class="text-left">
                        <h5>TOTAL : <span id="total-order">0</span></h5>
                    </span>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="orderFood">PESAN</button>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url(); ?>assets/custom/vendor/jquery-validation-master/jquery.validate.js"></script>
    <script src="<?= base_url(); ?>assets/custom/vendor/sweetalert2/sweetalert2@10.js"></script>
    <script src="<?= base_url(); ?>assets/custom/js/custom.js"></script>
    <style type="text/css">
        .image-preview {
            max-width: 180px;
        }

        #list-image {
            display: flex;
            width: 100%;
        }

        .product-image:not(:first-child) {
            margin-left: 5px;
        }

        .product-image {
            max-width: 50px;
            border-color: #414141;
            border-width: 1px;
            border-style: solid;
            cursor: pointer;
        }

        .product-image-focus {
            border-color: #8c3952 !important;
        }

        .product-image>img {
            width: 100%;
        }

        .default-image {
            cursor: pointer;
        }
    </style>
    <style>
        .menu {
            border-style: dotted;
            padding: 2px;
            border-color: #e4e3e3;
            border-width: 1px;
            border-right: none;
            border-left: none;
            margin: 6px;
            padding-top: 13px;
            padding-bottom: 11px;
            margin-top: 0px;
            margin-bottom: -1px;
        }
    </style>
    <script>
        var orderData = [];
        var myModal, orderModal;
        $(document).ready(function() {
            $(".product-image").click(function(e) {
                focusImagePreview($(this))
            })
            myModal = new bootstrap.Modal(document.getElementById('qtyModal'), {
                keyboard: false
            })
            orderModal = new bootstrap.Modal(document.getElementById('orderModal'), {
                keyboard: false
            })
            $('#orderFood').click(function(e) {
                $.ajax({
                    data: {
                        idTable: '<?= $table->id; ?>',
                        orderData: orderData,
                    },
                    url: '<?= site_url("frontend/order/orderFood") ?>',
                    type: "POST",
                    dataType: 'json',
                    success: function(e) {
                        if (!e.success) {
                            swal.close();
                            console.log(e)
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
            $(".menu-option").hide();
            $(".qty").change(function(e) {
                var value = parseInt($(this).val())
                if (isNaN(value) || value <= 0 || value > 100) {
                    value = 1
                    $(this).val(value)
                }
                var id = $(this).attr('attr-id');
                updateFoodQty(id, value);
            })
            $("#submit").click(function(e) {
                console.log(orderData)
                if (orderData.length < 1) {
                    iziToast.warning({
                        title: 'Info',
                        message: 'Silahkan pesan makanan yg tersedia',
                        position: 'topRight',
                    });
                    return false;
                }
                var value = "";
                var total = 0
                orderData.map(function(e) {
                    var note = e.note != "" ? "*" + e.note : "";
                    total += e.price;
                    var price = new Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR"
                    }).format(e.price)
                    value += '<div class="row menu pb-0">' +
                        '<div class="col-7">' +
                        '<h6><b>(' + e.qty + ') ' + e.name + '</b></h6>' +
                        '<p class="text-subtitle text-muted">' +
                        note +
                        '</p>' +
                        '</div>' +
                        '<div class="col-5">' +
                        '<h6>' + price + '</h6>' +
                        '</div>' +
                        '</div>'
                })
                $("#total-order").text(new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR"
                }).format(total))
                $("#list-order").html(value)
                orderModal.show();
            })
        })

        function addFood(id, name, price) {
            $(".menu-option-" + id).show();
            $(".menu-add-" + id).hide();
            $(".qty-" + id).val(1);
            var data = {
                id: id,
                qty: 1,
                name: name,
                price: price,
                note: ''
            }
            orderData.push(data);
        }

        function updateFoodQty(id, qty) {
            objIndex = orderData.findIndex((obj => obj.id == id));
            orderData[objIndex].qty = qty
        }

        function changenote() {
            var idFood = $("#note-id").val();
            var noteFood = $("#note-food").val();
            objIndex = orderData.findIndex((obj => obj.id == idFood));
            orderData[objIndex].note = noteFood
            myModal.hide()
        }

        function removeFodd(id) {
            objIndex = orderData.findIndex((obj => obj.id == id));
            orderData.splice(objIndex, 1);
            $(".menu-option-" + id).hide();
            $(".menu-add-" + id).show();
        }

        function noteFood(id) {
            objIndex = orderData.findIndex((obj => obj.id == id));
            $("#note-food").val(orderData[objIndex].note);
            $("#note-id").val(id)
            myModal.show()
        }

        function focusImagePreview(e) {
            $(".product-image").removeClass("product-image-focus")
            $(e).addClass("product-image-focus")
            var images = $(e).children("img").attr('src');
            $(e).parent().parent().children(".image-preview").attr('src', images);
            $(e).parent().parent().children(".image-preview").removeClass("default-image")

        }
    </script>
</body>

</html>