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

    $body_type=$_POST['body_type'];

    $status = 1 ;

    $id = $_REQUEST['id'];

    if(empty($id)){

    $query=mysqli_query($con, "insert into  vsms_body_type(body_type,status) value('$body_type',$status)");
    $msg_txt = "Body Type has been added.";
    }

    else{

    $query=mysqli_query($con, "update  vsms_body_type set body_type='$body_type',status=$status where id=$id");
    $msg_txt = "Body Type has been updated.";

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
$sql ='select * from vsms_body_type where id='.$id;
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

                                    <h4 class="m-t-0 header-title">Add Body Type</h4>

                                    <p class="text-muted m-b-30 font-14">

                                    </p>


                                    <div class="row">

                                        <div class="col-12">

                                            <div class="p-20">

                                                <p style="font-size:16px; color:red" align="center"> <?php if($msg){
                                                    echo $msg; }  ?> </p>

                                                <form class="form-horizontal" role="form" method="post" name="submit">

                                                    <div class="form-group row">

                                                        <label class="col-2 col-form-label" for="example-email">Body Type Name *</label>

                                                        <div class="col-10">

                                                            <input type="text"  name="body_type" class="form-control" placeholder="Body Type" required="true" value="<?php echo $data[0]['body_type']; ?>">

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

    </body>

</html>

<?php }  ?>