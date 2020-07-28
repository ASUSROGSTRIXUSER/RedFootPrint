<?php
$user_id = $row['user_id'];
$user_type = $row['user_type'];
$user_rp = $row['user_rp'];
$select_user_login = mysqli_query($conn, "SELECT * FROM wp_users WHERE ID = '$user_id'");
$fetch_user_login = mysqli_fetch_array($select_user_login);
$user = $fetch_user_login['user_login'];
?>

<!-- Sidebar -->
<nav id="sidebar">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <div class="content-header content-header-fullrow px-15">
            <!-- Normal Mode -->
            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                    <i class="fa fa-times text-danger"></i>
                </button>
                <!-- END Close Sidebar -->
            </div>
            <!-- END Normal Mode -->
        </div>

        <!-- Side User -->
        <div class="content-side content-side-full content-side-user px-10 align-parent">
            <!-- Visible only in mini mode -->
            <div class="sidebar-mini-visible-b align-v animated fadeIn">
                <a class="img-link" href="personal_details.php">
                    <?php if($row['user_profile_pic'] != ""): ?>
                        <img class="img-avatar img-avatar32" src="../assets/media/upload/<?php echo $row['user_profile_pic']; ?>">
                    <?php else: ?>
                        <img class="img-avatar img-avatar32" src="../assets/media/photos/avatarpic.jpg">
                    <?php endif; ?>                               
                </a>
            </div>

            <!-- END Visible only in mini mode -->

            <!-- Visible only in normal mode -->
            <div class="sidebar-mini-hidden-b text-center">
                <a class="img-link" href="personal_details.php">
                    <?php if($row['user_profile_pic'] != ""): ?>
                        <img class="img-avatar" src="../assets/media/upload/<?php echo $row['user_profile_pic']; ?>">
                    <?php else: ?>
                        <img class="img-avatar" src="../assets/media/photos/avatarpic.jpg">
                    <?php endif; ?>                               
                </a>

                <ul class="list-inline mt-10">
                    <li class="list-inline-item">
                        <span class="d-sm-inline-block"><?php echo $row['user_fname'];?></span>
                    </li>
                    <li class="list-inline-item">
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="text-dual-primary-dark" data-toggle="layout" data-action="sidebar_style_inverse_toggle" href="javascript:void(0)">
                           <i class="si si-drop"></i>
                        </a>
                    </li>

                    <?php 
                        if($user_type == "Admin")
                        {
                            echo '<span class="badge badge-primary">'.$row['user_type'].'</span> ';
                        }
                        else
                        {
                            echo '<span class="badge" style="background-color: #920d00;">'.$row['user_type'].'</span> ';
                        }
                    ?>
                </ul>
            </div>
            <!-- END Visible only in normal mode -->
        </div>
        <!-- END Side User -->
        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <?php
                    $bg_color0 = ""; $bg_color1 = ""; $bg_color2 = ""; $bg_color3 = ""; $bg_color4 = ""; $bg_color5 = ""; $bg_color6 = "";
                    $child1 = "";
                    $open = "";

                    if($highlight == "dashboard.php")
                    { $bg_color1 = "#920d00"; }
                    else if($highlight == "personal_details.php")
                    { $bg_color2 = "#920d00"; $child1 = "padding-left: 15px; margin-left: -15px;"; }
                    else if($highlight == "member.php")
                    { $bg_color5 = "#920d00"; }
                    else if($highlight == "token.php")
                    { $bg_color3 = "#920d00"; $child1 = "padding-left: 15px; margin-left: -15px;"; }
                    else if($highlight == "sponsor.php")
                    { $bg_color4 = "#920d00"; }
                    else if($highlight == "affiliate.php")
                    { $bg_color6 = "#920d00"; }
                    else{}
                ?>

                <li>
                    <a href="http://infinityhub-server.com/redfootprint/wp-login.php?user=<?php echo $user; ?>&user_rp=<?php echo $user_rp; ?>" target="_blank"><i class="si si-home"></i><span class="sidebar-mini-hide">Home</span></a>
                </li>
                <li>
                    <a href="dashboard.php" style="background: <?php echo $bg_color1; ?>;"><i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                </li>
                <li class="nav-main-heading"><span class="sidebar-mini-visible">MG</span><span class="sidebar-mini-hidden">Manage</span></li>
                <li>
                    <a href="personal_details.php" style="background: <?php echo $bg_color2; ?>;"><i class="si si-settings"></i><span class="sidebar-mini-hide">Account</span></a>
                </li>
                <li>
                    <a href="affiliate.php" style="background: <?php echo $bg_color6; ?>;"><i class="si si-share"></i><span class="sidebar-mini-hide">Affiliate</span></a>
                </li>


                <?php 
                    if($user_type == "Admin")
                    {
                        echo '<li>
                            <a href="member.php" style="background: '.$bg_color5.';"><i class="si si-users"></i><span class="sidebar-mini-hide">Member</span></a>
                        </li>';
                    }
                ?>

                <li>
                    <a href="token.php" style="background: <?php echo $bg_color3; ?>; ?>"><i class="fa fa-bitcoin"></i><span class="sidebar-mini-hide">Token</span></a>
                </li>

                <li>
                    <a href="sponsor.php" style="background: <?php echo $bg_color4; ?>; ?>"><i class="si si-users"></i><span class="sidebar-mini-hide">Sponsor</span></a>
                </li>

                <li>
                    <a href="#"><i class="si si-badge"></i><span class="sidebar-mini-hide">Points</span></a>
                </li>

                <li>
                    <a href="#"><i class="si si-note"></i><span class="sidebar-mini-hide">Request</span></a>
                </li>

                <li>
                    <a href="logout.php?logout"><i class="si si-logout"></i><span class="sidebar-mini-hide">Sign Out</span></a>
                </li>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>

<!-- END Sidebar -->