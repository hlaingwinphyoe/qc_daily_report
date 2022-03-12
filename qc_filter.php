<?php require_once "template/header.php"; ?>
<title>550 MCH Daily Report</title>
<?php require_once "template/sidebar.php"; ?>

<div class="row">
    <div class="col-12">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/filter">QC Filter</a></li>
                <li class="breadcrumb-item active" aria-current="page">Filtered</li>
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
                    <a href="export_excel.php" class="btn btn-success mb-3"><i class="fa fa-file-export me-2"></i>Export Excel</a>
                </form>
                <hr>

                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo $url; ?>/index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?php if (isset($_POST['filterBtn2'])){ ?>
                                Search Test &nbsp; <b>"<?php echo single_test($_POST['test_id'])['test_name']; ?>"</b> &nbsp; <b>"<?php echo showTime($_POST['start']); ?>"</b> &nbsp; To &nbsp; <b>"<?php echo showTime($_POST['end']); ?>"</b>;
                            <?php }else{ ?>
                                Search ""
                            <?php } ?>
                        </li>
                    </ol>
                </nav>

                <table class="table table-hover mt-3 mb-0">
                    <thead>
                    <th>#</th>
                    <th>Test Type</th>
                    <th>Department</th>
                    <th>Total</th>
                    </thead>
                    <tbody>

                    <?php

                    if(isset($_POST['filterBtn2'])){
                        $test_id = textFilter($_POST['test_id']);
                        $from = textFilter($_POST['start']);
                        $to = textFilter($_POST['end']);
                        $con = con();
                        $sql = "SELECT *,SUM(amount) AS Total FROM `testvalue` WHERE test_id='$test_id' AND created_at BETWEEN '$from' AND '$to'";
                        $query = mysqli_query($con,$sql);
                        while($fetch = mysqli_fetch_array($query)){
                            echo "<tr>
                                    <td>".$fetch['id']."</td>
                                    <td>".single_test($fetch['test_id'])['test_name']."</td>
                                    <td>".department($fetch['dept_id'])['dept_name']."</td>
                                    <td>".number_format($fetch['Total'],2)."</td>
                                </tr>";

                        }
                    }
                    ?>
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
        "order": [[0, "desc" ]]
    });
</script>
