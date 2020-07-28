<?php
    session_start();
    include_once '../conn.php';
    if(isset($_POST['btn_sign_in']))
    {
        $user = mysqli_real_escape_string($conn,$_POST['username']);
        $upass = mysqli_real_escape_string($conn,$_POST['password']);
        $status = "Invalidated";
        $user = trim($user);
        $upass = trim($upass);    
        $res = mysqli_query($conn,"SELECT affiliate_id, affiliate_email , affiliate_Password, Affiliate_Status FROM wp_affiliate WHERE affiliate_email = '$user' ");
        $row = mysqli_fetch_array($res);
        $count = mysqli_num_rows($res); 
      
        if($row['Affiliate_Status'] = $status && $row['affiliate_Password']=(md5($upass)))
        {
                 
                 $_SESSION['user'] = $row['affiliate_id'];
                 $a_id = $row['affiliate_id'];
                 header("Location: affiliate_dashboard.php");
            
        } else{
            ?>
            <script>alert('Sorry, incorrect login details. Only member account can access this site.');</script>
          <?php
        }
    }
?>
<html lang="en" class="no-focus">
    <?php include_once 'affiliate_head.php';?>
    <body>
        <div id="page-container" class="main-content-boxed">
            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="bg-image" style="background-image: url('../assets/media/photos/photo34@2x.jpg');">
                    <div class="row mx-0 justify-content-center bg-white-op-95">
                        <div class="hero-static col-lg-6 col-xl-4">
                            <div class="content content-full overflow-hidden">
                                <!-- Header -->
                                <div class="py-30 text-center" style="margin-bottom: -20px;">
                                    <style type="text/css">
                                        .logo {width: 90px; margin: -20px 0px -50px 0px;}
                                    </style>
                                    <img src="../assets/media/photos/logo_circle.png" class="logo corporate"> 
                                </div>
                                <!-- END Header -->
                                <form method="post">
                                    <div class="block block-themed block-rounded block-shadow shadow">
                                        <div class="block-header bg-gd-pulse">
                                            <h3 class="block-title">Affiliate Log-in</h3>
                                        </div>
                                        <div class="block-content text-muted">
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <label for="login-username">Email</label>
                                                    <input type="text" class="form-control" name="username" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <label for="login-password">Password</label>
                                                    <input type="password" class="form-control" name="password" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-sm btn-hero btn-noborder btn btn-alt-danger btn-block" name="btn_sign_in">
                                                        <span><i class="si si-login mr-10"></i> Sign In</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </form>
                                <!-- END Sign In Form -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
    </body>
</html>