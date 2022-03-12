<?php

require_once "core/auth.php";
require_once "core/base.php";
require_once "core/functions.php";

header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=test_lists.xls");
header("Pragma: no-cache");
header("Expires: 0");

$output = "";

$output .="
		<table>
			<thead>
				<tr>
					<th>Test Type</th>
					<th>Department</th>
					<th>Total</th>
				</tr>
			<tbody>
	";
$con = con();

$query = mysqli_query($con,"SELECT *,SUM(amount) AS Total FROM `testvalue`") or die(mysqli_error($con));
while($fetch = $query->fetch_array()){

    $output .= "
				<tr>
					<td>".single_test($fetch['test_id'])['test_name']."</td>
			        <td>".department($fetch['dept_id'])['dept_name']."</td>
					<td>".$fetch['Total']."</td>
				</tr>
	";
}
$output .="
			</tbody>
 
		</table>
	";

echo $output;


?>