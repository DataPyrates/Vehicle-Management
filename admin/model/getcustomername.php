<?php 
include('db.php');
$sql ='select * from vsms_customer where status=1';
$statement = $db->prepare($sql);
$statement->execute(); 
$result = $statement->fetchAll();
echo json_encode($result);