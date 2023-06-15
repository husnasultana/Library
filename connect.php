<?php

// Define database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for database connection errors
if ($conn->connect_error) {
    die("Connection Failed!" . $conn->connect_error);
}

if($conn)
{
    ?>
    <script>
     alert("Connected");
    </script>
    <?php
}
else
{
    ?>
    <script>
        alert("Error Occured");
    </script>
    <?php
}

?>