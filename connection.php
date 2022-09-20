<?php           
$db = mysqli_connect("localhost", "root", "password", "scmanage");
    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
?>