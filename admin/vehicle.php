<?php  

session_start();

error_reporting(0);

include('includes/dbconnection.php');

if (strlen($_SESSION['adid']==0)) {

  header('location:logout.php');

  } else{

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

<style>
#street_data .row{ width: 100% !important;}
</style>
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

                        <h4 class="m-t-0 header-title">Vehicle Dashboard</h4>

                        <p class="text-muted m-b-30 font-14">

                        </p>

             <!--    <div class="row">

               <div class="col-12"> -->


                <table class="table" id="street_data" style="width:100%">

                <thead>

                <tr>

                  <th>S.NO</th>

                  <th>Rego</th>

                  <th>Make</th>

                  <th>Model</th>

                  <th>Model Code</th>

                  </tr>

                  </thead>


                </table>

               <!--                              
                </div>

                </div> -->

            </div>

            <!-- end row -->

        </div> <!-- end card-box -->

    </div><!-- end col -->



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

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){
var dataTable = $('#street_data').DataTable({
  "processing":true,
  "serverSide":true,
  "order":[],
  "ajax":{
   url:"model/vehicle_fetch.php",
   type:"POST"
  },
  "columnDefs":[
   {
    "targets":[0,1,2,3,4],
    "orderable":false,
   },
  ],

 });

 $(document).on('click', '#logout_button', function(){

   $.ajax({
    url:"logout.php",
    method:"POST",
    success:function(data)
    {
      alert(data);
    var url= "index.php";
    window.location = url;
    }
   });
 });

$(document).on('click', '.delete', function(){
  var id = $(this).attr("id");
  if(confirm("Are you sure you want to delete the Street State?"))
  {
   $.ajax({
    url:"model/generic_delete.php",
    method:"POST",
    data:{id:id,table:'vsms_street_state'},
    success:function(data)
    {
     alert(data);
     dataTable.ajax.reload( null, false ); 
    }
   });
  }
  else
  {
   return false; 
  }
 });

$("#street_data_wrapper").removeClass("form-inline");

});
</script>

</body>

</html>

<?php }  ?>