<?php

session_start();

error_reporting(0);

include('includes/dbconnection.php');

include('model/db.php');

$sql ='select * from vsms_job_status where status=1 group by job_status ';
$statement = $db->prepare($sql);
$statement->execute(); 
$job_status_data = $statement->fetchAll();

$sql ='select * from vsms_payment_terms where status=1 group by payment_terms ';
$statement = $db->prepare($sql);
$statement->execute(); 
$payment_terms_data = $statement->fetchAll();

$sql ='select * from vsms_product where status=1 group by item_code ';
$statement = $db->prepare($sql);
$statement->execute(); 
$products = $statement->fetchAll();

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

$grand_total = $_POST['grand_total'];

// $internal_invoice  =$_POST['internal_invoice'];

$payment_terms  =$_POST['payment_terms'];

$invoice_description  =$_POST['invoice_description'];

$status = 2; 
$id = $_POST['customer_booking_id'];
$query=mysqli_query($con, "update  vsms_customer_booking set customer=$customer,vehicle=$vehicle,invoice_no=$invoice_no,job_card_no=$job_card_no,post_date='$post_date',invoice_type='$invoice_type',account_type='$account_type',follow_up_date='$follow_up_date',odometer=$odometer,next_service=$next_service,job_status='$job_status',job_status_comment='$job_status_comment',status=$status,grand_total=$grand_total,payment_terms=$payment_terms,invoice_description='$invoice_description' where id=".$id);
if ($query) {
$product = $_REQUEST['product'];
$descriptions = $_REQUEST['descriptions'];
$unit_price = $_REQUEST['unit_price'];
$qty = $_REQUEST['qty'];
$gst = $_REQUEST['gst'];
$dis = $_REQUEST['dis'];
$total = $_REQUEST['total'];

$count = count($product);
if($count){
$sql ='delete from vsms_customer_booking_product where customer_booking_id='.$id;
$statement = $db->prepare($sql);
$statement->execute(); 
$job_status_data = $statement->fetchAll();    
}
$i =0;
while($i < $count){
$prod_query=mysqli_query($con, "insert into  vsms_customer_booking_product(customer_booking_id,product,description,unit_price,qty,gst,dis,total) value($id,'$product[$i]','$descriptions[$i]',$unit_price[$i],$qty[$i],$gst[$i],$dis[$i],$total[$i])");
$i++;
}
if($i == $count){
$msg="Customer Invoice has been added.";
}
}

else

{

  $msg="Something Went Wrong. Please try again";

}

}

if(!empty($_REQUEST['id'])){
$id=$_REQUEST['id'];
$sql ='select * from vsms_customer_booking where id='.$id;
$statement = $db->prepare($sql);
$statement->execute(); 
$data = $statement->fetchAll();

$sql ='select * from vsms_customer_booking_product where customer_booking_id='.$id;
$statement = $db->prepare($sql);
$statement->execute(); 
$product_data = $statement->fetchAll();
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

                    <h4 class="m-t-0 header-title">Add Customer Invoice</h4>

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

                                        <label class="col-2 col-form-label" for="example-email">Select A Customer *<br>
                                        <a href="add-customer.php"><i class="icon-plus" title="Add Customer"></i></a></label>
                                        
                                        <div class="col-10">
                                            <select class="form-control" name="customer" id="customer" required onchange="getCustomerDetails(this.value)"></select>
                                            <table id="customer_table" class="table table-responsive">
                                            <th>Customer Information</th>
                                            <th>Customer Contact</th>
                                            <th>Contact 1 Information</th>
                                            <tr>
                                            <td id="cust_name"></td>
                                            <td id="cust_mobile"></td>
                                            <td id="cust_email"></td>
                                            </tr>
                                            <tr>
                                            <td id="cust_state"></td>
                                            <td id="cust_phone"></td>
                                            <td></td>
                                            </tr>
                                            <tr>
                                            <td id="cust_postcode"></td>
                                            <td></td>
                                            <td></td>
                                            </tr>
                                            </table>
                                        </div>

                                    </div>



                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Select A Vehicle <br>
                                        <a href="add-vehicle.php"><i class="icon-plus" title="Add Vehicle"></i></a></label>
                                        <div class="col-10">
                                            <select class="form-control" name="vehicle" id="vehicle"></select>
                                        </div>
                                    </div>

                                    <b>Customer Invoice</b>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Invoice No.</label>
                                        <div class="col-4">
                                            <input type="text" name="invoice_no" class="form-control" value="<?php echo $data[0]['invoice_no']; ?>">
                                        </div>
                                        <label class="col-2 col-form-label" for="example-email">Job Card No.</label>
                                        <div class="col-4">
                                            <input type="text"  name="job_card_no" class="form-control" value="<?php echo $data[0]['job_card_no']; ?>">
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                       <!--  <label class="col-2 col-form-label" for="example-email">Order Number</label>
                                        <div class="col-4">
                                            <input type="text"  name="customer_order_number" class="form-control"  required="true" value="<?php //echo $data[0]['customer_order_number']; ?>">
                                        </div> -->
                                        <label class="col-2 col-form-label" for="example-email">Book Date</label>
                                        <div class="col-4">
                                            <input type="date"  name="post_date" class="form-control"  required="true" value="<?php echo  date('Y-m-d',strtotime($data[0]['post_date'])); ?>" onchange="getfollowupdate(this.value);">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Invoice Type</label>
                                        <div class="col-4">
                                            <select name="invoice_type" class="form-control"  required="true">
                                            <option value="Invoice" <?='Invoice' == $data[0]['invoice_type'] ? ' selected="selected"' : '';?>>Invoice</option>
                                            <option value="Credit" <?='Credit' == $data[0]['invoice_type'] ? ' selected="selected"' : '';?>>Credit</option>
                                            <option value="Quote"  <?='Quote' == $data[0]['invoice_type'] ? ' selected="selected"' : '';?>>Quote</option>
                                            </select>
                                        </div>

                                        <label class="col-2 col-form-label" for="example-email">Account Type</label>
                                        <div class="col-4">
                                        <input type="checkbox" name="account_type" checked data-toggle="toggle" data-on="Account" data-off="Cash" id="account" data-style="ios">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Follow Up Date</label>
                                        <div class="col-4">
                                            <input type="date"  id="follow_up_date"  name="follow_up_date" class="form-control"  required="true" value="<?php echo  date('Y-m-d',strtotime($data[0]['follow_up_date'])); ?>">
                                        </div>
                                        <label class="col-2 col-form-label" for="example-email">Odometer</label>
                                        <div class="col-4">
                                            <input type="number"  name="odometer" class="form-control"  required="true" value="<?php echo  $data[0]['odometer']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                     <!--    <label class="col-2 col-form-label" for="example-email">Hours</label>
                                        <div class="col-4">
                                            <input type="number"  name="hours" class="form-control"  required="true">
                                        </div> -->
                                        <label class="col-2 col-form-label" for="example-email">Next Service - KMs</label>
                                        <div class="col-10">
                                            <input type="number"  name="next_service" class="form-control"  required="true" value="<?php echo  $data[0]['next_service']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Job Status</label>
                                        <div class="col-4">
                                            <select  class="form-control" name="job_status">
                                            <option value="">Select Job Status</option>
                                            <?php foreach($job_status_data as $key => $value){?>
                                            <option value="<?php echo $value['id']; ?>" <?=$value['id'] == $data[0]['job_status'] ? ' selected="selected"' : '';?>><?php echo $value['job_status']; ?></option>
                                            <?php } ?>
                                            </select>                                        
                                        </div>
                                         <label class="col-2 col-form-label" for="example-email">Job Status Comment</label>
                                        <div class="col-4">
                                            <input type="text" name="job_status_comment" class="form-control"  required="true" value="<?php echo  $data[0]['job_status_comment']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                       <!--  <label class="col-2 col-form-label" for="example-email">Internal Invoice</label>
                                        <div class="col-4">
                                        <input type="checkbox" name="internal_invoice" checked data-toggle="toggle" data-on="Yes" data-off="No" id="internal_invoice" data-style="ios">                                        
                                        </div> -->
                                        <label class="col-2 col-form-label" for="example-email">Payment Terms</label>
                                        <div class="col-4">
                                            <select  class="form-control" name="payment_terms">
                                            <option value="">Select Payment Terms</option>
                                            <?php foreach($payment_terms_data as $key => $value){?>
                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['payment_terms']; ?></option>
                                            <?php } ?>
                                            </select>                                        
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="example-email">Description</label>
                                        <div class="col-10">
                                            <textarea  name="invoice_description" class="form-control"></textarea>
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
                                        <?php 
                                        $i = 0;
                                        foreach($product_data as $key => $value){?> 
                                        <tr id="rec-<?php echo $i; ?>">
                                          <td style="width: 5%"><i class="icon-trash delete-record"  onclick="deleteRow(this)" title="Remove Product" data-id="<?php echo $i; ?>"></i> <i class="icon-plus add-record"  title="Add Product"></i></td>
                                          <td><select class="form-control" name="product[]" id="product_<?php echo $i; ?>" required onchange="getProductDetails(this.value,<?php echo $i; ?>)">
                                          <?php foreach($products as $key1 => $value1){?>
                                          <option value="<?php echo $value['id']; ?>" <?=$value1['id']== $value['product'] ? ' selected="selected"' : '';?>><?php echo $value1['item_code']; ?></option>
                                          <?php } ?>
                                          </select>
                                         </td>
                                          <td><input type="text" id="description_<?php echo $i; ?>" name="descriptions[]" class="form-control" value="<?php echo $value['description'];?>"/></td>
                                          <td><input type="number" id="unit_price_<?php echo $i; ?>" name="unit_price[]" class="form-control" value="<?php echo $value['unit_price'];?>" /></td>
                                          <td style="width: 8%"><input type="number" id="qty_<?php echo $i; ?>" name="qty[]" class="form-control" onchange="getTotal(this.value,<?php echo $i; ?>)" value="<?php echo $value['qty'];?>"  /></td>
                                          <td style="width: 7%"><input type="number" id="dis_<?php echo $i; ?>" name="dis[]" class="form-control" onchange="getDiscount(this.value,<?php echo $i; ?>)" value="<?php echo $value['dis'];?>"/></td>
                                          <td style="width: 10%"><input type="number" step="0.01" id="total_<?php echo $i; ?>" name="total[]" class="form-control" value="<?php echo $value['total'];?>" /></td>
                                          <td ><input type="number" id="gst_<?php echo $i; ?>" name="gst[]" class="form-control" onchange="getTax(this.value,<?php echo $i; ?>)" value="15" value="<?php echo $value['gst'];?>" ></td>

                                        </tr>
                                        <?php $i++; }  ?>
                                        </tbody>
                                      </table>
                                     </div>

                                     <div class="col-12">
                                      <table class="table table-responsive">
                                      <tr>
                                      <td>Total</td>
                                      <td><span id="grand_total"></span><input type="hidden" id="grand_total_all" name="grand_total" value="<?php echo $data[0]['grand_total'] ?>" /></td>
                                      </table>
                                     </div>
                                    </div>
                                    <?php if($_REQUEST['show'] == 'yes'){ ?>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <input type="hidden" name="customer_booking_id" value="<?php echo $data[0]['id']; ?>">
                                            <p style="text-align: center;"> <button type="submit" name="submit" class="btn btn-info btn-min-width mr-1 mb-1">Save</button></p>
                                        </div>
                                    </div>
                                   <?php } ?>
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
$("#grand_total").text('<?php echo $data[0]['grand_total'];?>');
$("#customer_table").css("display","none");
var chk_account = '<?php echo $data[0]['account_type'];?>';
if(chk_account){
$('.toggle').removeClass('off');
}
else{
$('.toggle').addClass('off');
}

//customer
jQuery.ajax({

url:"model/getcustomername.php",

method:"POST",

success:function(data)

{
var data = jQuery.parseJSON(data);
console.log(data,'customer');
jQuery('#customer').empty();
jQuery('#customer').append(jQuery('<option>').text('Select Customer').attr('value', ''));
jQuery.each(data, function(i, value) {
jQuery('#customer').append(jQuery('<option>').text(value.first_name+' '+value.last_name).attr('value', value.id));
});
var cust_id = '<?php echo $data[0]['customer']; ?>';
if(cust_id){
jQuery('#customer option[value="'+cust_id+'"]').attr('selected', true);
}

}
});

//vehicle
jQuery.ajax({

url:"model/getvehicle.php",

method:"POST",

success:function(data)

{
var data = jQuery.parseJSON(data);
console.log(data,'vehicle');
jQuery('#vehicle').empty();
jQuery('#vehicle').append(jQuery('<option>').text('Select Vehicle').attr('value', ''));
jQuery.each(data, function(i, value) {
jQuery('#vehicle').append(jQuery('<option>').text(value.rego+' '+value.make).attr('value', value.id));
});
var vehicle = '<?php echo $data[0]['vehicle']; ?>';
if(vehicle){
jQuery('#vehicle option[value="'+vehicle+'"]').attr('selected', true);
}
}
});

//product
// var count_product = '<?php echo count($product_data); ?>';
// for(var i=0;i < count_product;)
// jQuery.ajax({

// url:"model/getproduct.php",

// method:"POST",

// success:function(data)

// {
// var data = jQuery.parseJSON(data);
// console.log(data,'product');
// jQuery('#product_0').empty();
// jQuery('#product_0').append(jQuery('<option>').text('Select Product').attr('value', ''));
// jQuery.each(data, function(i, value) {
// jQuery('#product_0').append(jQuery('<option>').text(value.item_code).attr('value', value.id));
// });
// }
// });
});

function getCustomerDetails(id){
if(id){
jQuery.ajax({

url:"model/getcustomerdetails.php",
method:"POST",
data:{customer_id:id},
success:function(data)

{
var data = jQuery.parseJSON(data);
var details = data['customer'][0];
console.log(details,'customer');
$("#customer_table").css("display","block");
$("#cust_name").text(details.first_name+' '+details.last_name);
$("#cust_mobile").text(details.mobile);
$("#cust_email").text(details.email);
$("#cust_state").text(details.state);
$("#cust_phone").text(details.phone);
$("#cust_postcode").text(details.postcode);
}
});
if(data && data['vehicle']){
console.log(data['vehicle'],'vehicle');
jQuery('#vehicle').empty();
jQuery('#vehicle').append(jQuery('<option>').text('Select Vehicle').attr('value', ''));
jQuery.each(data['vehicle'], function(i, value) {
jQuery('#vehicle').append(jQuery('<option>').text(value.rego+' '+value.make).attr('value', value.id));
});
}
}
$("#customer_table").css("display","none");
$("#cust_name").text('');
$("#cust_mobile").text('');
$("#cust_email").text('');
$("#cust_state").text('');
$("#cust_phone").text('');
$("#cust_postcode").text('');

}

// add row

var max_fields = 10; //Maximum allowed input fields 
var wrapper    = $(".wrapper"); //Input fields wrapper
var x = '<?php echo count($product_data); ?>';
console.log(x,'x');
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


  $(function() {
    $('#account').change(function() {
     if($(this).prop("checked") == true){
        $(".company").css("display","none");
        $(".company1").css("display","none");
        $("#company").val('-');
        $("#company1").val('-');
        $(".individual").css("display","block");
        }else{
        $(".company").css("display","block");
        $(".company1").css("display","none");
        $(".individual").css("display","none");
        $("#first_name").val('-');
        $("#last_name").val('-');
        $("#company1").val('-');
        }
    });
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