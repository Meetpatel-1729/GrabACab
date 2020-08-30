<!-- Meet Patel
    December 6, 2019
    This will create a database object and make a connection with database
-->

 <?php
    try {
        $dbh = new PDO("mysql:host=localhost;dbname=MeetPatel", "root", ""); //create an object of database
    } catch (Exception $e) {
        die("ERROR: Couldn't connect. {$e->getMessage()}"); // will catch an error and display the error message
    }
    ?>