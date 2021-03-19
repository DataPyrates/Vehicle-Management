<?php

session_start();

error_reporting(0);

include('includes/dbconnection.php');

include('model/db.php');

$cust_id = $_REQUEST['cust_id'];



$sql ='select * from vsms_job_status where status=1 group by job_status ';
$statement = $db->prepare($sql);
$statement->execute(); 
$job_status_data = $statement->fetchAll();

$sql = "SELECT * FROM vsms_product where status=1";
$product = mysqli_query($con, $sql) or die (mysqli_error());

if (strlen($_SESSION['adid']==0)) {

header('location:logout.php');

} else{



if(isset($_POST['submit']))

{

$customer=$_POST['customer'];

$vehicle=$_POST['vehicle'];

// $customer_order_number=$_POST['customer_order_number'];

$booking_date=$_POST['booking_date'];

$due_by=$_POST['due_by'];

$description=$_POST['description'];

$invoice_no = $_POST['invoice_no'];

$job_card_no = $_POST['job_card_no'];

$post_date = $_POST['post_date'];

$invoice_type = $_POST['invoice_type'];

$account_type = $_POST['account_type'];

$follow_up_date = $_POST['follow_up_date'];

$odometer = $_POST['odometer'];

$next_service = $_POST['next_service'];

$job_status = $_POST['job_status'];

$job_status_comment = $_POST['job_status_comment'];

$event_notes=$_POST['event_notes'];

$job_card_notes=$_POST['job_card_notes'];

$grand_total = $_POST['grand_total'];

$status = 1; 

$query=mysqli_query($con, "insert into  vsms_customer_booking_dummy(customer,vehicle,booking_date,due_by,description,invoice_no,job_card_no,post_date,invoice_type,account_type,follow_up_date,odometer,next_service,job_status,job_status_comment,event_notes,job_card_notes,status,grand_total) value('$customer','$vehicle','$booking_date','$due_by','$description',$invoice_no,$job_card_no,'$post_date','$invoice_type','$account_type','$follow_up_date',$odometer,$next_service,'$job_status','$job_status_comment','$event_notes','$job_card_notes',$status,$grand_total)");
$id = mysqli_insert_id($con);
if ($query) {
$product = $_REQUEST['product'];
$descriptions = $_REQUEST['descriptions'];
$unit_price = $_REQUEST['unit_price'];
$qty = $_REQUEST['qty'];
$gst = $_REQUEST['gst'];
$dis = $_REQUEST['dis'];
$total = $_REQUEST['total'];

$count = count($product);
$i =0;
while($i < $count){
$prod_query=mysqli_query($con, "insert into  vsms_customer_booking_product_dummy(customer_booking_id,product,description,unit_price,qty,gst,dis,total) value($id,'$product[$i]','$descriptions[$i]',$unit_price[$i],$qty[$i],$gst[$i],$dis[$i],$total[$i])");
$i++;
}
if($i == $count){
$msg="Invoice has been added.";
}
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

                    <h4 class="m-t-0 header-title">Add Invoice</h4>

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
                                       <label class="col-2 col-form-label" for="example-email">Select A Customer *</label>                                     
                                        <div class="col-10">
                                            <input type="text" class="form-control" name="customer" required >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Select A Vehicle</label>
                                        <div class="col-10">
                                            <input type="text" class="form-control" name="vehicle">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Booking Date</label>
                                        <div class="col-10">
                                            <input type="date"  name="booking_date" class="form-control"  required="true">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Due By</label>
                                        <div class="col-10">
                                            <input type="date"  name="due_by" class="form-control"  required="true">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Description</label>
                                        <div class="col-10">
                                            <input type="text"  name="description" class="form-control"  required="true">
                                        </div>
                                    </div>

                                  <b>Customer Invoice</b>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Invoice No.</label>
                                        <div class="col-4">
                                            <input type="text" name="invoice_no" class="form-control">
                                        </div>
                                        <label class="col-2 col-form-label" for="example-email">Job Card No.</label>
                                        <div class="col-4">
                                            <input type="text"  name="job_card_no" class="form-control">
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Book Date</label>
                                        <div class="col-4">
                                            <input type="date"  name="post_date" class="form-control"  required="true" onchange="getfollowupdate(this.value);">
                                        </div>

                                        <label class="col-2 col-form-label" for="example-email">Invoice Type</label>
                                        <div class="col-4">
                                            <select name="invoice_type" class="form-control"  required="true">
                                            <option value="Invoice">Invoice</option>
                                            <option value="Credit">Credit</option>
                                            <option value="Quote">Quote</option>
                                            </select>
                                        </div>
                                        </div>

                                        <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Account Type</label>
                                        <div class="col-4">
                                        <input type="checkbox" name="account_type" checked data-toggle="toggle" data-on="Account" data-off="Cash" id="account" data-style="ios">
                                        </div>

                                        <label class="col-2 col-form-label" for="example-email">Follow Up Date</label>
                                        <div class="col-4">
                                            <input type="date"  id="follow_up_date" name="follow_up_date" class="form-control"  required="true">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Odometer</label>
                                        <div class="col-4">
                                            <input type="number"  name="odometer" class="form-control"  required="true">
                                        </div>
                          
                                        <label class="col-2 col-form-label" for="example-email">Next Service - KMs</label>
                                        <div class="col-4">
                                            <input type="number"  name="next_service" class="form-control"  required="true">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Job Status</label>
                                        <div class="col-4">
                                            <select  class="form-control" name="job_status">
                                            <option value="">Select Job Status</option>
                                            <?php foreach($job_status_data as $key => $value){?>
                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['job_status']; ?></option>
                                            <?php } ?>
                                            </select>                                        
                                        </div>
                                         <label class="col-2 col-form-label" for="example-email">Job Status Comment</label>
                                        <div class="col-4">
                                            <input type="text" name="job_status_comment" class="form-control"  required="true">
                                        </div>
                                    </div>
                                   <a href="add-product.php" target="_blank" class="btn btn-info" style="margin-bottom: 1%;">Add Product</a>
                                    <div class="form-group row">
                                     <div class="col-12">
                                      <table id="PTable" class="table table-responsive" >
                                        <thead>
                                        <tr>
                                          <td style="width: 5%">#</td>
                                          <td>PRODUCT</td>
                                          <td>DESCRIPTION</td>
                                          <td>UNIT PRICE</td>
                                          <td style="width: 6%">QTY</td>
                                          <td style="width: 7%">Discount</td> 
                                          <td style="width: 7%">Total</td>
                                          <td>GST</td>
                                        </tr>
                                        </thead>
                                        <tbody class="wrapper"> 
                                        <tr id="rec-0">
                                          <td style="width: 5%"><i class="icon-trash delete-record"  onclick="deleteRow(this)" title="Remove Product" data-id="0"></i> <i class="icon-plus add-record"  title="Add Product"></i></td>
                                          <td><select class="form-control" name="product[]" id="product_0" required onchange="getProductDetails(this.value,0)"></select></td>
                                          <td><input type="text" id="description_0" name="descriptions[]" class="form-control" /></td>
                                          <td><input type="number" id="unit_price_0" name="unit_price[]" class="form-control"  /></td>
                                          <td style="width: 8%"><input type="number" id="qty_0" name="qty[]" class="form-control" onchange="getTotal(this.value,0)" /></td>
                                          <td style="width: 7%"><input type="number" id="dis_0" name="dis[]" class="form-control" onchange="getDiscount(this.value,0)" /></td>
                                          <td style="width: 10%"><input type="number" step="0.01" id="total_0" name="total[]" class="form-control" /></td>
                                       <td ><input type="number" id="gst_0" name="gst[]" class="form-control" onchange="getTax(this.value,0)" value="15" /></td>

                                        </tr>
                                        </tbody>
                                      </table>
                                     </div>

                                     <div class="col-12">
                                      <table class="table table-responsive">
                                      <tr>
                                      <td>Total</td>
                                      <td><span id="grand_total"></span><input type="hidden" id="grand_total_all" name="grand_total" /></td>
                                      </table>
                                     </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Event Notes</label>
                                        <div class="col-10">
                                            <textarea  name="event_notes" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Job Card Notes</label>
                                        <div class="col-10">
                                            <textarea  name="job_card_notes" class="form-control"></textarea>
                                        </div>
                                    </div>
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

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<!-- App js -->

<script src="assets/js/jquery.core.js"></script>

<script src="assets/js/jquery.app.js"></script>

<script type="text/javascript">
$(document).ready(function(){

//product
jQuery.ajax({

url:"model/getproduct.php",

method:"POST",

success:function(data)

{
var data = jQuery.parseJSON(data);
console.log(data,'product');
jQuery('#product_0').empty();
jQuery('#product_0').append(jQuery('<option>').text('Select Product').attr('value', ''));
jQuery.each(data, function(i, value) {
jQuery('#product_0').append(jQuery('<option>').text(value.item_code).attr('value', value.id));
});
}
});

$('#product_0').focus(function() {
jQuery.ajax({

url:"model/getproduct.php",

method:"POST",

success:function(data)

{
var data = jQuery.parseJSON(data);
console.log(data,'product');
jQuery('#product_0').empty();
jQuery('#product_0').append(jQuery('<option>').text('Select Product').attr('value', ''));
jQuery.each(data, function(i, value) {
jQuery('#product_0').append(jQuery('<option>').text(value.item_code).attr('value', value.id));
});
}
});
});

});


// add row

var max_fields = 10; //Maximum allowed input fields 
var wrapper    = $(".wrapper"); //Input fields wrapper
var x = 1; //Initial input field is set to 1
$(document).delegate('.add-record', 'click', function(e) {
jQuery.ajax({

url:"model/getproduct.php",

method:"POST",

success:function(data)

{
var data = jQuery.parseJSON(data);
console.log(data,'product');
jQuery('#product_'+x).empty();
jQuery('#product_'+x).append(jQuery('<option>').text('Select Product').attr('value', ''));
jQuery.each(data, function(i, value) {
jQuery('#product_'+x).append(jQuery('<option>').text(value.item_code).attr('value', value.id));
});
}
});

if(x < max_fields){ 
            x++; 
            var  data ='<tr id="rec-'+x+'">';
            data +='<td style="width: 5%"><i class="icon-trash delete-record"  onclick="deleteRow(this)" title="Remove Product" data-id="'+x+'"></i> <i class="icon-plus add-record"  title="Add Product"></i></td>';
            data +='<td><select class="form-control" name="product[]" id="product_'+x+'" required onchange="getProductDetails(this.value,'+x+')"></select></td>';
            data +='<td><input type="text" id="description_'+x+'" name="descriptions[]" class="form-control" /></td>';
            data +='<td><input type="number" id="unit_price_'+x+'" name="unit_price[]" class="form-control" /></td>';
            data +='<td style="width: 8%"><input type="number" id="qty_'+x+'" name="qty[]" class="form-control" onchange="getTotal(this.value,'+x+')" /></td>';
            data +='<td style="width: 7%"><input type="number" id="dis_'+x+'" name="dis[]" class="form-control" onchange="getDiscount(this.value,'+x+')" /></td>';
            data +='<td style="width: 10%"><input type="number" id="total_'+x+'" step="0.01" name="total[]" class="form-control" /></td>';
            data +='<td><input type="number" id="gst_'+x+'" name="gst[]" class="form-control" onchange="getTax(this.value,'+x+')" value="15"/></td>';
            data +='</tr>';
            $(wrapper).append(data);
        }
});

// delete row
jQuery(document).delegate('.delete-record', 'click', function(e) {
     e.preventDefault();    
     var didConfirm = confirm("Are you sure You want to delete");
     if (didConfirm == true) {
      var id = jQuery(this).attr('data-id');
      var targetDiv = jQuery(this).attr('targetDiv');
      jQuery('#rec-' + id).remove();
    
    return true;
  } else {
    return false;
  }
});

function getfollowupdate(book_date){
var b_date = new Date(book_date);
var follow_up_date = b_date.setMonth(b_date.getMonth() + 3);
follow_up_date = new Date(follow_up_date);
var year = follow_up_date.getFullYear();
var month = ("0" + (follow_up_date.getMonth() + 1)).slice(-2);
var day = ("0" + follow_up_date.getDate()).slice(-2);
$("#follow_up_date").val(year+'-'+month+'-'+day);
}

function getProductDetails(prod_id,index){
jQuery.ajax({
url:"model/getproductdetailsbyid.php",
method:"POST",
data:{prod_id:prod_id},
success:function(data)
{
var data = jQuery.parseJSON(data);
console.log(data,'product details');
$("#unit_price_"+index).val(data[0].cost_excl_tax);
$("#description_"+index).val(data[0].description);
$("#dis_"+index).val('');
$("#total_"+index).val('');
$("#qty_"+index).val('');
}
});
}

function getTotal(qty,index){
var total = ($("#unit_price_"+index).val())*($("#qty_"+index).val())+((($("#unit_price_"+index).val())*($("#qty_"+index).val()))*($("#gst_"+index).val())/100);
$("#total_"+index).val(Math.round(total));
var grand_total = $("input[name^='total']").map(function (idx, ele) {                 
   return $(ele).val();}).get();
var totals =eval(grand_total.join("+"));
console.log(totals);
$("#grand_total").text(Math.round(totals));
$("#grand_total_all").val(Math.round(totals));
}

function getDiscount(dis,index){
var total = ($("#unit_price_"+index).val())*($("#qty_"+index).val())+((($("#unit_price_"+index).val())*($("#qty_"+index).val()))*($("#gst_"+index).val())/100);
var total_dis = total - (total*(dis/100));
$("#total_"+index).val(Math.round(total_dis));
var grand_total = $("input[name^='total']").map(function (idx, ele) {                 
   return $(ele).val();}).get();
var totals =eval(grand_total.join("+"));
console.log(totals);
$("#grand_total").text(Math.round(totals));
$("#grand_total_all").val(Math.round(totals));	
}

function getTax(tax,index){
var total = ($("#unit_price_"+index).val())*($("#qty_"+index).val())+((($("#unit_price_"+index).val())*($("#qty_"+index).val()))*tax/100);
var dis = $("#dis_"+index).val();
var total_dis = total - (total*(dis/100));
$("#total_"+index).val(Math.round(total_dis));
var grand_total = $("input[name^='total']").map(function (idx, ele) {                 
   return $(ele).val();}).get();
var totals =eval(grand_total.join("+"));
console.log(totals);
$("#grand_total").text(Math.round(totals));
$("#grand_total_all").val(Math.round(totals));  
}


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