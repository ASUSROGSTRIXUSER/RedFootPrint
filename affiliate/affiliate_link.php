<?php
    include("../conn.php");
 
    $success = "";

    if(isset($_POST['btn_add']))
    {
      $fname     = $_POST['fname'];  
      $mname     = $_POST['mname'];  
      $lname     = $_POST['lname']; 
      $sponsor_dash = str_replace(" ","-",$fname).'-'.str_replace(" ","-",$lname); // $fname.'-'.$lname;
      $bdate     = $_POST['bdate'];   
      $address     = $_POST['address'];  
      $contact_number     = $_POST['contact_number'];  
      $email     = $_POST['email'];      
      $con = mysqli_query($conn, "SELECT * FROM wp_member WHERE user_username = '$username'");
      if(mysqli_num_rows($con) == 0)
      {
          $insert = mysqli_query($conn, "INSERT INTO wp_member VALUES('','','$fname','$mname','$lname','$bdate','$address','$contact_number','$email',)") or die(mysqli_error());
          if($insert)
          {
            $fullname = $fname.' '.$mname.' '.$lname;
            mysqli_query($conn, "INSERT INTO wp_users (user_login, user_pass, user_email, display_name) VALUES('$username','$password','$email','$fullname')") or die(mysqli_error());
            $last_id = mysqli_query($conn,"SELECT * FROM wp_users ORDER BY ID DESC LIMIT 1"); // get last ID
            $fetch_last_id = mysqli_fetch_array($last_id);  
            $last = $fetch_last_id['ID'];

            mysqli_query($conn, "INSERT INTO wp_usermeta (user_id, meta_key, meta_value) VALUES ('$last','wp_capabilities', 'a:1:{s:10:\"subscriber\";b:1;}'), ('$last','wp_user_level', '0'), ('$last','um_user_profile_url_slug_name_dash', '$sponsor_dash'), ('$last','first_name', '$fname'), ('$last','last_name', '$lname'), ('$last','mwb_wpr_points', '')") or die(mysqli_error());

            //echo "<script type='text/javascript'>alert('Account created successfully!!!');</script>";
            //echo "<script>document.location='index.php'</script>";
            $success = "success";
          }
          else
          {
                echo "<script type='text/javascript'>alert('Opps error');</script>";
          }     
      }
      else
      { 
        echo "<script type='text/javascript'>alert('Username already Exist...!');</script>";
      }
    }            
?>
<!doctype html>
<html lang="en" class="no-focus">
    <?php include_once 'head.php';?>
    <body>
        <div id="page-container" class="main-content-boxed">

            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="bg-image" style="background-image: url('../assets/media/photos/photo34@2x.jpg');">
                    <div class="row mx-0 justify-content-center bg-white-op-95">
                        <div class="hero-static col-lg-8">
                            <div class="content content-full overflow-hidden">
                                <!-- Header -->
                                <div class="py-30 text-center" style="margin-bottom: -20px;">
                                    <style type="text/css">
                                        .logo {width: 90px; margin: -20px 0px -50px 0px;}
                                    </style>
                                    <img src="../assets/media/photos/logo_circle.png" class="logo"> 
                                </div>
                                <!-- END Header -->
                                <form class="js-validation-signin" method="post" onsubmit="return checkForm(this);">
                                    <div class="block block-themed block-rounded block-shadow shadow">
                                        <div class="block-header bg-gd-pulse">
                                            <h3 class="block-title">Affiliate Form</h3>
                                        </div>
                                        <div class="block-content row text-muted">
                                            <div class="col-md-12">
                                                <?php
                                                if($success != "")
                                                { ?>     
                                                    <!-- Success Alert -->
                                                    <div class="alert alert-success alert-dismissable" role="alert">
                                                        <h3 class="alert-heading font-size-h4 font-w400">Success</h3>
                                                        <p class="mb-0">Account created successfully, you can now sign in to our member area.</p>
                                                    </div>
                                                    <!-- END Success Alert -->                 
                                                <?php }
                                                ?>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="login-username">First Name</label><span class="text-danger"> (required)</span>
                                                        <input type="text" class="form-control" name="fname" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="login-username">Middle Name</label>
                                                        <input type="text" class="form-control" name="mname">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="login-username">Last Name</label><span class="text-danger"> (required)</span>
                                                        <input type="text" class="form-control" name="lname" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="login-username">Birthdate</label><span class="text-danger"> (required)</span>
                                                        <input type="date" class="form-control" name="bdate" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="login-username">Address</label><span class="text-danger"> (required)</span>
                                                        <input type="text" class="form-control" name="address" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="login-username">Contact Number</label><span class="text-danger"> (required)</span>
                                                        <input type="text" class="form-control" name="contact_number" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="login-username">Email</label><span class="text-danger"> (required)</span>
                                                        <input type="email" class="form-control" name="email" required>
                                                    </div>
                                                </div>                                              
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="block-content bg-body-light">
                                            <div class="form-group text-center row">
                                                <div class="col-sm-4">
                                                    
                                                </div>
                                                <div class="col-sm-4">
                                                <button type="submit" class="btn btn-sm btn-hero btn-noborder bg-danger btn-block mb-5" name="btn_add">
                                                        <span class="text-white"><i class="fa fa-plus mr-10"></i> Create</span>
                                                    </button>
                                                </div>
                                                <div class="col-sm-4">
                                                    
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- END Sign In Form -->
                                <script type="text/javascript">
                                  function checkForm(form)
                                  {
                                    if(form.password.value == form.confirm_password.value) 
                                    {
                                      if(form.password.value.length < 6) {
                                        alert("Password must contain at least six characters!");
                                        form.password.focus();
                                        return false;   
                                      }
                                      if(form.password.value == form.username.value) {
                                        alert("Password must be different from Username!");
                                        form.password.focus();
                                        return false;
                                      }
                                      re = /[0-9]/;
                                      if(!re.test(form.password.value)) {
                                        alert("Password must contain at least one number (0-9)!");
                                        form.password.focus();
                                        return false;
                                      }
                                      re = /[a-z]/;
                                      if(!re.test(form.password.value)) {
                                        alert("Password must contain at least one lowercase letter (a-z)!");
                                        form.password.focus();
                                        return false;
                                      }
                                      re = /[A-Z]/;
                                      if(!re.test(form.password.value)) {
                                        alert("Password must contain at least one uppercase letter (A-Z)!");
                                        form.password.focus();
                                        return false;
                                      }
                                    } 
                                    else 
                                    {
                                      alert("Confirmation not match. Please try again.");
                                      form.confirm_password.focus();
                                      return false;
                                    }
                                  }
                                </script>
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