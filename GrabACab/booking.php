<!-- Meet Patel
    December 6, 2019
    This will show the booking details of the starting and ending point of the seletced ride with fair price
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Booking</title>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
</head>

<body>
    <center>
        <u><b>
                <p style='font-size: 2em;'>Booking Conformation</p>
        </u></b>
    </center>
    <?php
    include "connect.php"; // connect the database

    $stpoint = filter_input(INPUT_POST, 'stpoint', FILTER_SANITIZE_STRING); // validate the start point

    $endpoint = filter_input(INPUT_POST, 'endpoint', FILTER_SANITIZE_STRING); // validate the end point

    $command = 'SELECT * FROM ride WHERE startpoint= ? AND endpoint=?'; // select query to find the start and end point 

    $stmt = $dbh->prepare($command); // compile the query

    $params = [$stpoint, $endpoint]; // sets the parameters

    $success = $stmt->execute($params); // execute the query with parameters

    // fetch the data from database
    if ($row = $stmt->fetch()) {
        $price = $row["price"]; // gets the price of selected loaction for fair of the cab

        // prints the start and end point of location with it's fair
        echo "<center><p style='font-size: 1.5em;font-weight: bold;'>You booked cab from " . $stpoint . " street to " . $endpoint . " street with a fair of " . $price . "</p></center>";
    }

    ?>
    <button type="button" id="home" class="button">Go to Home Page</button>

    <!-- This Javascript gets run when Home button is clicked and will call the home page -->
    <script>
        document.getElementById("home").onclick = function() {
            location.href = "home.php";
        }
    </script>
</body>

</html>