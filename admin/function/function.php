<?php 
function get_total_all_street_state()
{
	include('../model/db.php');
	$query = 'SELECT * FROM vsms_street_state  WHERE id <>"" ';
	if(isset($_POST["search"]["value"]))
	{
    $query .= ' AND ((street_state LIKE "%'.$_POST["search"]["value"].'%"))';
	}
    $query .= ' AND status = 1 ';
	$query .= ' ORDER BY id ASC ';
	$statement = $db->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_moc()
{
	include('../model/db.php');
	$query = 'SELECT * FROM vsms_moc  WHERE id <>"" ';
	if(isset($_POST["search"]["value"]))
	{
    $query .= ' AND ((moc LIKE "%'.$_POST["search"]["value"].'%"))';
	}
    $query .= ' AND status = 1  group by moc ';
	$query .= ' ORDER BY id ASC ';
	$statement = $db->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_payment_terms()
{
	include('../model/db.php');
	$query = 'SELECT * FROM vsms_payment_terms  WHERE id <>"" ';
	if(isset($_POST["search"]["value"]))
	{
    $query .= ' AND ((payment_terms LIKE "%'.$_POST["search"]["value"].'%"))';
	}
    $query .= ' AND status = 1  group by payment_terms ';
	$query .= ' ORDER BY id ASC ';
	$statement = $db->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}


function get_total_all_customer()
{
	include('../model/db.php');
	$query = 'SELECT * FROM vsms_customer  WHERE id <>"" ';
	if(isset($_POST["search"]["value"]))
	{
    $query .= ' AND ((first_name LIKE "%'.$_POST["search"]["value"].'%") OR (company LIKE "%'.$_POST["search"]["value"].'%"))';
	}
    $query .= ' AND status = 1 ';
	$query .= ' ORDER BY id ASC ';
	$statement = $db->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_customer_booking()
{
	include('../model/db.php');
    $query = "SELECT cb.*,c.first_name,v.rego FROM vsms_customer_booking cb join vsms_customer c on cb.customer = c.id join vsms_vehicle v on cb.vehicle=v.id  WHERE cb.id <>'' ";
	if(isset($_POST["search"]["value"]))
	{
    $query .= ' AND ((c.first_name LIKE "%'.$_POST["search"]["value"].'%") OR (v.rego LIKE "%'.$_POST["search"]["value"].'%"))';
	}
    $query .= ' AND (cb.status = 1 OR cb.status = 2) ';
	$query .= ' ORDER BY cb.id ASC ';
	$statement = $db->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_transmission()
{
	include('../model/db.php');
	$query = 'SELECT * FROM vsms_transmission  WHERE id <>"" ';
	if(isset($_POST["search"]["value"]))
	{
    $query .= ' AND ((transmission LIKE "%'.$_POST["search"]["value"].'%"))';
	}
    $query .= ' AND status = 1  group by transmission ';
	$query .= ' ORDER BY id ASC ';
	$statement = $db->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_body_type()
{
	include('../model/db.php');
	$query = 'SELECT * FROM vsms_body_type  WHERE id <>"" ';
	if(isset($_POST["search"]["value"]))
	{
    $query .= ' AND ((body_type LIKE "%'.$_POST["search"]["value"].'%"))';
	}
    $query .= ' AND status = 1  group by body_type ';
	$query .= ' ORDER BY id ASC ';
	$statement = $db->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_fuel_type()
{
	include('../model/db.php');
	$query = 'SELECT * FROM vsms_fuel_type  WHERE id <>"" ';
	if(isset($_POST["search"]["value"]))
	{
    $query .= ' AND ((fuel_type LIKE "%'.$_POST["search"]["value"].'%"))';
	}
    $query .= ' AND status = 1  group by fuel_type ';
	$query .= ' ORDER BY id ASC ';
	$statement = $db->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_vehicle()
{
	include('../model/db.php');
	$query = 'SELECT * FROM vsms_vehicle  WHERE id <>"" ';
	if(isset($_POST["search"]["value"]))
	{
    $query .= ' AND ((rego LIKE "%'.$_POST["search"]["value"].'%") OR (make LIKE "%'.$_POST["search"]["value"].'%"))';
	}
    $query .= ' AND status = 1 ';
	$query .= ' ORDER BY id ASC ';
	$statement = $db->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}


function get_total_all_product()
{
	include('../model/db.php');
	$query = 'SELECT * FROM vsms_product  WHERE id <>"" ';
	if(isset($_POST["search"]["value"]))
	{
    $query .= ' AND ((item_code LIKE "%'.$_POST["search"]["value"].'%") OR (type LIKE "%'.$_POST["search"]["value"].'%"))';
	}
    $query .= ' AND status = 1 ';
	$query .= ' ORDER BY id ASC ';
	$statement = $db->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_all_job_status()
{
	include('../model/db.php');
	$query = 'SELECT * FROM vsms_job_status  WHERE id <>"" ';
	if(isset($_POST["search"]["value"]))
	{
    $query .= ' AND ((job_status LIKE "%'.$_POST["search"]["value"].'%"))';
	}
    $query .= ' AND status = 1  group by job_status ';
	$query .= ' ORDER BY id ASC ';
	$statement = $db->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}