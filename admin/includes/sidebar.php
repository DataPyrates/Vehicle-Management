  <!-- ========== Left Sidebar Start ========== -->

  <div class="left side-menu">



    <div class="slimscroll-menu" id="remove-scroll">



        <!-- LOGO -->

        <div class="topbar-left">

         <h3>VSMS | Admin  </h3>

         <hr />                    
        </div>



         <!-- User box -->

         <div class="user-box">

            <div class="user-img">

                <img src="assets/images/user.png" alt="user-img" class="rounded-circle img-fluid">

            </div>



            <?php

            $adid=$_SESSION['adid'];

            $ret=mysqli_query($con,"select AdminName from tbladmin where ID='$adid'");

            $row=mysqli_fetch_array($ret);

            $name=$row['AdminName'];



            ?>

            <h5><?php echo $name; ?></a> </h5>

            <p class="text-muted">VSMS Admin</p>

        </div>



        <!--- Sidemenu -->

        <div id="sidebar-menu">



            <ul class="metismenu" id="side-menu">



                <!--<li class="menu-title">Navigation</li>-->



                <li>

                    <a href="dashboard.php">

                        <i class="fi-air-play"></i><span class="badge badge-danger badge-pill float-right"></span> <span> Dashboard </span>

                    </a>

                </li>

                <li>

                    <a href="javascript: void(0);"><i class="fi-clipboard"></i><span> Masters </span> <span class="menu-arrow"></span></a>

                    <ul class="nav-second-level" aria-expanded="false">

                        <li><a href="add-street-state.php">Add Street State</a></li>

                        <li><a href="street-state.php">Street State Dashboard</a></li>

                        <li><a href="add-moc.php" title="Preferred Method Of Contact">Add MOC</a></li>

                        <li><a href="moc-dashboard.php" title="Preferred Method Of Contact">MOC Dashboard</a></li>

                       <li><a href="add-payment-terms.php">Add Payment Terms</a></li>

                       <li><a href="payment-terms.php">Payment Terms Dashboard</a></li>

                       <li><a href="add-transmission.php">Add Transmission</a></li>

                       <li><a href="transmission.php">Transmission Dashboard</a></li>  

                       <li><a href="add-body-type.php">Add Body Type</a></li>

                       <li><a href="body-type.php">Body Type Dashboard</a></li>

                       <li><a href="add-fuel-type.php">Add Fuel Type</a></li>

                       <li><a href="fuel-type.php">Fuel Type Dashboard</a></li>

                       <li><a href="add-job-status.php">Add Job Status</a></li>

                       <li><a href="job-status.php">Job Status Dashboard</a></li>

                       <li><a href="invoice-logo.php">Invoice Logo</a></li>

                    </ul>

                </li>

                <li>

                    <a href="javascript: void(0);"><i class="fi-clipboard"></i><span> Customers </span> <span class="menu-arrow"></span></a>

                    <ul class="nav-second-level" aria-expanded="false">

                        <li><a href="customer-booking.php">Customer Booking</a></li>

                        <li><a href="customer-booking-dashboard.php">Customer Booking Dashboard</a></li>

                        <!-- <li><a href="customer-invoice.php">Customer Invoice</a></li> -->

                        <li><a href="add-customer.php">Add Customer</a></li>

                        <li><a href="customer.php">Customer Dashboard</a></li>

                    </ul>

                </li>

                <li>

                    <a href="javascript: void(0);"><i class="fi-layers"></i><span> Product </span> <span class="menu-arrow"></span></a>

                    <ul class="nav-second-level" aria-expanded="false">

                        <li><a href="add-product.php">Add Product</a></li>

                        <li><a href="product.php">Product Dashboard</a></li>

                    </ul>

                </li>

                <li>

                    <a href="javascript: void(0);"><i class="fi-layers"></i><span> Invoice </span> <span class="menu-arrow"></span></a>

                    <ul class="nav-second-level" aria-expanded="false">

                        <li><a href="add-invoice.php">Add Invoice</a></li>

                        <li><a href="invoice.php">Invoice Dashboard</a></li>

                    </ul>

                </li>

                <li>

                    <a href="javascript: void(0);"><i class="fi-layers"></i><span> Supplier</span> <span class="menu-arrow"></span></a>

                    <ul class="nav-second-level" aria-expanded="false">

                        <li><a href="add-supplier.php">Add Supplier</a></li>

                        <li><a href="supplier.php">Supplier Dashboard</a></li>

                    </ul>

                </li>

                <li>

                    <a href="javascript: void(0);"><i class="fi-layers"></i><span> Mechanics </span> <span class="menu-arrow"></span></a>

                    <ul class="nav-second-level" aria-expanded="false">

                        <li><a href="add-mechanics.php">Add Mechanics</a></li>

                        <li><a href="manage-mechanics.php">Manage Mechanics</a></li>

                    </ul>

                </li>


                <li>

                    <a href="javascript: void(0);"><i class="fi-layers"></i><span> Vehicle </span> <span class="menu-arrow"></span></a>

                    <ul class="nav-second-level" aria-expanded="false">

                        <li><a href="add-vehicle.php">Add Vehicle</a></li>

                       <li><a href="vehicle.php">Vehicle Dashboard</a></li>

                        <li><a href="add-category.php">Add Drive Type</a></li>

                        <li><a href="manage-category.php">Manage Drive Type</a></li>

                    </ul>

                </li>

                <li>

                    <a href="reg-user.php">

                      <i class="icon-people"></i> <span> Register Users </span>

                  </a>

              </li>





              <li>

                <a href="javascript: void(0);"><i class="fi-paper"></i><span> Service Request </span> <span class="menu-arrow"></span></a>

                <ul class="nav-second-level" aria-expanded="false">

                    <li><a href="pending-service.php"> New </a></li>

                    <li><a href="rejected-services.php">Rejected</a></li>

                </ul>

            </li>

            <li>

                <a href="javascript: void(0);"><i class="fi-paper"></i><span> Servicing </span> <span class="menu-arrow"></span></a>

                <ul class="nav-second-level" aria-expanded="false">

                    <li><a href="pending-servicing.php"> Pending</a></li>

                    <li><a href="completed-service.php"> Completed </a></li>

                </ul>

            </li>





            <li>

                <a href="javascript: void(0);"><i class="fi-paper"></i><span> Customer Enquiry </span> <span class="menu-arrow"></span></a>

                <ul class="nav-second-level" aria-expanded="false">

                    <li><a href="notrespond-enquiry.php"> Not Respond Enquiry</a></li>



                    <li><a href="respond-enquiry.php"> Respond Enquiry </a></li>

                </ul>

            </li>





            <li>

                <a href="search-enquiry.php">

                    <i class="fi-air-play"></i><span class="badge badge-danger badge-pill float-right"></span> <span> Enquiry Search </span>

                </a>

            </li>



            <li>

                <a href="search-service.php">

                    <i class="fi-air-play"></i><span class="badge badge-danger badge-pill float-right"></span> <span> Service Search </span>

                </a>

            </li>













        </ul>



    </div>

    <!-- Sidebar -->



    <div class="clearfix"></div>



</div>

<!-- Sidebar -left -->



</div>

<!-- Left Sidebar End -->



