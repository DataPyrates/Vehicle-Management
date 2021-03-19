<?php

session_start();

error_reporting(0);

include('includes/dbconnection.php');

$sql = "SELECT * FROM vsms_product where status=1";
$product = mysqli_query($con, $sql) or die (mysqli_error());

if (strlen($_SESSION['adid']==0)) {

header('location:logout.php');

} else{



if(isset($_POST['submit']))

{

$item_code=$_POST['item_code'];

$description=$_POST['description'];

// $description2=$_POST['description2'];

// $searchable_tags=$_POST['searchable_tags'];

// $groups=$_POST['groups'];

$supplier=$_POST['supplier'];

// $brand=$_POST['brand'];

$type=$_POST['type'];

// $qty_on_hand = $_POST['qty_on_hand'];

// $minimum=$_POST['minimum'];

// $maximum=$_POST['maximum'];

// $qty_location=$_POST['qty_location'];

// $upd_qty=$_POST['upd_qty'];

$gst = $_POST['gst'];

// $retail_price = $_POST['retail_price'];

$cost_excl_tax=$_POST['cost_excl_tax'];

// $cost_incl_tax=$_POST['cost_incl_tax'];

// $price2=$_POST['price2'];

// $price3 = $_POST['price3'];

// $price4 = $_POST['price4'];

// $imported_id = $_POST['imported_id'];

// $comment = $_POST['comment'];

// $job_card_comment = $_POST['job_card_comment'];

$status = 1; 

// $query=mysqli_query($con, "insert into  vsms_product(item_code,description,description2,searchable_tags,groups,supplier,brand,type,qty_on_hand,minimum,maximum,qty_location,upd_qty,gst,retail_price,cost_excl_tax,cost_incl_tax,price2,price3,price4,imported_id,comment,job_card_comment,status) value('$item_code','$description','$description2','$searchable_tags','$groups','$supplier','$brand','$type',$qty_on_hand,$minimum,$maximum,'$qty_location','$upd_qty','$gst',$retail_price,$cost_excl_tax,$cost_incl_tax,$price2,$price3,$price4,'$imported_id','$comment','$job_card_comment',$status)");
$query=mysqli_query($con, "insert into  vsms_product(item_code,description,supplier,type,gst,cost_excl_tax,status) value('$item_code','$description','$supplier','$type','$gst',$cost_excl_tax,$status)");
$id = mysqli_insert_id($con);
if ($query) {
$msg="Product has been added.";
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

                    <h4 class="m-t-0 header-title">Add Product</h4>

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
                                        <label class="col-2 col-form-label" for="example-item-code">Item Code *</label>
                                        <div class="col-4">
                                            <input type="text" class="form-control" name="item_code" required="" />
                                        </div>
                                        <label class="col-2 col-form-label" for="example-description">Description*</label>
                                        <div class="col-4">
                                            <input type="text" class="form-control" name="description" required="" />
                                        </div>
									<!-- 	<label class="col-1 col-form-label" for="example-description2">Description2</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="description2" />
                                        </div> -->
                                    </div>

									<div class="form-group row">
<!--                                         <label class="col-1 col-form-label" for="example-searchable-tags">Searchable Tags</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="searchable_tags" />
                                        </div>
										
										<label class="col-1 col-form-label" for="example-group">Group</label>
										<div class="col-3">
                                            <select class="form-control" name="groups" id="group">
											<option value="Filters">Filters</option>
											<option value="Oils">Oils</option>
											</select>
                                        </div> -->
										
										<label class="col-2 col-form-label" for="example-supplier">Supplier *</label>
                                        <div class="col-4">
                                            <input type="text" class="form-control" name="supplier" required="" />
                                        </div>										
                                    <!-- </div> -->

									<!-- <div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-brand">Brand</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="brand" />
                                    </div>
 -->										
                                        <label class="col-2 col-form-label" for="example-type">Type *</label>
										<div class="col-4">
                                            <select class="form-control" name="type" id="type" required="">
                                            <option value="">Select Type</option>
											<option value="Stocks">Stocks</option>
											<option value="Labour">Labour</option>
											<option value="Sublet Repairs">Sublet Repairs</option>
											<option value="Consumables">Consumables</option>
											<option value="Accessories">Accessories</option>
											<option value="Tyres">Tyres</option>
											</select>
                                        </div>

                                      <!--   <label class="col-1 col-form-label" for="example-qty-on-hand">Qty On Hand</label>
                                        <div class="col-3">
                                            <input type="number" class="form-control" name="qty_on_hand" />
                                        </div> -->										
									</div>	
	
									<div class="form-group row">
<!--                                         <label class="col-1 col-form-label" for="example-minimum">Minimum</label>
                                        <div class="col-1">
                                            <input type="number" class="form-control" name="minimum" />
                                        </div>
										
										<label class="col-1 col-form-label" for="example-maximum">Maximum</label>
                                        <div class="col-1">
                                            <input type="number" class="form-control" name="maximum" />
                                        </div>
										
										<label class="col-1 col-form-label" for="example-location">Location</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="qty_location" />
                                        </div>
										
										<label class="col-1 col-form-label" for="example-dont-upd-qty">Don't Upd. Qty</label>
                                        <div class="col-1" style="display: grid;">
                                            <input type="radio" name="upd_qty" value="Yes">Yes
                                            <input type="radio" name="upd_qty" value="No">No
                                        </div> -->
										
										<label class="col-2 col-form-label" for="example-gst-free">GST *</label>
                                        <div class="col-4" >
                                            <input type="radio" name="gst" value="Yes">Yes
                                            <input type="radio" name="gst" value="No">No
                                        </div>										
									<!-- </div>	
										
									<div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-reatil-price">Retail Price</label>
                                        <div class="col-3">
                                            <input type="number" class="form-control" name="retail_price" />
                                        </div> -->
										<label class="col-2 col-form-label" for="example-cost-excl-tax">Cost</label>
                                        <div class="col-4">
                                            <input type="number" class="form-control" name="cost_excl_tax" />
                                        </div>
									<!-- 	<label class="col-1 col-form-label" for="example-cost-incl-tax">Cost (Incl. Tax)</label>
                                        <div class="col-3">
                                            <input type="number" class="form-control" name="cost_incl_tax" />
                                        </div> -->
									</div>


								<!-- 	<div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-price2">Price2</label>
                                        <div class="col-3">
                                            <input type="number" class="form-control" name="price2" />
                                        </div>
										<label class="col-1 col-form-label" for="example-price3">Price3</label>
                                        <div class="col-3">
                                            <input type="number" class="form-control" name="price3" />
                                        </div>
										<label class="col-1 col-form-label" for="example-price4">Price4</label>
                                        <div class="col-3">
                                            <input type="number" class="form-control" name="price4" />
                                        </div>
									</div>	 -->
			
			
							<!-- 		<div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-imported-id">Imported Id</label>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="imported_id" />
                                        </div>
									</div>	

									<div class="form-group row">
                                        <label class="col-1 col-form-label" for="example-comment">Comment</label>
                                        <div class="col-5">
                                            <textarea name="comment" class="form-control" rows="6"></textarea>
                                        </div>
										<label class="col-1 col-form-label" for="example-job-card-comment">Job Card Comment</label>
                                        <div class="col-5">
                                            <textarea name="job_card_comment" class="form-control" rows="6"></textarea>
                                        </div>
                                    </div> -->

                                    <div class="form-group row">
                                        <div class="col-12">
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



<!-- App js -->

<script src="assets/js/jquery.core.js"></script>

<script src="assets/js/jquery.app.js"></script>

<script>
$(document).ready(function()
{
	$("#divTyreInfo").hide();
})

$('#type').on('change', function() {
  if( this.value == "Tyres" )
    $("#divTyreInfo").show();
  else 
	$("#divTyreInfo").hide();
});
</script>

 <style type="text/css">
    #PTable td{
        width:20%;
    }
</style>
</body>

</html>

<?php }  ?>