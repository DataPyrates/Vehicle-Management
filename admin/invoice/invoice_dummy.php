<?php 
include('../model/db.php');
$sql ='select * from vsms_inv_logo where id=1';
$statement = $db->prepare($sql);
$statement->execute(); 
$logo_data = $statement->fetchAll();
if(!empty($_REQUEST['id'])){
$sql ='select b.*	 from vsms_customer_booking_dummy b where b.id='.$_REQUEST['id'];
$statement = $db->prepare($sql);
$statement->execute(); 
$inv_data = $statement->fetchAll();

$sql1='select b.*,p.item_code from vsms_customer_booking_product_dummy b join vsms_product p on b.product = p.id where b.customer_booking_id='.$_REQUEST['id'];
$statement = $db->prepare($sql1);
$statement->execute(); 
$prdouct_data = $statement->fetchAll();
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Vsms Invoice</title>
	
	<link rel='stylesheet' type='text/css' href='css/style.css' />
	<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
	<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='js/example.js'></script>
  <style type="text/css">
    #meta {
    margin-top: 0%;
    float: unset;
   }
  </style>

</head>

<body id="print">

	<div id="page-wrap">

		<textarea id="header" style="height: 30px;width: 100%;margin: 20px 0;
    background: #222;text-align: center;color: white;font: bold 15px Helvetica, Sans-Serif;
    text-decoration: uppercase;letter-spacing: 20px;padding: 8px 0px;">INVOICE</textarea>
		
		<div id="identity">
      
			<p id="address1">
       <?php if(!empty($logo_data[0]['inv_logo'])){ ?>      
       <img id="image" src="../<?php echo $logo_data[0]['inv_logo']; ?>" alt="logo" />
       <?php } ?></p>
      <p id="address">GEM AUTOMOTIVE<br>
			www.gemautomotive.co.nz<br>
			Phone : 09 391 7700<br>
			Email : glenedenmech@gmail.com<br>
      </p>
           
      <div id="logo">
            <p id="address2">
            <p>Tax Invoice </p>
            <p>GST Reg. Number: 121-248-455</p>
            </p>
            <p class="logo_det">GEM AUTOMOTIVE </p>
            <p>5/369 West Coast Road</p>
            <p>Glen Eden </p>
		        <p>Auckland 06020</p>
      </div>
		 
      </div>
  
      <div style="clear:both"></div>
      <div id="customer">
      	<table id="meta1" class="meta2" style="float: right;">
        <caption>Ship To</caption>
        <tr>
      	<td class="meta-head">Name</td><td><?php echo $inv_data[0]['customer']; ?></td>
      	</tr>
   <!--      <tr>
        <td class="meta-head">Email</td><td><?php //echo $inv_data[0]['email']; ?></td>
        </tr>
        <tr><td class="meta-head">Phone</td><td><?php // echo $inv_data[0]['phone']; ?></td>
        </tr>
 -->        
        </table>
        <br>
<!--         <table  id="meta1">
        <caption>Bill To</caption>
      	<tr><td class="meta-head">Vehicle</td><td><?php //echo $inv_data[0]['rego']; ?></td></tr>
        <tr><td class="meta-head">Make</td><td><?php //echo $inv_data[0]['make']; ?></td></tr>
        <tr><td class="meta-head">Model</td><td><?php //echo $inv_data[0]['model']; ?></td></tr>
        <tr><td class="meta-head">Colour</td><td><?php //echo $inv_data[0]['colour']; ?></td></tr>
        <tr><td class="meta-head">Body Style</td><td><?php //echo $inv_data[0]['body_type']; ?></td></tr>
        <tr><td class="meta-head">Vin</td><td><?php //echo $inv_data[0]['vin']; ?></td></tr>
        <tr><td class="meta-head">Engine No.</td><td><?php //echo $inv_data[0]['engine_number']; ?></td></tr>
        <tr><td class="meta-head">Chassis No.</td><td><?php //echo $inv_data[0]['chassis_no']; ?></td></tr>
        </table> -->

      	<table id="meta">
      		<tr>
      			<td class="meta-head">Date</td>
      			<td><textarea><?php echo $inv_data[0]['booking_date']; ?></textarea></td>
      		</tr>
      		<tr>
      			<td class="meta-head">Invoice #</td>
      			<td><textarea><?php echo $inv_data[0]['invoice_no']; ?></textarea></td>
      		</tr>
      		<tr>

      			<td class="meta-head">Due Date</td>
      			<td><textarea id="date"><?php echo $inv_data[0]['due_by']; ?></textarea></td>
      		</tr>
      		<tr>
      			<td class="meta-head">Amount</td>
      			<td><div class="due"><?php echo $inv_data[0]['grand_total']; ?></div></td>
      		</tr>

      	</table>

      </div>

      <table id="items">

      	<tr>
      		<th>Quantity</th>
      		<th>Item</th>
      		<th>Description</th>
      		<th>Unit Price</th>
      		<th>Discount</th>
      		<th>GST</th>
      		<th>Total</th>
      	</tr>
        
        <?php foreach($prdouct_data as $key => $value){?>
      	<tr class="item-row">
      		<td><p><?php echo $value['qty']; ?></p></td>
      		<td><p><?php echo $value['item_code']; ?></p></td>
      		<td><p><?php echo $value['description']; ?></p></td>
      		<td><p><?php echo $value['unit_price']; ?></p></td>
      		<td><p><?php echo $value['dis']?$value['dis'].'%':'NA'; ?></p></td>
      		<td><p><?php echo $value['gst']?$value['gst'].'%':'NA'; ?></p></td>
      		<td><span class="price"><?php echo "$ ".$value['total']; ?></span></td>
      	</tr>
        <?php } ?>
      	<tr>
      		<!-- <td colspan="3" class="blank"> </td> -->
      		<!-- <td colspan="3" class="total-line">Total</td> -->
      		<td colspan="7" class="total-value"><div id="subtotal" style="float: right;">Total :- <?php echo $inv_data[0]['grand_total']; ?></div></td>
      	</tr>
      </table>

      <!-- <div id="terms">
      	<h5>Terms</h5>
      	<textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
      </div> -->
      <br><br>
      <b>Thank you,</b><br>
      <b>Direct Credit to : GEM Automotive.</b>
      <br>
      <b>ASB Bank: 12-3233-0021674-01</b>
      <br><br> <br><br>  <br><br>
      <br><br>  <br><br>  <br><br>
      <br><br> <br><br>  <br><br>
      <b style="margin-bottom: 0px;">We appriciate your business.</b>
      <br>
  </div>

</body>

</html>
<script type="text/javascript">
	$(document).ready(function(){
     // window.print();
	});
</script>