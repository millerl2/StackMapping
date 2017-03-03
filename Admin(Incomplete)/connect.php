<?php
    $servername = "localhost";
    $username = "millerl2";
    $password = "16idxh";
    $database = "millerl2_db";

    $conn = new mysqli($servername, $username, $password, $database);
    
    // Check connection
    if ($conn -> connect_error) 
    {
        die("Connection failed" .$conn->connect_error);
    }
    echo "Connected successfully (".$conn->host_info.")";
?> 