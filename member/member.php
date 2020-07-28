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
    <link rel="stylesheet" href="../assets/js/plugins/datatables/dataTables.bootstrap4.css">
    <body>
        <div id="page-container" class="sidebar_mini_on sidebar-o sidebar-inverse enable-page-overlay side-scroll page-header-fixed main-content-boxed">
            <?php 
            $highlight = "member.php";
            include_once 'left_sidebar_menu.php';
            ?>
            <?php include_once 'header.php';?>

            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="content">
                    <div class="block block-fx-shadow">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Member list</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <table class="table table-bordered table-hover table-striped table-vcenter js-dataTable-full">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th class="d-none d-sm-table-cell">Contact</th>
                                        <th class="d-none d-sm-table-cell">Email</th>
                                        <th class="d-none d-sm-table-cell">Status</th>
                                        <th class="text-center">Profile</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $select_member = mysqli_query($conn, "SELECT * FROM wp_member ORDER BY user_fname ASC");
                                        while($fetch_member = mysqli_fetch_array($select_member))
                                        {  
                                            echo '
                                            <tr style="cursor: pointer;" data-toggle="modal" data-target="#modal-large" id="memberid'.$fetch_member['user_id'].'" onclick="click_contact(this.id)">
                                                <td>'.$fetch_member['user_id'].'</td>
                                                <td>'.$fetch_member['user_fname'].' '.$fetch_member['user_mname'].' '.$fetch_member['user_lname'].'</td>
                                                <td class="d-none d-sm-table-cell">'.$fetch_member['user_contact_no'].'</td>
                                                <td class="d-none d-sm-table-cell">'.$fetch_member['user_email'].'</td>
                                                <td class="d-none d-sm-table-cell">
                                                    '.$fetch_member['user_type'].'
                                                </td>
                                                <td class="text-center">';
                                                    if($fetch_member['user_profile_pic'] != "")
                                                    {echo'<img style="width: 37px; height: 37px; border-radius:50px;" src="../assets/media/upload/'.$fetch_member['user_profile_pic'].'">';}
                                                    else
                                                    {echo '<img style="width: 37px; height: 37px; border-radius:50px; border: 2px solid #e2e2e2;" src="../assets/media/photos/avatarpic.jpg">';}
                                                    echo'
                                                </td>
                                            </tr>
                                            ';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->

                <!-- Large Modal -->
                <div class="modal" id="modal-large" tabindex="-1" role="dialog" aria-labelledby="modal-extra-large" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="block block-themed block-transparent mb-0">
                                <div class="block-header bg-primary-dark">
                                    <h3 class="block-title">Personal Details</h3>
                                    <span class="badge float-right mt-5" style="font-size: 13px;">Member ID: </span>
                                    <span id="member_id_when_click" class="badge float-right mt-5" style="font-size: 13px;"></span>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                            <i class="si si-close"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="block-content" id="contact_id">    
                                </div>
                            </div>
                            <div class="modal-footer">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Large Modal -->
            </main>
            <!-- END Main Container -->

            <?php include_once 'footer.php';?>
        </div>
        <!-- END Page Container -->
        <script type="text/javascript" src="../assets/js/jquery-1.6.4.min.js"></script>
        <script type="text/javascript" src="../assets/js/jquery-3.2.1.min.js"></script>
        <script src="../assets/js/jquery.min.js"></script>  

        <script type="text/javascript">
            function click_contact(id)
            {
                member_id = id.replace("memberid", "");
                document.getElementById("member_id_when_click").innerHTML = member_id;
                display_contact();
            }
            function display_contact()
            {
                member_id = document.getElementById("member_id_when_click").innerHTML;
                $.ajax({  
                    url:"ajax.php",  
                    method:"post",  
                    data:{
                        member_id:member_id,
                        get_member:1
                    },  
                    success:function(response){  
                        $('#contact_id').html(response);  
                    }  
               });  
            } 
            function update_contact()
            {
                member_id = document.getElementById("member_id_when_click").innerHTML;
                admin_fname = document.getElementById("admin_fname").value;
                admin_mname = document.getElementById("admin_mname").value;
                admin_lname = document.getElementById("admin_lname").value;
                admin_bdate = document.getElementById("admin_bdate").value;
                admin_contact = document.getElementById("admin_contact").value;
                admin_email = document.getElementById("admin_email").value;
                admin_address = document.getElementById("admin_address").value;

                $.ajax({  
                    url:"ajax.php",  
                    method:"post",  
                    data:{
                        member_id:member_id,
                        admin_fname:admin_fname,
                        admin_mname:admin_mname,
                        admin_lname:admin_lname,
                        admin_bdate:admin_bdate,
                        admin_contact:admin_contact,
                        admin_email:admin_email,
                        admin_address:admin_address,
                        update_contact: 1,
                    },  
                    success:function(response){   
                        alert('Contact updated.');
                        display_contact();
                        location.reload();
                    }
                });  
            }
        </script>

        <script src="../assets/js/codebase.core.min.js"></script>
        <script src="../assets/js/codebase.app.min.js"></script>

        <!-- Page JS Plugins -->
        <script src="../assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page JS Code -->
        <script src="../assets/js/pages/be_tables_datatables.min.js"></script>

    </body>
</html>s