<?php
include('../model/db.php');
include('../function/function.php');
session_start();
$query = '';
$output = array();
$query .= "SELECT cb.*,c.first_name,v.rego FROM vsms_customer_booking cb join vsms_customer c on cb.customer = c.id join vsms_vehicle v on cb.vehicle=v.id  WHERE cb.id <>'' ";
if(isset($_POST["search"]["value"]))
{ 
 $query .= ' AND ((c.first_name LIKE "%'.$_POST["search"]["value"].'%") OR (v.rego LIKE "%'.$_POST["search"]["value"].'%"))';
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
 $sub_array[] = $row['first_name']; 
 $sub_array[] = $row['rego']; 
 $sub_array[] = $row['invoice_no']; 
 $sub_array[] = date('d-m-Y',strtotime($row['booking_date'])); 

 if($row['status'] == '1'){
 $sub_array[] = '<a href="customer-invoice.php?id='.$row['id'].'&show=yes"><button type="button" name="update" class="btn btn-warning btn-xs">Invoice</button></a>  <a href="invoice/invoice.php?id='.$row['id'].'"><button type="button" id="'.$row["id"].'" class="btn btn-danger btn-xs">print</button></a> ';
$i++;
}
else{
 $sub_array[] = '<a href="customer-invoice.php?id='.$row['id'].'"><button type="button" name="update" class="btn btn-warning btn-xs">Invoice</button></a> <a href="invoice/invoice.php?id='.$row['id'].'"><button type="button" id="'.$row["id"].'" class="btn btn-danger btn-xs">print</button></a>';
}
 // $i++;
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