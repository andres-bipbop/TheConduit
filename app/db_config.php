<?php
    $servername = "localhost";
    $username_db = "admin_andres";
    $password_db = "graziePennetta";
    $database = "my_pellegrinelliandres5ie";

    $link = mysqli_connect($servername, $username_db, $password_db, $database);
    if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>