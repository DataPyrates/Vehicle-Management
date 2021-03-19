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

$model_code=$_POST['model_code']?$_POST['model_code']:'0';

$model_series=$_POST['model_series']?$_POST['model_series']:'0';

$vin=$_POST['vin'];

$engine_number=$_POST['engine_number'];

$fleet_code=$_POST['fleet_code']?$_POST['fleet_code']:'0';

$transmission = $_POST['transmission'];

$ac=$_POST['ac'];

$body_type = $_POST['body_type'];

$colour = $_POST['colour']?$_POST['colour']:'0';
$seating_cap = $_POST['seating_cap']?$_POST['seating_cap']:'0';
$odometer = $_POST['odometer'];
$hours = $_POST['hours']?$_POST['colour']:'0';
$drive_type = $_POST['drive_type']?$_POST['drive_type']:'0';
$engine_code = $_POST['engine_code'];
$chassis_no = $_POST['chassis_no'];
$fuel_type = $_POST['fuel_type'];
$rego_due_date = $_POST['rego_due_date'];
$wof_due_date = $_POST['wof_due_date'];
$build_date = $_POST['build_date']?$_POST['build_date']:'0';
$prod_date =$_POST['prod_date']?$_POST['prod_date']:'';
$last_in_date = $_POST['last_in_date'];
$last_service_date = $_POST['last_service_date'];
$next_service_date = $_POST['next_service_date'];
$next_service_kms = $_POST['next_service_kms'];
$service_interval = $_POST['service_interval']?$_POST['service_interval']:'0';
$cylinders =$_POST['cylinders']?$_POST['cylinders']:'0';
$litres = $_POST['litres'];
$fuel_induction = $_POST['fuel_induction'];
$tare_mass =$_POST['tare_mass']?$_POST['tare_mass']:'0';
$radio_pin = $_POST['radio_pin']?$_POST['radio_pin']:'0';
$key_code = $_POST['key_code'];
$tyre_size = $_POST['tyre_size'];
$imported_id = $_POST['imported_id']?$_POST['imported_id']:'0';
$state = $_POST['state'];
$note = $_POST['note'];
$status = 1; 

$query=mysqli_query($con, "insert into  vsms_vehicle(rego,make,model,model_code,model_series,vin,engine_number,fleet_code,transmission,ac,body_type,colour,seating_cap,odometer,hours,drive_type,engine_code,chassis_no,fuel_type,rego_due_date,wof_due_date,build_date,prod_date,last_in_date,last_service_date,next_service_date,next_service_kms,service_interval,cylinders,litres,fuel_induction,tare_mass,radio_pin,key_code,tyre_size,imported_id,state,note,status) value('$rego','$make','$model','$model_code','$model_series','$vin','$engine_number','$fleet_code',$transmission,'$ac',$body_type,'$colour',$seating_cap,$odometer,$hours,$drive_type,'$engine_code','$chassis_no',$fuel_type,'$rego_due_date','$wof_due_date','$build_date','$prod_date','$last_in_date','$last_service_date','$next_service_date','$next_service_kms','$service_interval',$cylinders,'$litres','$fuel_induction','$tare_mass','$radio_pin','$key_code','$tyre_size','$imported_id',$state,'$note',$status)");
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

                    <h4 class="m-t-0 header-title">Add Vehicle</h4>

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
                                        <label class="col-1 col-form-label" for="example-Rego">Rego</label>
                                        <div class="col-5">
                                            <input type="text" class="form-control" name="rego" required=""/>
                                        </div>
                                        <label class="col-1 col-form-label" for="example-make">Make</label>
                                        <div class="col-5">
                                            <input type="text" class="form-control" name="make" required=""/>
                                        </div>

                                    </div>

									<div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-model">Model</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="model" required=""/>
                                        </div>
										<!--<label class="col-1 col-form-label" for="example-model-code">Model Code</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="model_code" required=""/>
                                        </div>
										<label class="col-1 col-form-label" for="example-model-series">Model Series</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="model_series" required=""/>
                                        </div>-->
                                    </div>

									<div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-vin">VIN</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="vin" required=""/>
                                        </div>
                                        <label class="col-1 col-form-label" for="example-engine-number">Engine Number</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="engine_number" required=""/>
                                        </div>
										<!--<label class="col-1 col-form-label" for="example-fleet-code">Fleet Code</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="fleet_code" required=""/>
                                        </div>-->
                                        
                                    </div>

									<div class="form-group row">
                                    <label class="col-2 col-form-label" for="example-transmission">Transmission *</label>
                                        <div class="col-3">
                                            <select class="form-control" name="transmission" id="transmission" required="">
                                            <option value="">Select Transmission</option>
                                            <?php foreach($transmission_data as $key => $value){ ?>
                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['transmission']; ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
									<label class="col-1 col-form-label" for="example-AC">AC</label>
										<div class="col-2">
                                            <select class="form-control" name="ac" id="ac">
											<option value="Yes">Yes</option>
											<option value="No">No</option>
											</select>
                                        </div>
										<label class="col-1 col-form-label" for="example-body-type">Body Type *</label>
                                        <div class="col-3">
                                            <select class="form-control" name="body_type" id="body_type" required="">
                                            <option value="">Select Body Type</option>
                                            <?php foreach($body_type_data as $key => $value){ ?>
                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['body_type']; ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
									</div>	
									
									<div class="form-group row">
                                      <!--<label class="col-1 col-form-label" for="example-colour">Colour</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="colour" required=""/>
                                        </div>
                                        <label class="col-1 col-form-label" for="example-seating-cap">Seating Cap</label>
                                        <div class="col-3">
                                            <input type="number" class="form-control" name="seating_cap" required=""/>
                                        </div>-->
									     <label class="col-1 col-form-label" for="example-odometer">Odometer</label>
                                        <div class="col-3">
                                            <input type="number" class="form-control" name="odometer" required=""/>
                                        </div>
                                        <label class="col-1 col-form-label" for="example-engine-code">Engine Code</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="engine_code" required=""/>
                                        </div>
                                  
                                    </div>
								
									
									<div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-chasis-no">Chassis No</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="chassis_no" required=""/>
                                        </div>
										<label class="col-1 col-form-label" for="example-fuel-type">Fuel Type</label>
                                        <div class="col-3">
                                            <select class="form-control" name="fuel_type" id="fuel_type">
                                            <option value="">Select Fuel Type</option>
                                            <?php foreach($fuel_type_data as $key => $value){ ?>
                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['fuel_type']; ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
										<label class="col-1 col-form-label" for="example-rego-due-date">Rego Due Date</label>
                                        <div class="col-3">
                                            <input type="date"  name="rego_due_date" class="form-control"  required="true">
                                        </div>										
                                    </div>
																		                                 
                                    <div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-wof-due-date">WOF Due Date</label>
                                        <div class="col-3">
                                            <input type="date"  name="wof_due_date" class="form-control"  required="true">
                                        </div>
										<!--<label class="col-1 col-form-label" for="example-build-date">Build Date</label>
                                        <div class="col-3">
                                            <input type="date"  name="build_date" class="form-control"  required="true">
                                        </div>
										<label class="col-1 col-form-label" for="example-prod-date">Prod Date</label>
                                        <div class="col-3">
                                            <input type="date"  name="prod_date" class="form-control"  required="true">
                                        </div>-->
                                    </div>

									<div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-last-in-date">Last In Date</label>
                                        <div class="col-3">
                                            <input type="date"  name="last_in_date" class="form-control"  required="true">
                                        </div>
										<label class="col-1 col-form-label" for="example-last-service-date">Last Service Date</label>
                                        <div class="col-3">
                                            <input type="date"  name="last_service_date" class="form-control"  required="true">
                                        </div>
										<label class="col-1 col-form-label" for="example-next-service-date">Next Service Date</label>
                                        <div class="col-3">
                                            <input type="date"  name="next_service_date" class="form-control"  required="true">
                                        </div>
                                    </div>


									<div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-next-service-kms">Next Service - KMS</label>
                                        <div class="col-3">
                                            <input type="text"  name="next_service_kms" class="form-control"  required="true">
                                        </div>
										<!--<label class="col-1 col-form-label" for="example-service-interval">Service Interval</label>
                                        <div class="col-3">
                                            <input type="text"  name="service_interval" class="form-control"  required="true">
                                        </div>
										<label class="col-1 col-form-label" for="example-cylinders">Cylinders</label>
                                        <div class="col-3">
                                            <input type="number"  name="cylinders" class="form-control"  required="true">
                                        </div>-->
                                        <label class="col-1 col-form-label" for="example-key-code">State</label>
                                        <div class="col-3">
                                            <select name="state" class="form-control" id="state">
                                            <option value="">Select State</option>
                                            <?php foreach($state_data as $key => $value){ ?>
                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['street_state']; ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
									
									
									<div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-litres">Litres</label>
                                        <div class="col-3">
                                            <input type="text"  name="litres" class="form-control"  required="true">
                                        </div>
										<label class="col-1 col-form-label" for="example-fuel-induction">Fuel Induction</label>
                                        <div class="col-3">
                                            <input type="text"  name="fuel_induction" class="form-control"  required="true">
                                        </div>
										<!--<label class="col-1 col-form-label" for="example-tare-mass">Tare Mass</label>
                                        <div class="col-3">
                                            <input type="text"  name="tare_mass" class="form-control"  required="true">
                                        </div>-->
                                    </div>
									
									
									<div class="form-group row">
                                        <!--<label class="col-1 col-form-label" for="example-radio-pin">Radio Pin</label>
                                        <div class="col-3">
                                            <input type="text"  name="radio_pin" class="form-control"  required="true">
                                        </div>-->
										<label class="col-1 col-form-label" for="example-key-code">Key Code</label>
                                        <div class="col-3">
                                            <input type="text"  name="key_code" class="form-control"  required="true">
                                        </div>
										<label class="col-1 col-form-label" for="example-tyre-size">Tyre Size</label>
                                        <div class="col-3">
                                            <input type="text"  name="tyre_size" class="form-control"  required="true">
                                        </div>
                                    </div>


									
									<!-- <div class="form-group row"> -->
                                        <!--<label class="col-1 col-form-label" for="example-imported-id">Imported Id</label>
                                        <div class="col-3">
                                            <input type="text"  name="imported_id" class="form-control"  required="true">
                                        </div>-->
					
                                    <!-- </div> -->

									<div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-note">Note</label>
                                        <div class="col-11">
                                            <textarea name="note" class="form-control" rows="10"></textarea>
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

<!-- App js -->

<script src="assets/js/jquery.core.js"></script>

<script src="assets/js/jquery.app.js"></script>

<style type="text/css">
    #PTable td{
        width:20%;
    }
</style>
</body>

</html>

<?php }  ?>