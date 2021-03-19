<?php 
include('db.php');
$prod_id = $_REQUEST['prod_id'];
$sql ='select * from vsms_product where status=1 and id='.$prod_id;
$statement = $db->prepare($sql);
$statement->execute(); 
$result = $statement->fetchAll();
echo json_encode($result);