<?php require_once "template/header.php"; ?>
<title>550 MCH Daily Report</title>
<?php require_once "template/sidebar.php"; ?>
<div class="row">
    <div class="col-12">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/users">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create User</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-12 col-xl-5">
                        <h4 class="text-center text-primary">
                            <i class="feather-users"></i>
                            User Register
                        </h4>
                        <?php

                        if(isset($_POST['reg-btn'])){
                            register();

                        }

                        ?>
                        <form method="post">
                            <div class="mb-2">
                                <label><i class="text-primary fa fa-user-alt me-2"></i>Name</label>
                                <div class="form-floating mb-3">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="name" value="<?php echo old('name') ?>">
                                    <label for="name" class="text-black-50">Name</label>
                                </div>
                                <?php if (getError('name')){ ?>
                                    <small class="fw-bold text-danger" style="margin-left: 10px;"><?php echo getError('name'); ?></small>
                                <?php }; ?>
                            </div>
                            <div class="mb-2">
                                <label><i class="text-primary fa fa-phone-alt me-2"></i>Email</label>
                                <div class="form-floating mb-3">
                                    <input type="text" name="email" class="form-control" id="email" placeholder="email" value="<?php echo old('email') ?>">
                                    <label for="email" class="text-black-50">Email</label>
                                </div>
                                <?php if (getError('email')){ ?>
                                    <small class="fw-bold text-danger" style="margin-left: 10px;"><?php echo getError('email'); ?></small>
                                <?php }; ?>
                            </div>
                            <div class="mb-2">
                                <label><i class="text-primary fa fa-phone-alt me-2"></i>Phone Number</label>
                                <div class="form-floating mb-3">
                                    <input type="number" name="phone" class="form-control" id="phone" placeholder="phoneNumber" value="<?php echo old('phone') ?>">
                                    <label for="phone" class="text-black-50">Phone Number</label>
                                </div>
                                <?php if (getError('phone')){ ?>
                                    <small class="fw-bold text-danger" style="margin-left: 10px;"><?php echo getError('phone'); ?></small>
                                <?php }; ?>
                            </div>
                            <div class="mb-2">
                                <label><i class="text-primary fa fa-lock me-2"></i>Password</label>
                                <div class="form-floating">
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                    <label for="password" class="text-black-50">Password</label>
                                </div>
                                <?php if (getError('password')){ ?>
                                    <small class="fw-bold text-danger" style="margin-left: 10px;"><?php echo getError('password'); ?></small>
                                <?php }; ?>
                            </div>
                            <div class="mb-0 mt-3">
                                <button class="btn btn-primary text-uppercase" name="reg-btn"><i class="fa fa-sign-in-alt me-2"></i>Register</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-xl-7">
                        <div class="">
                            <img src="<?php echo $url ?>/assets/img/login.jpg" class="img-fluid" style="height: 700px !important;" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php clearError(); ?>

<?php require_once "template/footer.php"; ?>

<script>
    $(".table").dataTable({
        "order": [[1, "asc" ]]
    });
</script>
