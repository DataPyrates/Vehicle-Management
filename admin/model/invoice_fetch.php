<?php
include('../model/db.php');
include('../function/function.php');
session_start();
$query = '';
$output = array();
$query .= "SELECT cb.* FROM vsms_customer_booking_dummy cb   WHERE cb.id <>'' ";
if(isset($_POST["search"]["value"]))
{ 
 $query .= ' AND ((customer LIKE "%'.$_POST["search"]["value"].'%") OR (vehicle LIKE "%'.$_POST["search"]["value"].'%"))';
}
$query .= ' AND (cb.status = 1 OR cb.status = 2) ';
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY cb.id ASC ';
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
 $sub_array[] = $row['customer']; 
 $sub_array[] = $row['vehicle']; 
 $sub_array[] = $row['invoice_no']; 
 $sub_array[] = date('d-m-Y',strtotime($row['booking_date'])); 
 $sub_array[] = '<a href="invoice/invoice_dummy.php?id='.$row['id'].'"><button type="button" id="'.$row["id"].'" class="btn btn-danger btn-xs">print</button></a>';
 $i++;
 $data[] = $sub_array;
}
$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  $filtered_rows,
 "recordsFiltered" => get_total_all_customer_booking(),
 "data"    => $data
);
echo json_encode($output);
?>