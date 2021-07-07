<ul class="menu">
    <li class="sidebar-title">Menu</li>

    <li class="sidebar-item">
        <a href="<?php echo site_url("admin/dashboard") ?>" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item  has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-card-checklist"></i>
            <span>Master</span>
        </a>
        <ul class="submenu ">
            <li class="submenu-item ">
                <a href="<?php echo site_url("admin/list-admin") ?>">Users</a>
            </li>
            <li class="submenu-item ">
                <a href="<?php echo site_url("admin/food") ?>">Food</a>
            </li>
            <li class="submenu-item ">
                <a href="<?php echo site_url("admin/table") ?>">Table</a>
            </li>
        </ul>
    </li>


    <!-- <li class="sidebar-item active has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-grid-1x2-fill"></i>
            <span>Layouts</span>
        </a>
        <ul class="submenu active">
            <li class="submenu-item ">
                <a href="layout-default.html">Default Layout</a>
            </li>
            <li class="submenu-item ">
                <a href="layout-vertical-1-column.html">1 Column</a>
            </li>
            <li class="submenu-item active">
                <a href="layout-vertical-navbar.html">Vertical with Navbar</a>
            </li>
            <li class="submenu-item ">
                <a href="layout-horizontal.html">Horizontal Menu</a>
            </li>
        </ul>
    </li> -->

</ul>