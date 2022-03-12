<?php require_once "template/header.php"; ?>
<title>550 MCH Daily Report</title>
<?php require_once "template/sidebar.php"; ?>
<div class="row">
    <div class="col-12">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/createDepartment">Departments</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Departments</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-12 col-xl-8">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fa fa-edit text-primary"></i> Edit Departments
                    </h4>
                    <a href="<?php echo $url; ?>/department_create.php" class="btn btn-outline-primary">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                <hr>
                <?php
                $id = $_GET['id'];
                $current = department($id);
                if (isset($_POST['editDept'])){
                    editDepartment();
                }
                ?>
                <form method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="">
                        <div class="form-floating mb-3">
                            <input type="text" name="department" class="form-control w-50" id="departments" placeholder="departments" value="<?php echo $current['dept_name']; ?>">
                            <label for="departments">Departments Name</label>
                        </div>
                        <?php if (getError('department')){ ?>
                            <small class="fw-bold text-danger" style="margin-left: 10px;"><?php echo getError('department'); ?></small>
                        <?php }; ?>
                        <button class="btn btn-primary d-block text-uppercase" name="editDept"><i class="fa fa-save me-2"></i>Save</button>
                    </div>

                </form>
                <hr>

                <table class="table table-hover mt-3 mb-0">
                    <thead>
                    <th>#</th>
                    <th>Department Name</th>
                    <th>Creator</th>
                    <th>Action</th>
                    <th>Created</th>
                    </thead>
                    <tbody>

                    <?php foreach (departments() as $c){ ?>

                        <tr>
                            <td><?php echo $c['id'] ?></td>
                            <td><?php echo $c['dept_name'] ?></td>
                            <td><?php echo user($c['user_id'])['name'] ?></td>
                            <td>
                                <a href="department_delete.php?id=<?php echo $c['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure? You want to delete `<?php echo $c['dept_name']; ?>`?')">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <a href="editDepartment?id=<?php echo $c['id']; ?>" class="btn btn-sm btn-outline-warning">
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
