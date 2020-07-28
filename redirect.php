<?php
    session_start();
    include_once 'conn.php';

    if (empty($_GET['data'])) 
    {}
    else
    {
        $data = $_GET['data'];
        $select_member = mysqli_query($conn, "SELECT * FROM wp_member WHERE user_id = '$data'");
        $fetch_user = mysqli_fetch_array($select_member);
        $username = $fetch_user['user_username'];
        $password = $fetch_user['user_rp'];

        $user = mysqli_real_escape_string($conn,$username);
        $upass = mysqli_real_escape_string($conn,$password);
        $user = trim($user);
        $upass = trim($upass);

        $res=mysqli_query($conn,"SELECT user_id, user_username, user_password FROM wp_member WHERE user_username = '$user'");
        $row=mysqli_fetch_array($res);
        $count = mysqli_num_rows($res); 

        if($count == 1 && $row['user_password']==(md5($upass)))
        {
            $_SESSION['user'] = $row['user_id'];
            $a_id = $row['user_id'];
            header("Location:member/dashboard.php");
        }      
        else
        {
            echo "<script>alert('Sorry, incorrect login details.');</script>";
        }
    }
?>
<html lang="en" class="no-focus">
    <?php include_once 'head.php';?>
    <body>
        <div id="page-container" class="main-content-boxed">
            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="bg-image" style="background-image: url('assets/media/photos/photo34@2x.jpg');">
                    <div class="row mx-0 justify-content-center bg-white-op-95">
                        <div class="hero-static col-lg-6 col-xl-4">
                            <div class="content content-full overflow-hidden text-center">
                                <div class="js-pie-chart pie-chart js-pie-chart-enabled" style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; min-height: 100vh;">
                                    <span><i class="fa fa-4x fa-cog fa-spin text-danger"></i></span>
                                    <br><br><br><br><br><br>
                                    <h2 class="text-muted">Please wait...</h2>
                                </div>
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