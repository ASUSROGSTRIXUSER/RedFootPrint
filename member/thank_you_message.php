<?php include ("session.php"); ?> 
<html lang="en" class="no-focus">
    <?php include_once 'head.php';?>
    <body>
        <div id="page-container" class="sidebar_mini_on sidebar-o sidebar-inverse enable-page-overlay side-scroll page-header-fixed main-content-boxed">
            <?php 
            $highlight = "";
            include_once 'left_sidebar_menu.php';
            ?>
            <?php include_once 'header.php';?>
            ?>
            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="content">
                    <div class="block block-content" style="margin-top: -20px;">


                        <?php
                            $tx = $_GET['tx'];
                            $select_tran = mysqli_query($conn, "SELECT * FROM wp_transaction WHERE transaction_num = '$tx'");
                            $fetch_select_tran = mysqli_fetch_array($select_tran);
                        ?>
                        <h4 class="h4 font-w400 text-muted mb-0 text-center">
                            Dear <?php echo $row['user_fname']; ?>,<br><br>Thank you.<br>Your order has been received.<br><br><br>
                        </h4>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group row">
                                    <div class="col-12 text-center">
                                        <label>Your order.</label>              
                                        <div class="block bg-gray-lighter text-center">
                                            <a class="d-block bg-gd-pulse font-w600 text-uppercase py-5">
                                                <span class="text-white">REGULAR PRICE</span>
                                            </a>
                                            <div class="block-content block-content-full">
                                                <?php
                                                    if($fetch_select_tran['transaction_item_num'] == 1)
                                                    {
                                                        echo '<div class="pt-20 pb-30">
                                                                <div class="font-size-h3 font-w700">100 TOKEN</div>
                                                                <div class="font-size-sm font-w600 text-uppercase text-muted">~ ₱100 worth of money</div>
                                                            </div>';     
                                                    }
                                                    else if($fetch_select_tran['transaction_item_num'] == 2)
                                                    {
                                                        echo '<div class="pt-20 pb-30">
                                                                <div class="font-size-h3 font-w700">200 TOKEN</div>
                                                                <div class="font-size-sm font-w600 text-uppercase text-muted">~ ₱200 worth of money</div>
                                                            </div>';                                                          
                                                    }
                                                    else if($fetch_select_tran['transaction_item_num'] == 3)
                                                    {
                                                        echo '<div class="pt-20 pb-30">
                                                                <div class="font-size-h3 font-w700">400 TOKEN</div>
                                                                <div class="font-size-sm font-w600 text-uppercase text-muted">~ ₱400 worth of money</div>
                                                            </div>';                                                          
                                                    }
                                                    else if($fetch_select_tran['transaction_item_num'] == 4)
                                                    {
                                                        echo '<div class="pt-20 pb-30">
                                                                <div class="font-size-h3 font-w700">800 TOKEN</div>
                                                                <div class="font-size-sm font-w600 text-uppercase text-muted">~ ₱800 worth of money</div>
                                                            </div>';                                                          
                                                    }
                                                    else if($fetch_select_tran['transaction_item_num'] == 5)
                                                    {
                                                        echo '<div class="pt-20 pb-30">
                                                                <div class="font-size-h3 font-w700">1600 TOKEN</div>
                                                                <div class="font-size-sm font-w600 text-uppercase text-muted">~ ₱1,600 worth of money</div>
                                                            </div>';                                                          
                                                    }
                                                    else
                                                    {
                                                        echo '<div class="pt-20 pb-30">
                                                                <div class="font-size-h3 font-w700">3200 TOKEN</div>
                                                                <div class="font-size-sm font-w600 text-uppercase text-muted">~ ₱3,200 worth of money</div>
                                                            </div>';                                                            
                                                    }
                                                ?>    
                                            </div>
                                        </div>  
                                    </div>                            
                                </div>                                                
                            </div>

                            <div class="col-lg-7 offset-lg-1">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="crypto-settings-street-1">Transaction No.</label>
                                        <input type="text" class="form-control form-control-md" id="crypto-settings-street-1" value="<?php echo $tx ?>" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="crypto-settings-street-1">Date & time</label>
                                        <input type="text" class="form-control form-control-md" id="crypto-settings-street-1" value="<?php echo $fetch_select_tran['transaction_date'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="crypto-settings-street-1">Currency</label>
                                        <input type="text" class="form-control form-control-md" id="crypto-settings-street-1" value="<?php echo $fetch_select_tran['transaction_currency'] ?>" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="crypto-settings-street-1">Amount</label>
                                        <input type="text" class="form-control form-control-md" id="crypto-settings-street-1" value="<?php echo $fetch_select_tran['transaction_amount'] ?>" readonly>
                                    </div>
                                </div>  
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="crypto-settings-street-1">Status</label>
                                        <input type="text" class="form-control form-control-md" id="crypto-settings-street-1" value="<?php echo $fetch_select_tran['transaction_status'] ?>" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="crypto-settings-street-1">Option</label>
                                        <a href="http://localhost/REDFOOTPRINT/member/dashboard.php" class="btn btn-md btn-noborder btn-primary btn-block">
                                            View transaction
                                        </a>
                                    </div>
                                </div>  

                                <label class="mb-5 mt-10"><h4 class="text-muted">Personal details</h4></label>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="crypto-settings-street-1">Email</label>
                                        <input type="text" class="form-control form-control-md" id="crypto-settings-street-1" value="<?php echo $row['user_email']; ?>" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="crypto-settings-street-1">Contact No.</label>
                                        <input type="text" class="form-control form-control-md" id="crypto-settings-street-1" value="<?php echo $row['user_contact_no']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="crypto-settings-street-1">Address</label>
                                        <input type="text" class="form-control form-control-md" id="crypto-settings-street-1" value="<?php echo $row['user_address']; ?>" readonly>
                                    </div>
                                </div>                                 
                            </div>
                        </div>  


                    </div>
                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->

            <?php include_once 'footer.php';?>
        </div>
        <!-- END Page Container -->
        <script src="../assets/js/codebase.core.min.js"></script>
        <script src="../assets/js/codebase.app.min.js"></script>
    </body>
</html>