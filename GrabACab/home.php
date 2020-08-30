<!-- Meet Patel
    December 6, 2019
    This is a home page which validate the email and password of the user and allow the user to select start and end point
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
</head>

<body>
    <?php
    include "connect.php"; // connect the databse

    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL); // validate the email

    $pwd = filter_input(INPUT_POST, "pwd", FILTER_SANITIZE_STRING); // validate the password

    if (true) {
        try {
            ?>

            <?php
                    $command = 'SELECT * FROM userinfo WHERE email= ? AND password= ? '; // validate the user while sign in 

                    $stmt = $dbh->prepare($command); // compile the query

                    $params = [$email, $pwd]; //sets the parameters

                    $success = $stmt->execute($params); // execute the query with parameters

                    $row = $stmt->fetch(); // fetch the data from the database

                    // validate if there is a data or not
                    if ($row <= 0) {
                        echo '<script>alert("E-mail id or Password do not match please enter again");</script>'; // alert the user of validation
                        header("Location: signup.php");
                        exit();
                    } else {
                        ?>
                <div class="bookingform">
                    <center>
                        <button type="button" id="signout" class="button">Sign Out</button>

                        <!-- This Javascript gets run when sign out button is clicked and will call the home page -->
                        <script>
                            document.getElementById("signout").onclick = function() {
                                location.href = "index.html";
                            }
                        </script>
                        <h1>Book A Cab</h1>
                        <form action="booking.php" method="post">
                            <label for="stpoint">Start Point</label>
                            <select name="stpoint" id="stpoint" onchange="imgSet()">
                                <option value=""></option>
                                <option value="bay">200 Bay Street</option>
                                <option value="main">100 Main Street</option>
                                <option value="park">187 Park Street</option>
                            </select>
                            <br><br>
                            <label for="endpoint">End Point</label>
                            <select name="endpoint" id="endpoint" onchange="imgSet()">
                                <option value=""></option>
                                <option value="bay">200 Bay Street</option>
                                <option value="main">100 Main Street</option>
                                <option value="park">187 Park Street</option>
                            </select>
                            <br><br>
                            <img id="location" src="" width="500" height="500" hidden>

                            <!-- This script will executed when user changes the start and end point then this will set the image of that ride -->
                            <script>
                                function imgSet() {
                                    let img = document.getElementById("stpoint").value; // gets the start point

                                    let img2 = document.getElementById("endpoint").value; // gets the end point

                                    if (img != img2) {
                                        document.getElementById("location").hidden = false; // set the  img tag to visible

                                        // sets the start image when only starting point is selected
                                        if (document.getElementById("endpoint").value == "" && document.getElementById("stpoint").value != null) {
                                            document.getElementById("location").src = "images/" + img + ".JPG";
                                        }
                                        // sets the total ride image when both the start and end points are set
                                        else if (document.getElementById("endpoint").value != "" && document.getElementById("stpoint").value != null) {
                                            document.getElementById("location").src = "images/" + img + "to" + img2 + ".JPG";
                                        }
                                        // sets the end ride image when only end point is selected 
                                        else if (document.getElementById("endpoint").value != null && document.getElementById("stpoint").value == "") {
                                            document.getElementById("location").src = "images/" + img2 + ".JPG";
                                        }
                                    }
                                    // remove the image and hide the image tag
                                    else {
                                        document.getElementById("location").src = "";
                                        document.getElementById("location").hidden = true;
                                    }

                                }
                            </script>


                            <p id="conformation"></p>
                            <button type="submit" id="submit" class="button">Submit</button>
                        </form>
                    </center>
                </div>
    <?php
            }
        }
        // catch the error and prints the error message
        catch (Exception $ex) {
            die("ERROR: Please check the information that you entered {$e->getMessage()}");
        }
        $dbh = null; // empty the database object
    }
    ?>
</body>

</html>