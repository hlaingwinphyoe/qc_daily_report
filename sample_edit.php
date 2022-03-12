<?php require_once "template/header.php"; ?>
<title>550 MCH Daily Report</title>
<?php require_once "template/sidebar.php"; ?>
<div class="row">
    <div class="col-12">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/addValue">Test Value</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Test Value</li>
            </ol>
        </nav>
    </div>
</div>
<?php
$id = $_GET['id'];
$current = result($id);
if (isset($_POST['updateTestValue'])){
    resultUpdate();
}
?>
<form method="post" class="row">
    <div class="col-12 col-md-7">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fa fa-edit text-primary"></i> Update Test Value
                    </h4>
                    <a href="#" class="btn btn-outline-primary full-screen-btn">
                        <i class="fa fa-arrow-alt-circle-right"></i>
                    </a>
                </div>
                <hr>

                <div class="row">
                    <div class="">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">


                        <div class="mt-3">
                            <div class="form-floating mb-3">
                                <input type="text" name="amount" class="form-control" id="amount" placeholder="amount" value="<?php echo $current['amount'] ?>">
                                <label for="amount"> Test Value</label>
                            </div>
                            <?php if (getError('amount')){ ?>
                                <small class="fw-bold text-danger" style="margin-left: 10px;"><?php echo getError('amount'); ?></small>
                            <?php }; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-12 col-md-5">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fa fa-vial text-primary"></i> Select Test
                    </h4>
                </div>
                <hr>
                <div class="col-12 col-md-5">
                    <div class="mb-3">
                        <?php foreach (multiple_test() as $c){ ?>
                            <div class="form-check">
                                <input class="form-check-input" value="<?php echo $c['id']; ?>" <?php echo $current['test_id'] == $c['id'] ? 'checked' : ''; ?> type="radio" name="test_id" id="customRadio<?php echo $c['id']; ?>">
                                <label class="form-check-label" for="customRadio<?php echo $c['id']; ?>">
                                    <?php echo $c['test_name']; ?>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if (getError('test_id')){ ?>
                        <small class="fw-bold text-danger" style="margin-left: 10px;"><?php echo getError('test_id'); ?></small>
                    <?php }; ?>
                    <button class="btn btn-primary d-block text-uppercase" name="updateTestValue"><i class="fa fa-save me-2"></i>Save</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php clearError(); ?>

<?php require_once "template/footer.php"; ?>

<script>
    $(".table").dataTable({
        "order": [[1, "asc" ]]
    });
</script>
