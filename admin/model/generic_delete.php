<?php
include('db.php');
$id = $_REQUEST['id'];
$table  =$_REQUEST['table'];
$sql =' update '.$table.' set status= 2 where id=:id';
$statement = $db->prepare($sql);
$statement->bindValue(":id", $id);
$count = $statement->execute(); 
if(isset($count)) {
   echo "Deleted Succesfully";
} else {
   echo "can't delete";
}