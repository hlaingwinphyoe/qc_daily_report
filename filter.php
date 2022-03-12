<?php require_once "template/header.php"; ?>
<title>550 MCH Daily Report</title>
<?php require_once "template/sidebar.php"; ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fa fa-clipboard-check text-primary me-1"></i> QC Tests
                    </h4>
                    <a href="#" class="btn btn-outline-primary full-screen-btn">
                        <i class="fa fa-arrow-alt-circle-right"></i>
                    </a>
                </div>
                <hr>
                <form method="post" action="qcfilter">
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-md-6 col-lg-4">
                            <label for="staticEmail2">Choose Test</label>
                            <select name="test_id" class="form-select w-75" required>
                                <option selected>Select Test Type</option>
                                <?php foreach (multiple_test() as $m){ ?>
                                    <option value="<?php echo $m['id']; ?>"><?php echo $m['test_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label for="start" >From Date</label>
                            <input type="date" name="start" class="form-control w-75" id="start" placeholder="start" required>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label for="end" >To Date</label>
                            <input type="date" name="end" class="form-control w-75" id="end" placeholder="end" required>
                        </div>
                    </div>
                    <button class="btn btn-primary mb-3 text-uppercase" name="filterBtn2"><i class="fa fa-filter me-2"></i>Filter</button>
                </form>
                <hr>


            </div>
        </div>
    </div>
</div>

<?php clearError(); ?>

<?php require_once "template/footer.php"; ?>

<script>
    $(".table").dataTable({
        "order": [[0, "desc" ]]
    });
</script>
