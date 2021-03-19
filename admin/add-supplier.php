<?php

session_start();

error_reporting(0);

include('includes/dbconnection.php');

$sql = "SELECT * FROM vsms_body_type group by body_type";
$body_type_data = mysqli_query($con, $sql) or die (mysqli_error());

$sql = "SELECT * FROM tblcategory group by VehicleCat";
$drive_type_data = mysqli_query($con, $sql) or die (mysqli_error());

$sql = "SELECT * FROM vsms_fuel_type group by fuel_type";
$fuel_type_data = mysqli_query($con, $sql) or die (mysqli_error());

$sql = "SELECT * FROM vsms_transmission where status=1 group by transmission";
$transmission_data = mysqli_query($con, $sql) or die (mysqli_error());

$sql = "SELECT * FROM vsms_street_state where status=1 group by street_state";
$state_data = mysqli_query($con, $sql) or die (mysqli_error());


if (strlen($_SESSION['adid']==0)) {

header('location:logout.php');

} else{



if(isset($_POST['submit']))

{

$rego=$_POST['rego'];

$make=$_POST['make'];

$model=$_POST['model'];

$model_code=$_POST['model_code'];

$model_series=$_POST['model_series'];

$vin=$_POST['vin'];

$engine_number=$_POST['engine_number'];

$fleet_code=$_POST['fleet_code'];

$transmission = $_POST['transmission'];

$ac=$_POST['ac'];

$body_type = $_POST['body_type'];

$colour = $_POST['colour'];
$seating_cap = $_POST['seating_cap'];
$odometer = $_POST['odometer'];
$hours = $_POST['hours'];
$drive_type = $_POST['drive_type'];
$engine_code = $_POST['engine_code'];
$chassis_no = $_POST['chassis_no'];
$fuel_type = $_POST['fuel_type'];
$rego_due_date = $_POST['hours'];
$wof_due_date = $_POST['wof_due_date'];
$build_date = $_POST['build_date'];
$prod_date = $_POST['prod_date'];
$last_in_date = $_POST['last_in_date'];
$last_service_date = $_POST['last_service_date'];
$next_service_date = $_POST['next_service_date'];
$next_service_kms = $_POST['next_service_kms'];
$service_interval = $_POST['service_interval'];
$cylinders = $_POST['cylinders'];
$litres = $_POST['litres'];
$fuel_induction = $_POST['fuel_induction'];
$tare_mass = $_POST['tare_mass'];
$radio_pin = $_POST['radio_pin'];
$key_code = $_POST['key_code'];
$tyre_size = $_POST['tyre_size'];
$imported_id = $_POST['imported_id'];
$state = $_POST['state'];
$note = $_POST['note'];
$status = 1; 

$query=mysqli_query($con, "insert into  vsms_vehicle(rego,make,model,model_code,model_series,vin,engine_number,fleet_code,transmission,ac,body_type,colour,seating_cap,odometer,hours,drive_type,engine_code,chassis_no,fuel_type,rego_due_date,wof_due_date,build_date,prod_date,last_in_date,last_service_date,next_service_date,next_service_kms,service_interval,cylinders,litres,fuel_induction,tare_mass,radio_pin,key_code,tyre_size,imported_id,state,note,status) value('$rego','$make','$model','$model_code','$model_series','$vin','$engine_number','$fleet_code',$transmission,'$ac',$body_type,'$colour',$seating_cap,$odometer,$hours,$drive_type,'$engine_code','$chassis_no',$fuel_type,'$rego_due_date','$wof_due_date','$build_date','$prod_date','$last_in_date','$last_service_date','$next_service_date','$next_service_kms','$service_interval',$cylinders,'$litres','$fuel_induction','$tare_mass','$radio_pin','$key_code','$tyre_size','$imported_id',$state,'$note',$status)");
$id = mysqli_insert_id($con);
if ($query) {
$msg="Add Vehicle has been added.";
}

else

{

  $msg="Something Went Wrong. Please try again";

}





}

?>

<!doctype html>

<html lang="en">



<head>

<meta charset="utf-8" />

<title>Vehicle Service Managment System</title>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />

<meta content="Coderthemes" name="author" />

<meta http-equiv="X-UA-Compatible" content="IE=edge" />



<!-- App favicon -->

<link rel="shortcut icon" href="assets/images/favicon.ico">



<!-- App css -->

<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<link href="assets/css/icons.css" rel="stylesheet" type="text/css" />

<link href="assets/css/metismenu.min.css" rel="stylesheet" type="text/css" />

<link href="assets/css/style.css" rel="stylesheet" type="text/css" />



<script src="assets/js/modernizr.min.js"></script>
</head>





<body>



<!-- Begin page -->

<div id="wrapper">



<?php include_once('includes/sidebar.php');?>



<!-- ============================================================== -->

<!-- Start right Content here -->

<!-- ============================================================== -->



<div class="content-page">



 <?php include_once('includes/header.php');?>



 <!-- Start Page content -->

 <div class="content">

    <div class="container-fluid">


        <div class="row">

            <div class="col-12">

                <div class="card-box">

                    <h4 class="m-t-0 header-title">Add Suppliers</h4>

                    <p class="text-muted m-b-30 font-14">



                    </p>



                    <div class="row">

                        <div class="col-12">

                            <div class="p-20">

                                <p style="font-size:16px; color:red" align="center"> <?php if($msg){

                                    echo $msg;

                                }  ?> </p>

                                <form class="form-horizontal" role="form" method="post" name="submit">
									<div class="form-group row">
                                     <label class="col-1 col-form-label" for="example-rdb-biller">Biller</label>
                                        <input type="checkbox" name="chk_biller" checked data-toggle="toggle" data-on="Non-Biller" data-off="Biller" id="biller" data-style="ios">
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-company-name">Company Name</label>
                                        <div class="col-5">
                                            <input type="text" class="form-control" name="company_name" required=""/>
                                        </div>
                                        <label class="col-1 col-form-label" for="example-biller" id="biller_lable">Biller</label>
                                        <div class="col-5" id="biller_div">
                                            <input type="text" class="form-control" name="biller" required=""/>
                                        </div>

                                    </div>

									<div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-address1">Address1</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="address1" required=""/>
                                        </div>
										<label class="col-1 col-form-label" for="example-address2">Address2</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="address2" required=""/>
                                        </div>
										<label class="col-1 col-form-label" for="example-suburb">Suburb</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="suburb" required=""/>
                                        </div>
                                    </div>

									<div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-state">State</label>
                                        <div class="col-3">
                                            <select class="form-control" name="state" id="state" required="">
                                            <option value="">State</option>
                                            <?php foreach($transmission_data as $key => $value){ ?>
                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['transmission']; ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
										
                                        <label class="col-1 col-form-label" for="example-post-code">Post Code</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="post_code" required=""/>
                                        </div>
										<label class="col-1 col-form-label" for="example-country-code">Country Code</label>
                                        <div class="col-3">
                                            <select class="form-control" name="country_code" id="country_code" required="">
                                            <option value="">Country Code</option>
                                            <?php foreach($transmission_data as $key => $value){ ?>
                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['transmission']; ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                        
                                    </div>

									<div class="form-group row">
                                    <label class="col-1 col-form-label" for="example-phone">Phone</label>
                                     <div class="col-3">
                                            <input type="text" class="form-control" name="phone" required=""/>
                                     </div>
									<label class="col-1 col-form-label" for="example-mobile">Mobile</label>
                                     <div class="col-3">
                                            <input type="text" class="form-control" name="mobile" required=""/>
                                     </div>
 									<label class="col-1 col-form-label" for="example-fax">Fax</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="fax" required=""/>
                                        </div>
									</div>	
									
									<div class="form-group row">                                    
                                        <label class="col-1 col-form-label" for="example-email">Email</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="email" required=""/>
                                        </div>
									     <label class="col-1 col-form-label" for="example-gst-number">GST Number</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="gst_number" required=""/>
                                        </div>
									     <label class="col-1 col-form-label" for="example-account-number">Account Number</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="account_number" required=""/>
                                        </div>                                  
                                    </div>
									
									<div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-imported-id">Imported Id</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="imported_id" required=""/>
                                        </div>
										<label class="col-1 col-form-label" for="example-payment-terms">Payment Terms</label>
                                        <div class="col-3">
                                            <select class="form-control" name="payment_terms" id="payment_terms">
                                            <option value="">Payment Terms</option>
                                            <?php foreach($drive_type_data as $key => $value){ ?>
                                            <option value="<?php echo $value['ID']; ?>"><?php echo $value['VehicleCat']; ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
										<label class="col-1 col-form-label" for="example-engine-code">Engine Code</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="engine_code" required=""/>
                                        </div>
                                    </div>
									
									<div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-note">Note</label>
                                        <div class="col-11">
                                            <textarea name="note" class="form-control" rows="5"></textarea>
                                        </div>
                                    </div>

									<label class="col-1 col-form-label" for="example-contact1">Contact1</label>
									<hr/>
									<div class="form-group row">                                    
                                        <label class="col-1 col-form-label" for="example-first-name1">First Name</label>
                                        <div class="col-5">
                                            <input type="text" class="form-control" name="first_name1" required=""/>
                                        </div>
									     <label class="col-1 col-form-label" for="example-last-name1">Last Name</label>
                                        <div class="col-5">
                                            <input type="text" class="form-control" name="last_name1" required=""/>
                                        </div>
                                    </div>
									
									<div class="form-group row">                                    
                                        <label class="col-1 col-form-label" for="example-position1">Position</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="position1" required=""/>
                                        </div>
									     <label class="col-1 col-form-label" for="example-phone1">Phone</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="phone1" required=""/>
                                        </div>
										 <label class="col-1 col-form-label" for="example-email1">Email</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="email1" required=""/>
                                        </div>
                                    </div>

									<label class="col-1 col-form-label" for="example-contact1">Contact2</label>
									<hr/>
									<div class="form-group row">                                    
                                        <label class="col-1 col-form-label" for="example-first-name2">First Name</label>
                                        <div class="col-5">
                                            <input type="text" class="form-control" name="first_name2" required=""/>
                                        </div>
									     <label class="col-1 col-form-label" for="example-last-name2">Last Name</label>
                                        <div class="col-5">
                                            <input type="text" class="form-control" name="last_name2" required=""/>
                                        </div>
                                    </div>
									
									<div class="form-group row">                                    
                                        <label class="col-1 col-form-label" for="example-position2">Position</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="position2" required=""/>
                                        </div>
									     <label class="col-1 col-form-label" for="example-phone2">Phone</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="phone2" required=""/>
                                        </div>
										 <label class="col-1 col-form-label" for="example-email2">Email</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="email2" required=""/>
                                        </div>
                                    </div>

									
                                   <div class="form-group row">

                                    <div class="col-12">
                                    <input type="hidden" name="id" value="<?php echo $data[0]['id']; ?>">
                                    <p style="text-align: center;"> <button type="submit" name="submit" class="btn btn-info btn-min-width mr-1 mb-1">Add</button></p>
                                    </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div> <!-- end card-box -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
        <!-- end row -->
    </div> <!-- container -->
</div> <!-- content -->
<?php include_once('includes/footer.php');?>
</div>
<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->
</div>
<!-- END wrapper -->
<!-- jQuery  -->

<script src="assets/js/jquery.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/metisMenu.min.js"></script>

<script src="assets/js/waves.js"></script>

<script src="assets/js/jquery.slimscroll.js"></script>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<!-- App js -->

<script src="assets/js/jquery.core.js"></script>

<script src="assets/js/jquery.app.js"></script>

<style type="text/css">
    #PTable td{
        width:20%;
    }
  .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
  .toggle.ios .toggle-handle { border-radius: 20px; }
  .toggle-off {background-color: #78cd51;}
</style>
</body>

</html>

<?php }  ?>