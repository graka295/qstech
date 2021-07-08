<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>MANAGE FOOD</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/food') ?>">Food</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
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
                                    <b><?= $this->lang->line('label_CREATE') ?></b>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <form class="form-horizontal" method="POST" id="form-update" action="<?= site_url("admin/food/doCreate") ?>">
                                        <label class="form-control-label"><b><?= $this->lang->line("label_select_image") ?></b></label>
                                        <div class="row">
                                            <div class="col-md-4 col-lg-4 pl-0">
                                                <div class="text-center pb-1 col-12">
                                                    <div class="col-12">
                                                        <img src="<?= base_url("assets/custom/admin/img/add-image.png") ?>" id="image-preview" class="default-image">
                                                    </div>
                                                </div>
                                                <div class="text-center pb-1 col-12">
                                                    <div id="list-image">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div id="option-create-image">
                                                        <input type="file" id="select-image" accept="image/png,image/jpeg,image/jpg" style="display: none;">
                                                        <button type="button" id="add-photo" class="btn btn-success btn-block frm">
                                                            <i class="bi bi-plus"></i> <?= $this->lang->line("label_add_photo") ?>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div id="option-image">
                                                        <div class="col-md-12 d-grid gap-2 pe-0">
                                                            <button type="button" id="remove-photo" class="btn btn-danger frm">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </div>
                                                        <div class="col-md-12 d-grid gap-2 ps-0">
                                                            <button type="button" id="edit-photo" class="btn btn-warning frm">
                                                                <i class="bi bi-pencil"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label class="form-control-label">Name</label>
                                                <input maxlength="20" type="text" name="name" id="name" class="form-control frm" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label class="form-control-label">Price <b>(Rp)</b></label>
                                                <input maxlength="20" type="number" name="price" id="price" class="form-control frm" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label class="form-control-label">Category</label>
                                                <select class="form-select" id="category" name="category">
                                                    <?php foreach ($category as $val) { ?>
                                                        <option value="<?= $val["id"] ?>"><?= $val["name"] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label class="form-control-label">Desc</label>
                                                <textarea id="desc" class="form-control" name="desc"></textarea>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <div class="border-top pl-1 pt-3 text-right">
                                                <button type="submit" class="btn btn-secondary frm"><?= $this->lang->line("label_submit") ?></button>
                                                <a href="<?= site_url("admin/food") ?>" class="btn btn-danger frm"><?= $this->lang->line("label_cancel") ?></a>
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
<div class="modal fade remove-modal" tabindex="-1" role="dialog" id="cropperModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title"><?= $this->lang->line("label_crop_image") ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div style="max-height: 400px">
                    <img height="auto" width="100%" class="js-avatar-preview" src="">
                </div>
                <button class="btn btn-primary js-save-cropped-avatar"><?= $this->lang->line("label_save") ?></button>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    #image-preview {
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
<script>
    $(document).ready(function() {
        let save = false
        $("#form-update").validate({
            rules: {
                name: {
                    required: true,
                },
                category: {
                    required: true,
                },
                desc: {
                    required: true,
                },
                price: {
                    required: true,
                    step: "1",
                    min: 1,
                },
            },
            submitHandler: function(form) {
                if ($("#form-update").hasClass("success")) {
                    save = true;
                    return true;
                } else {
                    if ($("#list-image").children(".product-image").length <= 0) {
                        iziToast.warning({
                            title: 'Info',
                            message: 'Please insert photo product',
                            position: 'topRight'
                        });
                        return false
                    };
                    var data = {
                        name: $("#name").val(),
                    }
                    validate(data, '<?= site_url("admin/food/validate") ?>', "#form-update")
                }
            },
        });

        let action = "" /* add || update */
        let focusPreview;
        let cropper;
        let cropperModalId = '#cropperModal';
        var myModal = new bootstrap.Modal(document.getElementById("cropperModal"), {})
        $(cropperModalId).on('hidden.bs.modal', function() {
            $("#select-image").val("");
            cropper.destroy();
        });
        $('#select-image').on('change', function() {
            showLoading();
            var files = this.files;
            if (files.length > 0) {
                var photo = files[0];

                var fileExtension = ['jpeg', 'jpg', 'png'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    iziToast.warning({
                        title: 'Info',
                        message: 'File must be JPG,JPEG or PNG, less than 3MB',
                        position: 'topRight'
                    });
                    $(this).val("")
                    swal.close()
                    return false;
                }
                if (this.files[0].size >= (1048576 * 3)) {
                    iziToast.warning({
                        title: 'Info',
                        message: 'File must be JPG,JPEG or PNG, less than 3MB',
                        position: 'topRight'
                    });
                    $(this).val("")
                    swal.close()
                    return false;
                }

                var reader = new FileReader();
                reader.onload = function(event) {
                    var image = $('.js-avatar-preview')[0];
                    image.src = event.target.result;

                    cropper = new Cropper(image, {
                        viewMode: 1,
                        aspectRatio: 2 / 2.5,
                        minContainerWidth: 400,
                        minContainerHeight: 400,
                        minCropBoxWidth: 271,
                        minCropBoxHeight: 271,
                        movable: true,
                        ready: function() {
                            swal.close();
                        }
                    });
                    myModal.show();
                    $(cropperModalId).show();
                };
                reader.readAsDataURL(photo);
            }
        });
        $('.js-save-cropped-avatar').on('click', function(event) {
            showLoading();
            event.preventDefault();
            const canvas = cropper.getCroppedCanvas();
            const base64encodedImage = canvas.toDataURL();
            uploadImage(base64encodedImage)
        });
        $("#add-photo").click(function(e) {
            action = "add"
            $("#select-image").trigger('click');
        })
        $(".default-image").click(function(e) {
            action = "add"
            $("#select-image").trigger('click');
        })
        $("#option-image").hide()
        $(".uppercase").keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });

        function uploadImage(imageBase64) {
            var data = {
                image: imageBase64,
                action: action,
                old_image: action == "edit" ? $(focusPreview).children(".photo_product").val() : "",
            }
            $.ajax({
                data: data,
                url: "<?= site_url('admin/food/uploadImage') ?>",
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
                        myModal.hide()
                        if (action == "add") {
                            createElementPhoto(e)
                            showHideAddPhoto()
                        } else {
                            updateElementPhoto(e)
                        }
                        swal.close();
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
        }

        function createElementPhoto(e) {
            var tag = document.createElement("div");
            tag.className = "product-image";
            tag.onclick = function() {
                focusImagePreview(tag)
            };
            var image = document.createElement("IMG");
            var name_image = e.data.name_image
            image.setAttribute("src", '<?= base_url(PATH_TMP_IMAGE_PRODUCT) ?>' + name_image);
            tag.appendChild(image);
            var element = document.getElementById("list-image");
            element.appendChild(tag);
            var input = document.createElement("INPUT");
            input.setAttribute("type", "text");
            input.setAttribute("style", "display: none;");
            input.setAttribute("name", "photo_product[]");
            input.setAttribute("class", "photo_product");
            input.setAttribute("value", name_image);
            tag.appendChild(input);
            focusImagePreview(tag)
            $("#image-preview").removeClass("default-image")
        }

        function updateElementPhoto(e) {
            var name_image = e.data.name_image
            $(focusPreview).children("img").attr("src", '<?= base_url(PATH_TMP_IMAGE_PRODUCT) ?>' + name_image)
            $(focusPreview).children(".photo_product").val(name_image)
            focusImagePreview(focusPreview)
            $("#image-preview").removeClass("default-image")
        }
        $(".product-image").click(function(e) {
            focusImagePreview($(this))
        })

        function focusImagePreview(e) {
            $(".product-image").removeClass("product-image-focus")
            $(e).addClass("product-image-focus")
            var images = $(e).children("img").attr('src');
            $('#image-preview').attr('src', images);
            $('#image-preview').removeClass("default-image")
            $("#option-image").show()
            focusPreview = e
        }
        $("#remove-photo").click(function(e) {
            alertDeleteImage()
        })

        function alertDeleteImage() {
            Swal.fire({
                title: "<?= $this->lang->line("label_confirm_delete"); ?>",
                showCancelButton: true,
                confirmButtonText: "<?= $this->lang->line("label_delete"); ?>",
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteImage($(focusPreview).children(".photo_product").val());
                }
            })
        }

        function deleteImage(nameImage) {
            var data = {
                image: nameImage,
            }
            $.ajax({
                data: data,
                url: "<?= site_url('admin/food/deleteImage') ?>",
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
                        myModal.hide()
                        $(focusPreview).remove()
                        resetAddPhoto()
                        showHideAddPhoto()
                        swal.close();
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
        }

        function resetAddPhoto() {
            $("#image-preview").attr("src", "<?= base_url("assets/custom/admin/img/add-image.png") ?>")
            $("#image-preview").removeClass("default-image")
            $("#option-image").hide()
            $(".product-image").removeClass("product-image-focus")
            focusPreview = null
        }
        $("#edit-photo").click(function(e) {
            action = "edit"
            $("#select-image").trigger('click');
        })

        function showHideAddPhoto() {
            if ($("#list-image").children(".product-image").length >= 5) {
                $("#add-photo").hide();
            } else {
                $("#add-photo").show();
            }
        }
        $(window).bind("beforeunload", function(event) {
            if ($("#list-image").children(".product-image").length > 0 && !save) {
                return "You have unsaved changes"
            };
        });
    })
</script>