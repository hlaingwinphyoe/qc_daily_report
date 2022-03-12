<div class="col-12 col-lg-3 col-xl-2 vh-100 sidebar">
    <div class="d-flex justify-content-between align-items-center py-2 mt-3 nav-brand">
        <div class="d-flex align-items-center">
            <span class="p-2 rounded d-flex justify-content-center align-items-center mr-2">
<!--                <i class="fas fa-user text-white h4 mb-0"></i>-->
                <img src="<?php echo $url; ?>/assets/img/logo.png" style="width: 40px" alt="">
            </span>
            <span class="font-weight-bolder h4 mb-0  text-primary ms-2">Total Tests Daily Report</span>
        </div>
        <button class="hide-sidebar-btn btn btn-light d-block d-lg-none">
            <i class="feather-x text-primary" style="font-size: 2em;"></i>
        </button>
    </div>
    <div class="nav-menu">
        <ul>
            <li class="menu-spacer"></li>

            <li class="text-black-50 mb-2">
                <span>QC Test</span>
            </li>

            <li class="menu-item">
                <a href="<?php echo $url; ?>/index.php" class="menu-item-link">
                    <span>
                        <i class="fas fa-clipboard-check text-primary"></i>
                        QC Tests
                    </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="<?php echo $url; ?>/filter" class="menu-item-link">
                    <span>
                        <i class="fas fa-filter text-primary"></i>
                        Filter
                    </span>
                </a>
            </li>
            <li class="menu-spacer"></li>

            <li class="text-black-50 mb-2">
                <span>Input</span>
            </li>

            <li class="menu-item">
                <a href="<?php echo $url; ?>/addValue" class="menu-item-link">
                    <span>
                        <i class="fa fa-plus text-primary"></i>
                        Test Form
                    </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo $url; ?>/testCreate" class="menu-item-link">
                    <span>
                        <i class="fa fa-vial text-primary"></i>
                        Test Types
                    </span>
                </a>
            </li>

            <li class="menu-spacer"></li>

            <?php if ($_SESSION['user']['role'] == 0){ ?>

            <li class="text-black-50 mb-2">
                <span>Departments</span>
            </li>

            <li class="menu-item">
                <a href="<?php echo $url; ?>/createDepartment" class="menu-item-link">
                    <span>
                        <i class="fa fa-plus text-primary"></i>
                        Create Departments
                    </span>
                </a>
            </li>
            <li class="menu-spacer"></li>

            <li class="text-black-50 mb-2">
                <span>Users Control</span>
            </li>

            <li class="menu-item">
                <a href="<?php echo $url; ?>/users" class="menu-item-link">
                    <span>
                        <i class="fa fa-users text-primary"></i>
                        Users
                    </span>
                </a>
            </li>
            <?php } ?>

            <hr>
            <li class="menu-item">
                <a href="<?php echo $url; ?>/log_out.php" class="btn btn-danger w-100">
                    <i class="fa fa-sign-out-alt"></i>
                    Log out
                </a>
            </li>

        </ul>
    </div>
</div>