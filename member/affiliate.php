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
            $highlight = "affiliate.php";
            include_once 'left_sidebar_menu.php';
            ?>
            <?php include_once 'header.php';?>

            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="content">
                    
                    <div class="block content shadow">
                        <!-- Personal Details -->     
                        <span id="id_contact" class="badge float-right mt-5" style="font-size: 13px; color: #fff; background-color: #e74c3c;">My ID: <?php echo $user_id; ?></span>

                        <h2 class="content-heading text-muted" style="margin-top: -40px;">
                            Affiliate list
                        </h2>
                        <div class="mb-20">
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th>Name</th>
                                        <th class="d-none d-sm-table-cell">Email</th>
                                        <th class="d-none d-sm-table-cell">Contact</th>
                                        <th class="d-none d-sm-table-cell text-center">Profile</th>
                                        <th class="d-none d-sm-table-cell text-right">Sales</th>
                                        <th class="d-none d-sm-table-cell text-right">Earnings</th>
                                        <!--<th class="text-center">Tools</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $select_agent = mysqli_query($conn,"SELECT * FROM wp_affiliate WHERE affiliate_member_id = '$user_id'");
                                    while ($fetch_select_agent = mysqli_fetch_array($select_agent))
                                    {
                                        $full_name = $fetch_select_agent['affiliate_fname'].' '.$fetch_select_agent['affiliate_mname'].' '.$fetch_select_agent['affiliate_lname'];
                                        echo '
                                        <tr>
                                            <td class="text-center">'.$fetch_select_agent['affiliate_id'].'</td>
                                            <td class="font-w600">'.$full_name.'</td>
                                            <td class="d-none d-sm-table-cell">'.$fetch_select_agent['affiliate_email'].'</td>
                                            <td class="d-none d-sm-table-cell">'.$fetch_select_agent['affiliate_contact_no'].'</td>
                                            <td class="d-none d-sm-table-cell text-center">';
                                                if($fetch_select_agent['affiliate_profile'] != "")
                                                {echo'<img style="width: 37px; height: 37px; bsorder-radius:50px;" src="../assets/media/agent/'.$fetch_select_agent['affiliate_profile'].'">';}
                                                else
                                                {echo '<img style="width: 37px; height: 37px; border-radius:50px; border: 2px solid #e2e2e2;" src="../assets/media/photos/avatarpic.jpg">';}
                                                echo'
                                            </td>
                                            <td class="d-none d-sm-table-cell text-right">0</td>
                                            <td class="d-none d-sm-table-cell text-right">0.00</td>';
                                            /*<td class="text-center">

                                                <input type="hidden" value="'.$full_name.'" id="affiliate_'.$fetch_select_agent['affiliate_id'].'">

                                                <button type="button" class="btn btn-sm btn-circle btn-outline-danger" title="Get link" data-toggle="modal" data-target="#modal-normal" id="'.$fetch_select_agent['affiliate_id'].'" onclick="view_affiliate(this.id)">
                                                    <i class="fa fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-circle btn-outline-danger" title="Update" id="'.$fetch_select_agent['affiliate_id'].'" onclick="update_affiliate(this.id)">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-circle btn-danger" title="Delete">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </td>*/
                                            echo'
                                        </tr>
                                        ';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="crypto-settings-street-1">My Link</label>
                                    <input type="text" class="form-control" id="my_link" value="http://localhost/REDFOOTPRINT/affiliate_link.php?id=<?php echo $user_id; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="crypto-settings-street-1">Option</label>
                                    <button type="submit" name="update" class="btn btn-md btn-noborder btn-primary btn-block" onclick="copy_link2()">Copy link</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Normal Modal -->
                    <!--<div class="modal" id="modal-normal" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="block block-themed block-transparent mb-0">
                                    <div class="block-header bg-primary-dark">
                                        <h3 class="block-title">Affiliate link</h3>
                                        <div class="block-options">
                                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                <i class="si si-close"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="block-content">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="crypto-settings-street-1">Affiliate ID</label>
                                                    <input type="text" class="form-control" id="modal_affiliate_id" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="crypto-settings-street-1">Name</label>
                                                    <input type="text" class="form-control" id="modal_name" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="crypto-settings-street-1">Affiliate Link</label>
                                                    <input type="text" class="form-control" id="modal_affiliatesite" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="crypto-settings-street-1">Option</label>
                                                    <button type="submit" name="update" class="btn btn-md btn-noborder btn-primary btn-block" onclick="copy_link1()">Copy link</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <!-- Normal Modal -->

                    <!--
                    <div class="block content shadow">    
                        <h2 class="content-heading text-muted" style="margin-top: -40px;">
                            <span id="id_contact" class="badge float-right mt-5" style="font-size: 13px; color: #fff; background-color: #e74c3c;">Affiliate ID: <span id="view_affiliat_id"></span></span>
                            Add | Update affiliate
                        </h2>
                        <div class="row items-push">
                            <div class="col-lg-4">
                                <div class="block block-themed text-center">
                                    <div class="block-content block-content-full block-sticky-options pt-30" style="background-color: #e6e6e6;">
                                        <img class="prof" src="../assets/media/photos/avatarpic.jpg">
                                    </div>
                                    <div class="block-content block-content-full block-content-sm bg-gd-pulse">
                                        <div class="font-w600 text-white mb-5"><span id="view_affiliate_name"></span></div>
                                        <div class="font-size-sm text-white-op">Affiliate Name</div>
                                    </div>
                                </div>                              
                            </div> 

                            <div class="col-lg-8">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                         <div class="form-group">
                                            <label for="crypto-settings-street-1">First Name <span class="text-danger">(Require)</span></label>
                                            <input type="text" class="form-control" id="fname" required>
                                         </div>
                                         <div class="form-group">
                                            <label for="crypto-settings-street-1">Middle Name (Optional)</label>
                                            <input type="text" class="form-control" id="mname">
                                         </div>
                                         <div class="form-group">
                                            <label for="crypto-settings-street-1">Last Name <span class="text-danger">(Require)</span></label>
                                            <input type="text" class="form-control" id="lname" required>
                                         </div>
                                         <div class="form-group">
                                            <label for="crypto-settings-street-1">Birthdate (Optional)</label>
                                            <input type="date" class="form-control" id="bdate" required>
                                         </div>
                                    </div>
                                    <div class="col-md-6">
                                         <div class="form-group">
                                            <label for="crypto-settings-street-1">Contact # <span class="text-danger">(Require)</span></label>
                                            <input type="text" class="form-control" id="contact" required>
                                         </div>
                                         <div class="form-group">
                                            <label for="crypto-settings-street-1">Email <span class="text-danger">(Require)</span></label>
                                            <input type="text" class="form-control" id="email" required>
                                         </div>
                                         <div class="form-group">
                                            <label for="crypto-settings-street-1">Address <span class="text-danger">(Require)</span></label>
                                            <input type="text" class="form-control" id="address" required>
                                         </div>
                                         <div class="form-group">
                                            <label for="crypto-settings-street-1">Option</label>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <button type="button" class="btn btn-md btn-outline-danger btn-block mb-10" onclick="Cancel_affiliate()">Cancel</button>
                                                </div>
                                                <div class="col-sm-6">
                                                    <button type="button" class="btn btn-md btn-noborder btn-primary btn-block" onclick="Save_affiliate()">Save</button>
                                            </div>
                                        </div>
                                         </div>
                                    </div>
                                </div>                                     
                            </div>
                        </div>                  
                    </div>-->

                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->

            <?php include_once 'footer.php';?>
        </div>
        <!-- END Page Container -->
        <script type="text/javascript" src="../assets/js/jquery-1.6.4.min.js"></script>
        <script type="text/javascript" src="../assets/js/jquery-3.2.1.min.js"></script>
        <script src="../assets/js/jquery.min.js"></script>  
        <script type="text/javascript">
            document.getElementById("view_affiliate_name").innerHTML = "Sample Affiliate Name";


            function copy_link2()
            {
                var copyText = document.getElementById("my_link");
                copyText.select();
                copyText.setSelectionRange(0, 99999)
                document.execCommand("copy");

                alert('Link copied.');
            }
            function Save_affiliate()
            {
                view_affiliate_id = document.getElementById("view_affiliat_id").innerHTML;
                member_id = <?php echo $user_id; ?>;
                fname = document.getElementById("fname").value;
                mname = document.getElementById("mname").value;
                lname = document.getElementById("lname").value;
                bdate = document.getElementById("bdate").value;
                contact = document.getElementById("contact").value;
                email = document.getElementById("email").value;
                address = document.getElementById("address").value;

                if(member_id == "")
                { alert("Please relog-in your account and try again."); }
                if(fname == "" || lname == "" || contact == "" || email == "" || address == "")
                {
                    alert("Please input the require field.");
                }
                else
                {
                    $(document).ready(function(){
                        $.ajax({
                            type: "POST",
                            url: "ajax.php",
                            data: {
                                view_affiliate_id:view_affiliate_id,
                                member_id:member_id,
                                fname:fname,
                                mname:mname,
                                lname:lname,
                                bdate:bdate,
                                contact:contact,
                                email:email,
                                address:address,
                                add_affiliate: 1,
                            },
                            success: function(data){
                                if(data == "insert")
                                { 
                                    alert('Agent added successfully.'); 
                                    location.reload(); 
                                }
                                else
                                { 
                                    alert('Agent details updated successfully.'); 
                                    location.reload(); 
                                }
                            }
                        });                
                    });  
                }
            } 

            /*function view_affiliate(id)
            {
                document.getElementById("modal_affiliate_id").value = id;
                document.getElementById("modal_name").value = document.getElementById("affiliate_" + id).value;
                document.getElementById("modal_affiliatesite").value = "http://localhost/REDFOOTPRINT/affiliate_link.php?id=" + id;
            }
            function copy_link1()
            {
                var copyText = document.getElementById("modal_affiliatesite");
                copyText.select();
                copyText.setSelectionRange(0, 99999)
                document.execCommand("copy");

                alert('Link copied.');
            }

            function update_affiliate(id)
            {
                <?php
                    include_once '../conn.php';
                    $select_affiliate = mysqli_query($conn, "SELECT * FROM wp_affiliate");
                    while($fetch_select_affiliate = mysqli_fetch_array($select_affiliate))
                    {
                        $full_name = $fetch_select_affiliate['affiliate_fname'].' '.$fetch_select_affiliate['affiliate_mname'].' '.$fetch_select_affiliate['affiliate_lname'];
                        ?>
                        if (id == '<?php echo $fetch_select_affiliate['affiliate_id'] ?>')
                        {                            
                            document.getElementById("view_affiliate_name").innerHTML = "<?php echo $full_name ?>";
                            document.getElementById("view_affiliat_id").innerHTML = "<?php echo $fetch_select_affiliate['affiliate_id'] ?>";
                            document.getElementById("fname").value = "<?php echo $fetch_select_affiliate['affiliate_fname'] ?>";
                            document.getElementById("mname").value = "<?php echo $fetch_select_affiliate['affiliate_mname'] ?>";
                            document.getElementById("lname").value = "<?php echo $fetch_select_affiliate['affiliate_lname'] ?>";
                            document.getElementById("bdate").value = "<?php echo $fetch_select_affiliate['affiliate_bday'] ?>";
                            document.getElementById("contact").value = "<?php echo $fetch_select_affiliate['affiliate_contact_no'] ?>";
                            document.getElementById("email").value = "<?php echo $fetch_select_affiliate['affiliate_email'] ?>";
                            document.getElementById("address").value = "<?php echo $fetch_select_affiliate['affiliate_address'] ?>";
                        }
                    <?php
                    }
                ?>
                document.getElementById("address").focus();
            }
            function Cancel_affiliate()
            {                
                document.getElementById("fname").value = "";
                document.getElementById("mname").value = "";
                document.getElementById("lname").value = "";
                document.getElementById("bdate").value = "";
                document.getElementById("contact").value = "";
                document.getElementById("email").value = "";
                document.getElementById("address").value = "";
                document.getElementById("view_affiliate_name").innerHTML = "Sample Affiliate Name";
                document.getElementById("view_affiliat_id").innerHTML = "";
            }*/
        </script>
        <script src="../assets/js/codebase.core.min.js"></script>
        <script src="../assets/js/codebase.app.min.js"></script>

        <script src="../assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page JS Code -->
        <script src="../assets/js/pages/be_tables_datatables.min.js"></script>

    </body>
</html>