<?php require_once "template/header.php"; ?>
<title>550 MCH Daily Report</title>
<?php require_once "template/sidebar.php"; ?>
<div class="row">
    <div class="col-12">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                        <i class="fa fa-list text-primary"></i> Users
                    </h4>
                    <a href="#" class="btn btn-outline-primary full-screen-btn">
                        <i class="fa fa-arrow-alt-circle-right"></i>
                    </a>
                </div>
                <a href="<?php echo $url; ?>/register" class="btn btn-primary mt-3 text-uppercase"><i class="fa fa-plus me-2"></i>Create</a>
                <hr>

                <table class="table table-hover mt-3 mb-0">
                    <thead>
                    <th>#</th>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                    <th>Created</th>
                    </thead>
                    <tbody>

                    <?php foreach (users() as $u){ ?>

                        <tr>
                            <td><?php echo $u['id'] ?></td>
                            <td><img src="<?php echo $url; ?>/assets/img/<?php echo $u['photo']; ?>" style="width: 40px;height: 40px;border-radius: 50%;" alt=""></td>
                            <td><?php echo $u['name'] ?></td>
                            <td><?php echo $u['email'] ?></td>
                            <td><?php echo $role[$u['role']]; ?></td>
                            <td>
                                <a href="user_delete.php?id=<?php echo $u['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure? You want to delete `<?php echo $u['name']; ?>`?')">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-outline-warning">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            <td><?php echo showTime($u['created_at']); ?></td>
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
