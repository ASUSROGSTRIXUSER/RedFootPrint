<?php
    include ("session.php");
    $user_id = $row['user_id'];
    if(isset($_POST['update']))
    {
        $user_id =  $row['user_id'];

        $fname = $_POST['fname']; 
        $mname = $_POST['mname']; 
        $lname = $_POST['lname']; 
        $bdate = $_POST['bdate']; 
        $contact = $_POST['contact']; 
        $email = $_POST['email'];  
        $address = $_POST['address'];   

        $update = mysqli_query($conn, "UPDATE wp_member SET user_fname='$fname', user_mname='$mname', user_lname='$lname', user_bdate='$bdate', user_contact_no='$contact', user_email='$email', user_address='$address' WHERE user_id = '$user_id'") or die(mysqli_error());

        if($update == true)
        {
            echo "<script>alert('Personal details updated.');</script>"; 
            echo "<script>document.location='personal_details.php'</script>";  
        }
    }
    if(isset($_POST['btn_change_password']))
    {
        $real_pass = $_POST['pwd1'];  
        $password = md5(mysqli_real_escape_string($conn,$_POST['pwd1']));
        $update = mysqli_query($conn, "UPDATE wp_member SET user_password = '$password', user_rp = '$real_pass' WHERE user_id='$user_id'") or die(mysqli_error());
        mysqli_query($conn, "UPDATE wp_users SET user_pass = '$password' WHERE ID='$user_id'") or die(mysqli_error());
        if($update)
        {
            echo "<script type='text/javascript'>alert('Password change successfully...!');</script>";
            echo "<script>document.location='personal_details.php'</script>";  
        }
        else
        {
            echo "<script type='text/javascript'>alert('Please contact admin.');</script>";
        }
    }   
?>
<html lang="en" class="no-focus">
    <?php include_once 'head.php';?>
    <body>
        <div id="page-container" class="sidebar_mini_on sidebar-o sidebar-inverse enable-page-overlay side-scroll page-header-fixed main-content-boxed">
            <?php 
            $highlight = "personal_details.php";
            include_once 'left_sidebar_menu.php';
            ?>
            <?php include_once 'header.php';?>

            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="content">
                    
                    <div class="block content shadow">
                        <!-- Personal Details -->      
                        <h2 class="content-heading" style="margin-top: -40px;">
                            <span id="id_contact" class="badge float-right mt-5" style="font-size: 13px; color: #fff; background-color: #e74c3c;">User ID: <?php echo $row['user_id']; ?></span>
                            Personal Details
                        </h2>
                        <div class="row items-push">
                            <div class="col-lg-4">
                                <div class="block block-themed text-center">
                                    <div class="block-content block-content-full block-sticky-options pt-30" style="background-color: #e6e6e6;">
                                        <?php if($row['user_profile_pic'] != ""): ?>
                                            <img class="prof" src="../assets/media/upload/<?php echo $row['user_profile_pic']; ?>">
                                        <?php else: ?>
                                            <img class="prof" src="../assets/media/photos/avatarpic.jpg">
                                        <?php endif; ?>  
                                    </div>
                                    <div class="block-content block-content-full block-content-sm bg-gd-pulse">
                                        <div class="font-w600 text-white mb-5"><?php echo $row['user_fname'] . " " . $row['user_mname'] . " " . $row['user_lname'];?></div>
                                        <div class="font-size-sm text-white-op">Contact Name</div>
                                    </div>
                                </div>   
                                <div class="row">
                                    <div class="col-12 mb-10">
                                        <!--<input class="form-control inputlable bg-default-dark" type="file" name="file" required="">-->
                                        <input class="form-control inputlable bg-default-dark" type="file" name="file"  id="tran_attachment" required>
                                    </div>
                                    <div class="col-12">
                                        <!--<button type="submit" name="save" class="btn btn-sm btn-hero btn-noborder btn-danger btn-block">Upload profile</button>-->
                                        <button type="button" class="btn btn-sm btn-hero btn-noborder btn-primary btn-block" onclick="update_profile()">Update</button>
                                    </div>
                                </div>                            
                            </div> 

                            <div class="col-lg-8">
                                <form method="post">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                <label for="crypto-settings-street-1">First Name</label>
                                                <input type="text" class="form-control" id="crypto-settings-street-1" name="fname" value="<?php echo $row['user_fname'];?>" required>
                                             </div>
                                             <div class="form-group">
                                                <label for="crypto-settings-street-1">Middle Name</label>
                                                <input type="text" class="form-control" id="crypto-settings-street-1" name="mname" value="<?php echo $row['user_mname'];?>">
                                             </div>
                                             <div class="form-group">
                                                <label for="crypto-settings-street-1">Last Name</label>
                                                <input type="text" class="form-control" id="crypto-settings-street-1" name="lname" value="<?php echo $row['user_lname'];?>" required>
                                             </div>
                                             <div class="form-group">
                                                <label for="crypto-settings-street-1">Birthdate</label>
                                                <input type="date" class="form-control" id="crypto-settings-street-1" name="bdate" value="<?php echo $row['user_bdate'];?>" required>
                                             </div>
                                        </div>
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                <label for="crypto-settings-street-1">Contact #</label>
                                                <input type="text" class="form-control" id="crypto-settings-street-1" name="contact" value="<?php echo $row['user_contact_no'];?>" required>
                                             </div>
                                             <div class="form-group">
                                                <label for="crypto-settings-street-1">Email</label>
                                                <input type="text" class="form-control" id="crypto-settings-street-1" name="email" value="<?php echo $row['user_email'];?>" required>
                                             </div>
                                             <div class="form-group">
                                                <label for="crypto-settings-street-1">Address</label>
                                                <input type="text" class="form-control" id="crypto-settings-street-1" name="address" value="<?php echo $row['user_address'];?>" required>
                                             </div>
                                             <div class="form-group">
                                                <label for="crypto-settings-street-1">Option</label>
                                                <button type="submit" name="update" class="btn btn-md btn-noborder btn-primary btn-block">Update details</button>
                                             </div>
                                        </div>
                                    </div>    
                                </form>                                        
                            </div>
                        </div>                   
                    <!-- End Personal Details -->  
                    <!-- Change Password-->
                    <form method="post" ... onsubmit="return checkForm(this);">
                        <h2 class="content-heading <?php echo $md_text; ?>">Change Password</h2>
                        <div class="row items-push">
                            <div class="col-lg-3">
                                <p class="<?php echo $md_text; ?>">
                                    Changing your sign in password is an easy way to keep your account secure.
                                </p>
                                <p class="<?php echo $md_text; ?>">
                                    Password must contain:<br>
                                    * at least 6 characters<br>
                                    * numeric character (0-9)<br>
                                    * lowercase character (a-z)<br>
                                    * uppercase character (A-Z)
                                </p>
                            </div>
                            <div class="col-lg-7 offset-lg-1">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input type="hidden" class="form-control form-control-lg" id="crypto-settings-password" name="real" value="<?php echo $row['user_rp'];?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="crypto-settings-password">Current Password</label>
                                        <input type="text" class="form-control form-control-lg" id="crypto-settings-password" name="current" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="crypto-settings-password-new">New Password</label>
                                        <input type="password" class="form-control form-control-lg" id="crypto-settings-password-new" name="pwd1" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="crypto-settings-password-new-confirm">Confirm New Password</label>
                                        <input type="password" class="form-control form-control-lg" id="crypto-settings-password-new-confirm" name="pwd2" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-alt-primary" name="btn_change_password">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <script type="text/javascript">
                          function checkForm(form)
                          {
                            if(form.pwd1.value != "" && form.pwd1.value == form.pwd2.value) 
                            {                                        
                              if(form.current.value != form.real.value) {
                                alert("Note: Make sure you've entered the correct current password!");
                                form.current.focus();
                                return false;
                              }                                      
                              if(form.pwd1.value == form.current.value) {
                                alert("Note: New password must be different from current password!");
                                form.pwd1.focus();
                                return false;
                              }
                              if(form.pwd1.value.length < 6) {
                                alert("Note: New password must contain at least six characters!");
                                form.pwd1.focus();
                                return false;
                              }
                              re = /[0-9]/;
                              if(!re.test(form.pwd1.value)) {
                                alert("Note: New password must contain at least one number (0-9)!");
                                form.pwd1.focus();
                                return false;
                              }
                              re = /[a-z]/;
                              if(!re.test(form.pwd1.value)) {
                                alert("Note: New password must contain at least one lowercase letter (a-z)!");
                                form.pwd1.focus();
                                return false;
                              }
                              re = /[A-Z]/;
                              if(!re.test(form.pwd1.value)) {
                                alert("Note: New password must contain at least one uppercase letter (A-Z)!");
                                form.pwd1.focus();
                                return false;
                              }
                            } 
                            else
                            {
                              alert("Note: Confirm password not match, please try again.");
                              form.pwd2.focus();
                              return false;
                            }
                          }
                        </script>
                        <!-- END Change Password -->
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

        <script type="text/javascript" src="../assets/js/jquery-1.6.4.min.js"></script>
        <script type="text/javascript" src="../assets/js/jquery-3.2.1.min.js"></script>
        <script src="../assets/js/jquery.min.js"></script>  

        <script type="text/javascript">
            function update_profile()
            {
                user_id = <?php echo $user_id; ?>;
                tran_file = document.getElementById("tran_attachment").value; 
                tran_attachment = $('#tran_attachment');
                file_attachment = tran_attachment.prop('files')[0];    
                formData = new FormData();
                formData.append('user_id', user_id);
                formData.append('file_attachment', file_attachment);
                formData.append('update_profile', 1);

                $.ajax({  
                    url:"ajax.php",  
                    method:"post",  
                    data: formData,
                                          
                    contentType:false,
                    cache: false,
                    processData: false,  
                    success:function(data){  
                        if(data == "success")
                        { 
                            alert("Profile update successfully.");
                            location.reload();
                        }
                        else if(data == "format")
                        { 
                            alert("Attachment extension must be; jpg, JPG, jpeg, JPEG, png and PNG only."); 
                        }
                        else
                        {
                            alert("Upload attachment not greater than 3 MB.");
                        }
                    }  
                });
            }
        </script>

    </body>
</html>