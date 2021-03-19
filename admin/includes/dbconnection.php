<?php

$con = new mysqli("localhost", "xyz", '22222', "geneslyt_prakashdangar");

if($con->connect_error){

    die("Connection Failed".$con->connect_error);

}
