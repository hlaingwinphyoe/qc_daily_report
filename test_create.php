<?php require_once "template/header.php"; ?>
    <title>550 MCH Daily Report</title>
<?php require_once "template/sidebar.php"; ?>
    <div class="row">
        <div class="col-12">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo $url; ?>/index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Test</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fa fa-plus text-primary"></i> Create Test
                        </h4>
                        <a href="#" class="btn btn-outline-primary full-screen-btn">
                            <i class="fa fa-arrow-alt-circle-right"></i>
                        </a>
                    </div>
                    <hr>
                    <?php
                    if (isset($_POST['addTest'])){
                        testCreate();
                    }
                    ?>
                    <form method="post">
                        <div class="">
                            <label for="test" class="form-label">Test Type</label>
                            <div class="form-floating mb-3">
                                <input type="text" name="test" class="form-control w-50" id="test" placeholder="Test" value="<?php echo old('test'); ?>">
                                <label for="test">Test Type</label>
                            </div>
                            <?php if (getError('test')){ ?>
                                <small class="fw-bold text-danger" style="margin-left: 10px;"><?php echo getError('test'); ?></small>
                            <?php }; ?>
                            <div class="mb-3">
                                <label for="dept_name" class="form-label">Departments</label>
                                <select name="dept_id" class="form-select w-50" id="dept_name" aria-label="Default select example">
                                    <option selected disabled>Select Test</option>
                                    <?php foreach (departments() as $c){ ?>
                                        <option value="<?php echo $c['id']; ?>"><?php echo $c['dept_name']; ?></option>
                                    <?php } ?>
                                </select>
                                <?php if (getError('dept_id')){ ?>
                                    <small class="fw-bold text-danger" style="margin-left: 10px;"><?php echo getError('dept_id'); ?></small>
                                <?php }; ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary text-uppercase" name="addTest"><i class="fa fa-plus me-2"></i>Add Test</button>
                        </div>

                    </form>
                    <hr>

                    <table class="table table-hover mt-3 mb-0">
                        <thead>
                        <th>#</th>
                        <th>Test Type</th>
                        <th>Departments</th>
                        <th>Test Creator</th>
                        <th>Action</th>
                        <th>Created</th>
                        </thead>
                        <tbody>

                        <?php foreach (multiple_test() as $c){ ?>

                            <tr>
                                <td><?php echo $c['id'] ?></td>
                                <td><?php echo $c['test_name'] ?></td>
                                <td><?php echo department($c['dept_id'])['dept_name']; ?></td>
                                <td><?php echo user($c['user_id'])['name'] ?></td>
                                <td>
                                    <a href="test_delete.php?id=<?php echo $c['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure? You want to delete `<?php echo $c['test_name']; ?>`?')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <a href="testEdit?id=<?php echo $c['id']; ?>" class="btn btn-sm btn-outline-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td><?php echo showTime($c['created_at']); ?></td>
                            </tr>

                        <?php } ?>
                        </tbody>
                    </table>

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
