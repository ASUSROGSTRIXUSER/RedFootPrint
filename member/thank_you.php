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
            <?php
            if(isset($_POST['add']))
            {
                $transaction = $_POST['transaction'];
                $user_id = $_POST['user_id'];
                $item_number = $_POST['item_number'];
                $amount = $_POST['amount'];
                if($item_number == "1")
                { $token = 100; }
                else if($item_number == "2")
                { $token = 200; }
                else if($item_number == "3")
                { $token = 400; }
                else if($item_number == "4")
                { $token = 800; }
                else if($item_number == "5")
                { $token = 1600; }
                else
                { $token = 3200; }
                //$token = str_replace(',', '', number_format($amount));
                $currency = $_POST['currency'];
                $status = $_POST['status'];

                $con = mysqli_query($conn, "SELECT * FROM wp_transaction WHERE transaction_num='$transaction'");
                if(mysqli_num_rows($con) == 0)
                {
                    mysqli_query($conn, "INSERT INTO wp_transaction VALUES('$transaction','$user_id','$item_number',now(),'$amount','$currency','$status')") or die(mysqli_error());
                    $select_user = mysqli_query($conn, "SELECT * FROM wp_usermeta WHERE user_id='$user_id' AND meta_key = 'mwb_wpr_points'");
                    $fetch_user = mysqli_fetch_array($select_user);
                    $user_token = $fetch_user['meta_value'];

                    if($user_token == "") // if now token ever since
                    {
                        if($status != "Pending")
                        {
                            mysqli_query($conn, "UPDATE wp_usermeta SET meta_value='$token' WHERE user_id='$user_id' AND meta_key = 'mwb_wpr_points'") or die(mysqli_error());
                        }
                    }
                    else // else update token
                    {
                        $new_token = $user_token + $token;
                        if($status != "Pending")
                        {
                            mysqli_query($conn, "UPDATE wp_usermeta SET meta_value='$new_token' WHERE user_id='$user_id' AND meta_key = 'mwb_wpr_points'") or die(mysqli_error());
                        }
                    }
                    echo "<script>document.location='thank_you_message.php?tx=$transaction'</script>";
                }
                else
                {
                    echo "<script>document.location='transaction_exist.php'</script>";
                }
            }
            ?>
            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="content">
                   <div class="my-50 text-center">
                        <br><br><br><br>
                        <br><br><br><br>
                        <h2 class="font-w700 text-center text-muted">Please wait...</h2>  

                        <form name="dform" method="post">         
                        <input type="hidden" name="transaction" value="<?php echo $_GET['tx']; ?>" readOnly>                          
                        <input type="hidden" name="user_id" value="<?php echo $row['user_id'];?>" readOnly>
                        <input type="hidden" name="item_number" value="<?php echo $_GET['item_number']; ?>" readOnly>
                        <input type="hidden" name="amount" value="<?php echo $_GET['amt']; ?>" readOnly>
                        <input type="hidden" name="currency" value="<?php echo $_GET['cc']; ?>" readOnly>
                        <input type="hidden" name="status" value="<?php echo $_GET['st']; ?>" readOnly>
                        <button  type="submit" class="btn btn-alt-success" id="btnStartVisit" name="add" hidden="hidden"><i class="fa fa-plus mr-10"></i> Add</button>

                        <script>
                            var currentTime = new Date(),
                                hours = currentTime.getHours(),
                                minutes = currentTime.getMinutes();                                            
                                second = currentTime.getUTCSeconds();

                            if (minutes < 10) 
                                {
                                    minutes = "0" + minutes;
                                }

                            var currentDate = new Date(),
                                month = currentDate.getMonth() + 1,
                                day = currentDate.getDate(),
                                year = currentDate.getFullYear();
                            document.dform.currentdate.value=(year + "-" + month + "-" + day)
                        </script>

                        <script type="text/javascript">
                            document.getElementById('btnStartVisit').dispatchEvent(new MouseEvent("click"));
                        </script>                               
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