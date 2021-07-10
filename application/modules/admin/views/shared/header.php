<header class='mb-3'>
    <nav class="navbar navbar-expand navbar-light ">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown me-3" id="myDropdown">
                        <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='bi bi-bell bi-sub fs-4 text-gray-600'></i>
                            <span id="divbadgeCount">
                                <?php if ($messageCount > 0) { ?>
                                    <span class="badge bg-primary" id="badgeCount"><?= $messageCount ?></span>
                                <?php } ?>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li>
                                <h6 class="dropdown-header">Notifications</h6>
                            </li>
                            <span id="list-notif">
                                <?php foreach ($message as $val) { ?>
                                    <li>
                                        <a href="<?= site_url('/admin/dashboard') ?>" class="dropdown-item">
                                            <div>
                                                <h6>
                                                    <?php if ($val['is_read'] != 1) { ?>
                                                        <span class="text-danger not-read-message">*</span>
                                                        <?php } ?><?= $val['value'] ?></h6>
                                                <p class="text-subtitle text-muted">
                                                    <?= $val['date'] ?>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                <?php } ?>
                            </span>
                        </ul>
                    </li>
                </ul>
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600"><?= $user["first_name"] ?></h6>
                                <p class="mb-0 text-sm text-gray-600"><?= $user["email"] ?></p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="<?= $user["image"] != "" ? $user["image"] : base_url() . "/assets/custom/admin/img/default_avatar.png"; ?>">
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li>
                            <h6 class="dropdown-header">Hello !</h6>
                        </li>
                        <li><a class="dropdown-item" href="<?php echo site_url("admin/user/profile") ?>"><i class="icon-mid bi bi-person me-2"></i> My Profile</a></li>
                        <hr class="dropdown-divider">
                        </li>
                        <li><a id="btn-logout" class="dropdown-item" href="#"><i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>