<?php require_once "template/header.php"; ?>
<title>550 MCH Daily Report</title>
<?php require_once "template/sidebar.php"; ?>
<div class="row">
    <div class="col-12">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Total Test</li>
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
<form class="row" method="post">
    <div class="col-12 col-md-7">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fa fa-plus text-primary"></i> Update Total Test Value
                    </h4>
                </div>
                <hr>
                <div class="row">
                    <div class="">
                        <div class="mt-3">
                            <div class="form-floating mb-3">
                                <input type="text" name="amount" class="form-control" id="amount" placeholder="amount"  value="<?php echo $current['amount'] ?>">
                                <label for="amount">Total Tests</label>
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
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fa fa-vial text-primary"></i> Select Tests
                    </h4>
                </div>
                <hr>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="mb-3">
                    <label for="dept_name" class="form-label">Departments</label>
                    <select name="dept_id" class="form-select" id="dept_name" aria-label="Default select example">
                        <option selected disabled>Select Test</option>
                        <?php foreach (departments() as $c){ ?>
                            <option value="<?php echo $c['id']; ?>" <?php echo ($c['id'] == $current['dept_id']? 'selected':''); ?>><?php echo $c['dept_name']; ?></option>
                        <?php } ?>
                    </select>
                    <?php if (getError('dept_id')){ ?>
                        <small class="fw-bold text-danger" style="margin-left: 10px;"><?php echo getError('dept_id'); ?></small>
                    <?php }; ?>
                </div>

                <div class="mb-3">
                    <label for="test_name" class="form-label">Tests</label>
                    <select name="test_id" class="form-select" id="test_name">
                        <option selected disabled>Select Test</option>
                        <?php foreach (multiple_test() as $c){ ?>
                            <option value="<?php echo $c['id'] ?>" name="test_id" id="customRadio<?php echo $c['id']; ?>"
                                <?php echo $current['test_id'] == $c['id'] ? 'selected' : ''; ?>><?php echo $c['test_name']; ?></option>
                        <?php } ?>
                    </select>
                    <?php if (getError('test_id')){ ?>
                        <small class="fw-bold text-danger" style="margin-left: 10px;"><?php echo getError('test_id'); ?></small>
                    <?php }; ?>
                </div>

                <button class="btn btn-primary d-block text-uppercase" name="updateTestValue"><i class="fa fa-save me-2"></i>Save</button>
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

    $(document).ready(function (){
        $("#dept_name").on('change', function (){
            let dept_id = this.value;
            $.ajax({
                url : "get_subTest.php",
                type : "POST",
                data : {
                    dept_id: dept_id
                },
                cache: false,
                success: function (result){
                    $("#test_name").html(result);
                }
            });
        });
    });

</script>
