<?php

session_start();

error_reporting(0);

include('includes/dbconnection.php');

include('model/db.php');


$sql ='select * from vsms_street_state where status=1 group by street_state ';
$statement = $db->prepare($sql);
$statement->execute(); 
$street_state_data = $statement->fetchAll();

$sql ='select * from vsms_moc where status=1 group by moc ';
$statement = $db->prepare($sql);
$statement->execute(); 
$moc_data = $statement->fetchAll();

$sql ='select * from vsms_payment_terms where status=1 group by payment_terms ';
$statement = $db->prepare($sql);
$statement->execute(); 
$payment_terms_data = $statement->fetchAll();

if (strlen($_SESSION['adid']==0)) {

header('location:logout.php');

} else{



if(isset($_POST['submit']))

{

$first_name=$_POST['first_name']?$_POST['first_name']:'';

$last_name=$_POST['last_name']?$_POST['last_name']:'';

$company=$_POST['company']?$_POST['company']:'';

// $biller=$_POST['biller'];

$street_address_1=$_POST['street_address_1'];

$street_address_2="";//$_POST['street_address_2'];

$suburb=$_POST['suburb'];

$state=$_POST['state'];

$street_postcode = $_POST['street_postcode'];

// $postal_address_1=$_POST['postal_address_1'];

// $postal_address_2=$_POST['postal_address_2'];

// $postal_suburb=$_POST['postal_suburb'];

// $postal_state=$_POST['postal_state'];

// $postal_postcode = $_POST['postal_postcode'];

$phone=$_POST['phone'];

$mobile=$_POST['mobile'];

// $fax=$_POST['fax'];

$email=$_POST['email'];

$web = "";//$_POST['web'];

$method_of_contact=$_POST['method_of_contact'];

// $hourly_rate=$_POST['hourly_rate'];

// $discount=$_POST['discount'];

// $markup=$_POST['markup'];

$price_type = "";//$_POST['price_type'];

$payment_terms=$_POST['payment_terms'];

// $customer_source=$_POST['customer_source'];

// $imported_id=$_POST['imported_id'];

$gst_number=$_POST['gst_number'];

$gst_free = $_POST['gst_free'];

// $customer_limited=$_POST['customer_limited'];

// $first_name_1=$_POST['first_name_1'];

// $last_name_1=$_POST['last_name_1'];

// $position_1=$_POST['position_1'];

// $phone_1 = $_POST['phone_1'];

// $email_1 = $_POST['email_1'];

// $first_name_2=$_POST['first_name_2'];

// $last_name_2=$_POST['last_name_2'];

// $position_2=$_POST['position_2'];

// $phone_2 = $_POST['phone_2'];

// $email_2 = $_POST['email_2'];

// $first_name_3=$_POST['first_name_3'];

// $last_name_3=$_POST['last_name_3'];

// $position_3=$_POST['position_3'];

// $phone_3 = $_POST['phone_3'];

// $email_3 = $_POST['email_3'];

// $note = $_POST['note'];

$chk_account = $_POST['chk_account'];

// $chk_biller = $_POST['chk_biller'];

if($chk_account == 'on'){
  $method_of_contact = '';
}
$status = 1; 

// $query=mysqli_query($con, "insert into  vsms_customer(first_name,last_name,company,biller,street_address_1,street_address_2,suburb,state,street_postcode,postal_address_1,postal_address_2,postal_suburb,postal_state,postal_postcode,phone,mobile,fax,email,web,method_of_contact,hourly_rate,discount,markup,price_type,payment_terms,customer_source,imported_id,gst_number,gst_free,customer_limited,first_name_1,last_name_1,position_1,phone_1,email_1,first_name_2,last_name_2,position_2,phone_2,email_2,first_name_3,last_name_3,position_3,phone_3,email_3,note,status,chk_account,chk_biller) value('$first_name','$last_name','$company','$biller','$street_address_1','$street_address_2','$suburb',$state,$street_postcode,'$postal_address_1','$postal_address_2','$postal_suburb',$postal_state,$postal_postcode,'$phone','$mobile','$fax','$email','$web','$method_of_contact',$hourly_rate,$discount,$markup,'$price_type',$payment_terms,'$customer_source','$imported_id','$gst_number','$gst_free','$customer_limited','$first_name_1','$last_name_1','$position_1','$phone_1','$email_1','$first_name_2','$last_name_2','$position_2','$phone_2','$email_2','$first_name_3','$last_name_3','$position_3','$phone_3','$email_3','$note',$status,'$chk_account','$chk_biller')");
$id = $_REQUEST['id'];
if(empty($id)){
$query=mysqli_query($con, "insert into  vsms_customer(first_name,last_name,company,street_address_1,street_address_2,suburb,state,street_postcode,phone,mobile,email,web,price_type,payment_terms,gst_number,gst_free,method_of_contact,status,chk_account) value('$first_name','$last_name','$company','$street_address_1','$street_address_2','$suburb',$state,$street_postcode,'$phone','$mobile','$email','$web','$price_type',$payment_terms,'$gst_number','$gst_free','$method_of_contact',$status,'$chk_account')");
$msg_txt="Add Customer has been added.";

}
else{

$query=mysqli_query($con, "update  vsms_customer set first_name='$first_name',last_name='$last_name',company='$company',street_address_1='$street_address_1',street_address_2='$street_address_2',suburb='$suburb',state=$state,street_postcode=$street_postcode,phone='$phone',mobile='$mobile',email='$email',web='$web',price_type='$price_type',payment_terms=$payment_terms,gst_number='$gst_number',gst_free='$gst_free',method_of_contact='$method_of_contact',status=$status,chk_account='$chk_account' where id=$id");
$msg_txt = "Add Customer has been updated.";
}

if ($query) {

$msg=$msg_txt;

}

else

{

  $msg="Something Went Wrong. Please try again";

}


}

if(!empty($_REQUEST['id'])){
$id=$_REQUEST['id'];
$sql ='select * from vsms_customer where id='.$id;
$statement = $db->prepare($sql);
$statement->execute(); 
$data = $statement->fetchAll();
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
  
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9VQvDM-T1-IiT3RGiL38jhfbjW_UHDa8&libraries=places"></script>
</head>
<script type="text/javascript">
function initialize() {
   var latlng = new google.maps.LatLng(28.5355161,77.39102649999995);
   var map = new google.maps.Map(document.getElementById('map'), {
    center: latlng,
    zoom: 13
  });
   var marker = new google.maps.Marker({
    map: map,
    position: latlng,
    draggable: true,
    anchorPoint: new google.maps.Point(0, -29)
  });
   var input = document.getElementById('street_address_1');
   map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
   var geocoder = new google.maps.Geocoder();
   var autocomplete = new google.maps.places.Autocomplete(input);
   autocomplete.bindTo('bounds', map);
   var infowindow = new google.maps.InfoWindow();   
   autocomplete.addListener('place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
          map.fitBounds(place.geometry.viewport);
        } else {
          map.setCenter(place.geometry.location);
          map.setZoom(17);
        }
        document.getElementById('pick_loc').value = place.formatted_address;

        document.getElementById('lat').value = place.geometry.location.lat();
        
        document.getElementById('lng').value = place.geometry.location.lng();

        marker.setPosition(place.geometry.location);
        marker.setVisible(true);          

    });

   var input = document.getElementById('postal_address_1');
   map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
   var geocoder = new google.maps.Geocoder();
   var autocomplete = new google.maps.places.Autocomplete(input);
   autocomplete.bindTo('bounds', map);
   var infowindow = new google.maps.InfoWindow();   
   autocomplete.addListener('place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
          map.fitBounds(place.geometry.viewport);
        } else {
          map.setCenter(place.geometry.location);
          map.setZoom(17);
        }
        document.getElementById('drop_loc').value = place.formatted_address;

        document.getElementById('drop_lat').value = place.geometry.location.lat();
        
        document.getElementById('drop_lng').value = place.geometry.location.lng();

        marker.setPosition(place.geometry.location);
        marker.setVisible(true);          

    });
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
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

                    <h4 class="m-t-0 header-title">Add Customer</h4>

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
                                   <div class="col-6"></div>
                                   <div class="col-6">
                                    <input type="checkbox" name="chk_account" checked data-toggle="toggle" data-on="Individual" data-off="Company" id="account" data-style="ios">
                                     <!-- <input type="checkbox" name="chk_biller" checked data-toggle="toggle" data-on="Non-Biller" data-off="Biller" id="biller" data-style="ios"> -->
                                   </div>
                                   </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label individual" for="example-email">First Name *</label>
                                        <div class="col-4 individual">
                                            <input type="text" class="form-control" id="first_name" name="first_name" required="" value="<?php echo $data[0]['first_name'];?>">
                                        </div>
                                        <label class="col-2 col-form-label individual" for="example-email">Last Name *</label>
                                        <div class="col-4 individual">
                                            <input type="text" class="form-control" id="last_name" name="last_name" required="" value="<?php echo $data[0]['last_name'];?>">
                                        </div>
                                          <label class="col-2 col-form-label company" for="example-email">Company *</label>
                                        <div class="col-10 company">
                                            <input type="text" class="form-control" id="company" name="company" required="" value="<?php echo $data[0]['company'];?>">
                                        </div>
                                        <!--<label class="col-2 col-form-label company1"  for="example-email">Company *</label>
                                        <div class="col-10 company1">
                                            <input type="text" class="form-control" id="company1" name="company" required="">
                                        </div>
                                        <label class="col-1 col-form-label biller" for="example-email">Biller</label>
                                        <div class="col-3 biller">
                                            <input type="text" class="form-control" name="biller" placeholder="Choose A Biller">
                                        </div>-->
                                     </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Street Address 1 *</label>
                                        <div class="col-4">
                                            <input type="text" class="form-control" name="street_address_1" id="street_address_1" required="" value="<?php echo $data[0]['street_address_1'];?>">
                                                 <div id="map" style="margin: 0px;">
                                                <div id="infowindow-content">
                                                  <img src="" width="16" height="16" id="place-icon">
                                                  <span id="place-name"  class="title"></span><br>
                                                  <span id="place-address"></span>
                                                </div>
                                              </div>
                                          </div>
                                          
                                          <input type="hidden" name="lat" id="lat" value="" />
                                          <input type="hidden" name="lng" id="lng" value="" />
                                          <input type="hidden" name="pick_loc" id="pick_loc" value="" />
                      
                                        <!--<label class="col-2 col-form-label" for="example-email">Street Address 2 *</label>
                                        <div class="col-4">
                                            <input type="text" class="form-control" name="street_address_2" required="" value="<?php echo $data[0]['street_address_2'];?>">
                                        </div>-->
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Street Suburb *</label>
                                        <div class="col-2">
                                            <input type="text" class="form-control" name="suburb" required="" value="<?php echo $data[0]['suburb'];?>">
                                        </div>
                                        <label class="col-1 col-form-label" for="example-email">Street State *</label>
                                        <div class="col-3">
                                            <select  class="form-control" name="state" required="">
                                            <option value="">Select Street State</option>
                                            <?php foreach($street_state_data as $key => $value){?>
                                            <option value="<?php echo $value['id']; ?>" <?=$value['id'] == $data[0]['state'] ? ' selected="selected"' : '';?>><?php echo $value['street_state']; ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                        <label class="col-2 col-form-label" for="example-email">Street Postcode *</label>
                                        <div class="col-2">
                                            <input type="number" class="form-control" name="street_postcode" required="" value="<?php echo $data[0]['street_postcode'];?>">
                                        </div>
                                    </div>


                                   <!--  <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Postal Address 1</label>
                                        <div class="col-4">
                                            <input type="text" class="form-control" name="postal_address_1" id="
											">
                                          </div>
                                          
                                          <input type="hidden" name="drop_lat" id="drop_lat" value="" />
                                          <input type="hidden" name="drop_lng" id="drop_lng" value="" />
                                          <input type="hidden" name="drop_loc" id="drop_loc" value="" />

                                        <label class="col-2 col-form-label" for="example-email">Postal Address 2</label>
                                        <div class="col-4">
                                            <input type="text" class="form-control" name="postal_address_2" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-email">Postal Suburb</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="postal_suburb">
                                        </div>
                                        <label class="col-1 col-form-label" for="example-email">Postal State</label>
                                        <div class="col-3">
                                            <select  class="form-control" name="postal_state">
                                            <option value="">Select Postal State</option>
                                            <?php //foreach($street_state_data as $key => $value){?>
                                            <option value="<?php //echo $value['id']; ?>"><?php //echo $value['street_state']; ?></option>
                                            <?php //} ?>
                                            </select>
                                        </div>
                                        <label class="col-1 col-form-label" for="example-email">Postal Postcode</label>
                                        <div class="col-3">
                                            <input type="number" class="form-control" name="postal_postcode" >
                                        </div>
                                    </div> -->

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Phone *</label>
                                        <div class="col-4">
                                            <input type="text" class="form-control" name="phone" required="" value="<?php echo $data[0]['phone'];?>">
                                        </div>
                                        <label class="col-2 col-form-label" for="example-email">Mobile *</label>
                                        <div class="col-4">
                                            <input type="text" class="form-control" name="mobile" required="" value="<?php echo $data[0]['mobile'];?>">
                                        </div>
                                        <!-- <label class="col-1 col-form-label" for="example-email">Fax</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="fax" >
                                        </div> -->
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Email *</label>
                                        <div class="col-4">
                                            <input type="email" class="form-control" name="email" required="" value="<?php echo $data[0]['email'];?>">
                                        </div>
                                        <label class="col-2 col-form-label" for="example-email">Payment Terms *</label>
                                        <div class="col-4">
                                            <select class="form-control" name="payment_terms" required="">
                                            <option value="">Select Payment Terms</option>
                                            <?php foreach($payment_terms_data as $key => $value){?>
                                            <option value="<?php echo $value['id']; ?>" <?=$value['id'] == $data[0]['payment_terms'] ? ' selected="selected"' : '';?>><?php echo $value['payment_terms']; ?></option>
                                            <?php } ?>
                                            </select>                                        
                                        </div>
                                        <!--<label class="col-2 col-form-label" for="example-email">Web</label>
                                        <div class="col-4">
                                            <input type="text" class="form-control" name="web" value="<?php echo $data[0]['web'];?>">
                                        </div>-->
                                    
                                    </div>

                                    <!--<div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-email">Hourly Rate</label>
                                        <div class="col-3">
                                            <input type="number" class="form-control" name="hourly_rate">
                                        </div>
                                        <label class="col-1 col-form-label" for="example-email">Discount</label>
                                        <div class="col-3">
                                            <input type="number" class="form-control" name="discount" >
                                        </div>
                                        <label class="col-1 col-form-label" for="example-email">Markup</label>
                                        <div class="col-3">
                                            <input type="number" class="form-control" name="markup" >
                                        </div>
                                    </div> -->

                                    <div class="form-group row"> 
                                        <!--<label class="col-2 col-form-label" for="example-email">Price Type *</label>
                                        <div class="col-4">
                                            <select class="form-control" name="price_type" required="">
                                             <option value="">Select Price Type</option>
                                             <option value="Retail" <?='Retail' == $data[0]['price_type'] ? ' selected="selected"' : '';?>>Retail</option>
                                             <option value="Price_2" <?='Price_2' == $data[0]['price_type'] ? ' selected="selected"' : '';?>>Price 2</option>
                                             <option value="Price_3" <?='Price_3' == $data[0]['price_type'] ? ' selected="selected"' : '';?>>Price 3</option>
                                             <option value="Price_4" <?='Price_4' == $data[0]['price_type'] ? ' selected="selected"' : '';?>>Price 3</option>>Price 4</option>
                                            </select>
                                        </div>-->

                                        <!-- <label class="col-1 col-form-label" for="example-email">Customer Source</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="customer_source" >
                                        </div> -->
                                    </div>

                                     <div class="form-group row">
                                       <!--  <label class="col-1 col-form-label" for="example-email">Imported ID</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="imported_id">
                                        </div> -->
                                        <label class="col-2 col-form-label company" for="example-email" title="Preferred Method Of Contact">Preferred MOC *</label>
                                        <div class="col-4 company">
                                            <select class="form-control" name="method_of_contact" required="">
                                            <!-- <option value="">Select Method Of Contact</option> -->
                                            <?php foreach($moc_data as $key => $value){?>
                                            <option value="<?php echo $value['id']; ?>" <?=$value['id'] == $data[0]['method_of_contact'] ? ' selected="selected"' : '';?>><?php echo $value['moc']; ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                        <label class="col-2 col-form-label company" for="example-email">GST Number *</label>
                                        <div class="col-4 company">
                                            <input type="text" class="form-control" name="gst_number" id="gst_number" required="" value="<?php echo $data[0]['gst_number'];?>">
                                        </div>
                                  <!--       <label class="col-1 col-form-label" for="example-email">GST Free</label>
                                        <div class="col-1" style="display: grid;">
                                            <input type="radio" name="gst_free" value="Yes">Yes
                                            <input type="radio" name="gst_free" value="No">No
                                        </div>
                                         <label class="col-1 col-form-label" for="example-email">Customer Limited</label>
                                        <div class="col-1" style="display: grid;">
                                            <input type="radio" name="customer_limited" value="Yes">Yes
                                            <input type="radio" name="customer_limited" value="No">No
                                        </div> -->
                                    </div>

<!--                                     <b>Contact 1</b>
                                    <div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-email">First Name</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="first_name_1">
                                        </div>
                                        <label class="col-1 col-form-label" for="example-email">Last Name</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="last_name_1" >
                                        </div>
                                        <label class="col-1 col-form-label" for="example-email">Position</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="position_1" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-email">Phone</label>
                                        <div class="col-4">
                                            <input type="text" class="form-control" name="phone_1">
                                        </div>
                                        <label class="col-1 col-form-label" for="example-email">Email</label>
                                        <div class="col-4">
                                            <input type="text" class="form-control" name="email_1" >
                                        </div>
                                    </div>

                                    <b>Contact 2</b>
                                    <div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-email">First Name</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="first_name_2">
                                        </div>
                                        <label class="col-1 col-form-label" for="example-email">Last Name</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="last_name_2" >
                                        </div>
                                        <label class="col-1 col-form-label" for="example-email">Position</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="position_2" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Phone</label>
                                        <div class="col-4">
                                            <input type="text" class="form-control" name="phone_2">
                                        </div>
                                        <label class="col-2 col-form-label" for="example-email">Email</label>
                                        <div class="col-4">
                                            <input type="text" class="form-control" name="email_2" >
                                        </div>
                                    </div>

                                    <b>Contact 3</b>
                                    <div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-email">First Name</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="first_name_3">
                                        </div>
                                        <label class="col-1 col-form-label" for="example-email">Last Name</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="last_name_3" >
                                        </div>
                                        <label class="col-1 col-form-label" for="example-email">Position</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="position_3" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Phone</label>
                                        <div class="col-4">
                                            <input type="text" class="form-control" name="phone_3">
                                        </div>
                                        <label class="col-2 col-form-label" for="example-email">Email</label>
                                        <div class="col-4">
                                            <input type="text" class="form-control" name="email_3" >
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Note</label>
                                        <div class="col-10">
                                            <textarea class="form-control" name="note"></textarea>
                                        </div>
                                    </div> -->


                                    <div class="form-group row">
                                        <div class="col-12">
                                            <input type="hidden" name="id" value="<?php echo $data[0]['id']; ?>">
                                            <p style="text-align: center;"> <button type="submit" name="submit" class="btn btn-info btn-min-width mr-1 mb-1">Save</button></p>
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

<script type="text/javascript">

  $(function() {
     $('#account').change(function() {
      if($(this).prop("checked") == true){
         $(".company").css("display","none");
  //     $(".company1").css("display","none");
         $("#company").val('-');
         $("#gst_number").val('-');
  //       $("#company1").val('-');
         $(".individual").css("display","block");
        $("#first_name").val('');
        $("#last_name").val('');
         }else{
         $(".company").css("display","block");
  //       $(".company1").css("display","none");
        $(".individual").css("display","none");
        $("#first_name").val('-');
        $("#last_name").val('-');
        $("#company").val('');
        $("#gst_number").val('');
  //       $("#company1").val('-');
        }
    });
  //   $('#biller').change(function() {
  //    if($(this).prop("checked") == true){
  //       $(".company").css("display","block");
  //       $(".company1").css("display","none");
  //       $("#first_name").val('-');
  //       $("#last_name").val('-');
  //       $("#company1").val('-');
  //       $(".biller").css("display","block");
  //       }else{
  //       $(".individual").css("display","none");
  //       $(".company").css("display","none");
  //       $(".company1").css("display","block");
  //       $(".biller").css("display","none");
  //       $("#first_name").val('-');
  //       $("#last_name").val('-');
  //       $("#company").val('-');
  //       }
  //   });
  });

$(document).ready(function(){
$(".company").css("display","none");
// $(".company1").css("display","none");
$("#company").val('-');
$("#gst_number").val('-');
// $("#company1").val('-');
var chk_account = '<?php echo $data[0]['chk_account'];?>';
if(chk_account){
console.log('if');
$('.toggle').removeClass('off');
$(".company").css("display","none");
$(".individual").css("display","block");
var first_name = '<?php echo $data[0]['first_name'];?>';
$("#first_name").val(first_name);
var last_name = '<?php echo $data[0]['last_name'];?>';
$("#last_name").val(last_name);
}
else{
console.log('else');
$('.toggle').addClass('off');
$(".company").css("display","block");
$(".individual").css("display","none");
$("#first_name").val('-');
$("#last_name").val('-');
var company = '<?php echo $data[0]['company'];?>';
$("#company").val(company);
var gst_number = '<?php echo $data[0]['gst_number'];?>';
$("#gst_number").val(gst_number);
}
});
</script>
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