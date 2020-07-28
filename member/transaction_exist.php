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
                   <div class="my-50 text-center">
                        <h4 class="h4 font-w400 text-muted mb-0 text-left">Dear <?php echo $row['user_fname']; ?>,
                        <br><br><br>
                        Our system detected that the transaction number is already exist in your transaction data. Please try again.
                        <br><br><br>
                        <h2 class="font-w700 text-muted text-left">Sorry.</h2>                       
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