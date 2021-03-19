<?php

$con = new mysqli("localhost", "geneslyt", 'G?n$sis@18', "geneslyt_prakashdangar");


if($con->connect_error){

    die("Connection Failed".$con->connect_error);

}

?>

