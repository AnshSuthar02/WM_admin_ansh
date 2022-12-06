<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php
if (isset($this->session->userdata['logged_in'])) {
    $user_id = $this->session->userdata['logged_in']['id'];
    $username = $this->session->userdata['logged_in']['username'];
    $email = $this->session->userdata['logged_in']['email'];
    $name = $this->session->userdata['logged_in']['name'];
    $role_id = $this->session->userdata['logged_in']['role_id'];
    $role = $this->session->userdata['logged_in']['role'];
} else {
    header("location: login");
}
?>


<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User Profile-->
        <div class="user-profile">
            <div class="user-pro-body">
                <div class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle u-dropdown link hide-menu" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <?= $name ?>
                        <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu animated flipInY">
                        <!-- text-->
                        <a href="<?php echo base_url(); ?>index.php/Employees/MyProfile/<?= $user_id ?>" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                        <!-- text-->
                        <!-- <a href="javascript:void(0)" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a> -->
                        <!-- text-->
                        <!-- <a href="javascript:void(0)" class="dropdown-item"><i class="ti-email"></i> Inbox</a> -->
                        <!-- text-->
                        <div class="dropdown-divider"></div>
                        <!-- text-->
                        <a href="<?php echo base_url(); ?>index.php/User_authentication/MyPasswordChangeView" class="dropdown-item">
                            <i class="ti-settings"></i> 
                            Change Password
                        </a>
                        <!-- text-->
                        <div class="dropdown-divider"></div>
                        <!-- text-->
                        <a href="<?php echo base_url(); ?>index.php/User_authentication/logout" class="dropdown-item"><i class="fas fa-power-off"></i> Logout</a>
                        <!-- text-->
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav active">
            <?php
            echo $this->dynamic_menu->build_menu();
            ?>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->