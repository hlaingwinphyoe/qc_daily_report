<?php

require_once "core/auth.php";
require_once "core/base.php";
require_once "core/functions.php";

$dept_id = $_POST['dept_id'];

$sql = "SELECT * FROM test WHERE dept_id=$dept_id";

$result = mysqli_query(con(),$sql);
?>
<option value="">Select Tests</option>
<?php
    while ($row = mysqli_fetch_array($result)){
?>
        <option value="<?php echo $row['id']; ?>"><?php echo $row['test_name']; ?></option>
<?php } ?>
