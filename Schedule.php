<?php
include_once('conn.php');
$query = "select * from trainlist";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Trains</title>
</head>

<body>
    <header>
        <div class="left">
            <a href="#"><img src="Pictures/train.png" alt=""></a>
            <div><a href="#">Railway Management <br>System</a></div>
        </div>
        <div class="mid">
            <ul class="navbar">
                <li><a href="wel.html">Home</a></li>
                <li><a href="Schedule.php" class="active">Schedule</a></li>
                <li><a href="cancel.html">Cancel Booking</a></li>
            </ul>
        </div>
        <div class="right">
            <a href="Booking.php"><button class="btn">Book Now</button></a>
        </div>
    </header>

    <hr>

    <div class="bg">
        <img src="Pictures/trbg.jpg">
    </div>

    <div class="tlist">
        <table class="trains">
            <tr>
                <th>Train Number</th>
                <th>Train Name</th>
                <th>Source</th>
                <th>Destination</th>
                <th>Air Conditioned Fair</th>
                <th>General Fair</th>
                <th>Weekdays</th>
            </tr>

            <?php
            while ($rows = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $rows['Train_Number']; ?></td>
                    <td><?php echo $rows['Train_Name']; ?></td>
                    <td><?php echo $rows['Source']; ?></td>
                    <td><?php echo $rows['Destination']; ?></td>
                    <td><?php echo $rows['AC_Fair']; ?></td>
                    <td><?php echo $rows['General_Fair']; ?></td>
                    <td><?php echo $rows['Weekdays']; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>

</html>