<?php
$insert = false;
include_once('conn.php');

if (!$con) {
    die("connection to this database failed due to" . mysqli_connect_error());
}

$query = "SELECT distinct(Train_Name) AS DTN from trainlist";
$res = mysqli_query($con, $query);

if (!empty($res)) {
    while ($rows = mysqli_fetch_assoc($res)) {
        echo $rows['DTN'];
    }
}
