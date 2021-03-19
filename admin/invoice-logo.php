<?php

session_start();

error_reporting(0);

include('includes/dbconnection.php');
include('model/db.php');

if (strlen($_SESSION['adid']==0)) {

  header('location:logout.php');

  } else{



if(isset($_POST['submit']))

  {


    $time = date("H-i-s");
    if(!empty($_FILES['inv_logo']['name'])){
    $target_dir = "inv_logo/";
    $tempFile   = $_FILES['inv_logo']['tmp_name'];
    $target_file = $target_dir . basename($time."-".$_FILES["inv_logo"]["name"]);
    move_uploaded_file($tempFile, $target_file);
    $inv_logo = $target_file;
    }
    else{
    $inv_logo = '';    
    }

    $status = 1 ;

    $id = $_REQUEST['id'];

    if(empty($id)){

    $query=mysqli_query($con, "insert into  vsms_inv_logo(inv_logo) value('$inv_logo')");
    $msg_txt = "Invoice Logo has been added.";
    }

    else{

    $query=mysqli_query($con, "update  vsms_inv_logo set inv_logo='$inv_logo' where id=$id");
    $msg_txt = "Invoice Logo has been updated.";

    }

    if ($query) {

    $msg=$msg_txt;

  }

  else

    {

      $msg="Something Went Wrong. Please try again";

    }

}

// $id=$_REQUEST['id'];
$sql ='select * from vsms_inv_logo where id=1';
$statement = $db->prepare($sql);
$statement->execute(); 
$data = $statement->fetchAll();

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

                                    <h4 class="m-t-0 header-title">Invoice Logo</h4>
                                      
                                    <img style="float: right;box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);" src="<?php echo $data[0]['inv_logo']; ?>">

                                    <p class="text-muted m-b-30 font-14">

                                    </p>


                                    <div class="row">

                                        <div class="col-12">

                                            <div class="p-20">

                                                <p style="font-size:16px; color:red" align="center"> <?php if($msg){
                                                    echo $msg; }  ?> </p>

                                                <form class="form-horizontal" role="form" method="post" name="submit" enctype="multipart/form-data">

                                                    <div class="form-group row">

                                                        <label class="col-2 col-form-label" for="example-email">Invoice Logo *</label>

                                                        <div class="col-10">

                                                            <input type="file"  name="inv_logo" class="form-control" placeholder="Invoice Logo" required="true" value="<?php echo $data[0]['invoice_logo']; ?>">

                                                        </div>

                                                    </div>

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

        <!-- App js -->

        <script src="assets/js/jquery.core.js"></script>

        <script src="assets/js/jquery.app.js"></script>

    </body>

</html>

<?php }  ?>