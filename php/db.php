<?php
// mysql://b7595337b49aaa:9cf47bf1@us-cdbr-east-05.cleardb.net/heroku_dda6b08e9d4dd5c?reconnect=true
function Createdb() {
    // $severname = "us-cdbr-east-05.cleardb.net";
    // $usename = "b7595337b49aaa";
    // $password = "9cf47bf1";
    // $dbname = "heroku_dda6b08e9d4dd5c";

    $severname = "localhost";
    $usename = "root";
    $password = "";
    $dbname = "bookstore";

    //Create connection
    $con = mysqli_connect($severname, $usename, $password);
    // Check Connection
    if(!$con) {
        die("Connection Failed:".mysqli_connect_error());
    }
    // Create Database
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if (mysqli_query($con, $sql)) {
        $con = mysqli_connect($severname, $usename, $password, $dbname);

        $sql = "
                        CREATE TABLE IF NOT EXISTS books(
                            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            book_name VARCHAR (25) NOT NULL,
                            book_publisher VARCHAR (20),
                            book_price FLOAT 
                        );
        ";

        if(mysqli_query($con, $sql)) {
            //echo "Table Created...!";
            return $con;
        }
        else {
            echo "Can not Create Table";
        }
    }
    else {
        echo "Error while creating database.".mysqli_error($con);
    }

}