<?php
include('../model/db.php');
include('../function/function.php');
session_start();
$query = '';
$output = array();
$query .= "SELECT * FROM vsms_fuel_type WHERE id <>'' ";
if(isset($_POST["search"]["value"]))
{ 
 $query .= ' AND ((fuel_type LIKE "%'.$_POST["search"]["value"].'%"))';
}
$query .= ' AND (status = 1) group by fuel_type ';
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY id ASC ';
}
if($_POST["length"] != -1)
{
 $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $db->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
$i=1;
foreach($result as $row)
{
 $sub_array = array();
 $sub_array[] = $i; 
 $sub_array[] = $row['fuel_type']; 
 if($row['status'] == '1'){
 $sub_array[] = '<a href="add-fuel-type.php?id='.$row['id'].'"><button type="button" name="update" class="btn btn-warning btn-xs update">Update</button></a> <button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
$i++;
}
else{
 $sub_array[] = 'NA';
}
 // $i++;
 $data[] = $sub_array;
}
$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  $filtered_rows,
 "recordsFiltered" => get_total_all_fuel_type(),
 "data"    => $data
);
echo json_encode($output);
?>