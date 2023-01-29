<?php
if (isset($_POST['Name']) && isset($_POST['Age']) && isset($_POST['Gender']) && isset($_POST['Address']) && isset($_POST['Source']) && isset($_POST['Destination']) && isset($_POST['Date']) && isset($_POST['Trains']) && isset($_POST['Category'])) {
    // error_reporting(0);
    $insert = false;
    include_once('conn.php');

    if (!$con) {
        die("connection to this database failed due to" . mysqli_connect_error());
    }

    $query = "SELECT Train_Name AS DTN from trainlist";
    $res = mysqli_query($con, $query);

    $name = $_POST['Name'];
    $age = $_POST['Age'];
    $gender = $_POST['Gender'];
    $address = $_POST['Address'];
    $source = $_POST['Source'];
    $destination = $_POST['Destination'];
    $date = $_POST['Date'];
    $train = $_POST['Trains'];
    $category = $_POST['Category'];

    $confirmed = "C";
    $waiting = "W";

    $ac_temp3;
    $gen_temp3;
    $tempID;
    $tempTN;

    $sql1 = "SELECT Total_AC_Seats AS TAS, AC_Seats_Booked AS ASB FROM train_status where source='$source' and destination='$destination' and train_name='$train' and train_date='$date'";
    $result1 = mysqli_query($con, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        global $ac_temp3;
        $row1 = mysqli_fetch_assoc($result1);
        $ac_temp1 = $row1['TAS'];
        $ac_temp2 = $row1['ASB'];
        $ac_temp3 = $ac_temp1 - $ac_temp2;
    }

    $sql2 = "SELECT Total_General_Seats AS TGS, General_Seats_Booked AS GSB FROM train_status where source='$source' and destination='$destination' and train_name='$train' and train_date='$date'";
    $result2 = mysqli_query($con, $sql2);
    if (mysqli_num_rows($result2) > 0) {
        global $gen_temp3;
        $row2 = mysqli_fetch_assoc($result2);
        $gen_temp1 = $row2['TGS'];
        $gen_temp2 = $row2['GSB'];
        $gen_temp3 = $gen_temp1 - $gen_temp2;
    }

    if ($ac_temp3 > 0) {
        global $tempID;
        $sql3 = "SELECT MAX(ticket_id) AS max from passenger";
        $result3 = mysqli_query($con, $sql3);
        $row3 = mysqli_fetch_assoc($result3);
        $tempID = $row3['max'];
        $tempID = $tempID + 1;
    }

    $sql4 = "SELECT train_number AS TN from trainlist where train_name='$train' and source='$source' and destination='$destination'";
    $result4 = mysqli_query($con, $sql4);
    if (mysqli_num_rows($result4) > 0) {
        global $tempTN;
        $row4 = mysqli_fetch_assoc($result4);
        $tempTN = $row4['TN'];
    }

    $sql5 = "INSERT INTO passenger(Train_Number, Date_Booked, Name, Age, Gender, Address, Status, Category) VALUES ('$tempTN', '$date', '$name', '$age', '$gender', '$address', '$confirmed', '$category');";
    mysqli_query($con, $sql5);

    if (empty($sql5))
        die("no query found");

    $con->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Book Now</title>
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
                <li><a href="Schedule.php">Schedule</a></li>
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

    <div class="bookform">
        <form class="bform" action="Booking.php" method="post">
            <label for="Name">Name</label>
            <input type="text" name="Name" id="Name" placeholder="Enter you Name">
            <label for="Age">Age</label>
            <input type="text" name="Age" id="Age" placeholder="Enter you Age">
            <label for="Gender">Gender</label>
            <div class="gen">
                <input type="radio" name="Gender" id="Male" value="M">
                <label for="Male">Male</label>
                <input type="radio" name="Gender" id="Female" value="F">
                <label for="Female">Female</label>
            </div>
            <label for="Address">Address</label>
            <input type="text" name="Address" id="Address" placeholder="Enter your Address">
            <label for="Source">Source</label>
            <input type="text" name="Source" id="Source" placeholder="Enter Source">
            <label for="Destination">Destination</label>
            <input type="text" name="Destination" id="Destination" placeholder="Enter Destination">
            <label for="Date">Date</label>
            <input type="date" name="Date" id="Date">
            <label for="Trains">Trains</label>
            <select name="Trains" id="Trains">
                <option value="" disabled selected>Select Train</option>
                <option value="alphaexpress">Alpha Express</option>
                <option value="iqbalexpress">Iqbal Express</option>
                <option value="multanexpress">Multan Express</option>
                <option value="southpakexpress">South Pak Express</option>
            </select>
            <label for="Category">Category</label>
            <div class="cat">
                <input type="radio" name="Category" id="AC" value="AC">
                <label for="AC">AC</label>
                <input type="radio" name="Category" id="General" value="General">
                <label for="General">General</label>
            </div>
            <a href="Booking.php"><input type="button" onclick="myFunction()" value="Proceed"></a></button>

            <script>
                function myFunction() {
                    document.getElementById("myForm").reset();
                }
            </script>

        </form>
    </div>
</body>

</html>