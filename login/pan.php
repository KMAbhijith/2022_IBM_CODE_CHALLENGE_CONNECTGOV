<?php
include('connect.php');
$district = $_POST['district'];
$sql = "select * from panchayath where dis_id='$district'";
$query = $con->query($sql);
echo '<option value="">Select District</option>';
while ($res = $query->fetch_assoc()) {
    echo '<option value="' . $res['pan_id'] . '">' . $res['panchayath'] . '</option>';
}
