<?php 
include('db.php');
$customer_id = $_REQUEST['customer_id'];
$sql ='select * from vsms_customer where status=1 and id='.$customer_id;
$statement = $db->prepare($sql);
$statement->execute(); 
$result['customer'] = $statement->fetchAll();
$sql ='select * from vsms_customer_booking where status=1 and customer='.$customer_id;
$statement = $db->prepare($sql);
$statement->execute(); 
$result['vehicle'] = $statement->fetchAll();
echo json_encode($result);