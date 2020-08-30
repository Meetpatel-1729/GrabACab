<!-- Meet Patel
    December 6, 2019
    This is a sign up form which create and validate the user entered data
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
    <style>
        .signinform {
            padding: 16px;
            background-color: aqua;
            margin: 5% auto 15% auto;
            border: 2px solid black;
        }

        body {
            background-color: gray;
        }
    </style>
</head>

<body>

    <?php

    include "connect.php";

    $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING); //validate the first name

    $lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING); //validate the last name

    $mobile = filter_input(INPUT_POST, 'mobile', FILTER_VALIDATE_INT); // validate the mobile number

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); // validate th email id

    $pwd = filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING); // validate the password

    try {
        $command = 'SELECT * FROM userinfo WHERE email= ? '; // validate the email if it exist

        $stmt = $dbh->prepare($command); // compile the command

        $params = [$email]; // sets the parameter

        $success = $stmt->execute($params); // execute the query with parameters

        $row = $stmt->fetch(); // fetch the data 

        // validate if the user exist or not
        if ($row == 0) {
            $command2 = "INSERT INTO userinfo (firstname, lastname, mobile, email, password) VALUES (?,?,?,?,?)"; // insert query to insert user

            $stmt2 = $dbh->prepare($command2); // coompile the query

            $params2 = [$fname, $lname, $mobile, $email, $pwd]; // sets the parameters

            $success = $stmt2->execute($params2); // execute the query with parammeters
        }
    } catch (Exception $e) {
        die("ERROR: Please check the information that you entered {$e->getMessage()}"); // prints the error message when there is an error
    }

    $dbh = null; // empty the database object
    ?>
    <form method="POST" action="home.php">
        <div class="signupform">

            <center>
                <b>
                    <h1>Sign In</h1>
                </b>
            </center>
            <label for="email">E-mail</label>
            <input type="text" id="email" name="email" placeholder="E-mail" required>

            <label for="pwd">Password</label>
            <input type="password" id="pwd" name="pwd" placeholder="Password" required>

            <button type="submit" id="signin" class="button">Sign In</button>
            <button type="button" id="signup" class="button"><u>Don't have an account?</u> Sign Up</button>
            <button type="reset" id="reset" class="button">Reset</button>

            <!-- This Javascript gets run when signup button is clicked and will call the signup page -->
            <script>
                document.getElementById("signup").onclick = function() {
                    location.href = "index.html";
                }
            </script>

        </div>
    </form>
</body>

</html>