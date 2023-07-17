<?php
defined('BASEPATH') or exit('No direct script access allowed');
$current_page = current_url();
$data         = explode('?', $current_page);
$role_id      = $this->session->userdata['logged_in']['role_id'];
$loginid      = $this->session->userdata['logged_in']['id'];
$current_page = current_url();
?>

<style>
    fieldset.scheduler-border {
        border-radius: 8px;
        border: 2px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
        box-shadow: 0px 0px 0px 0px #000;
        margin-top: 30px !important;
    }

    legend.scheduler-border {
        text-align: left !important;
        width: auto;
        margin-top: -30px;
        margin-left: 15px;
        color: #144277;
        font-size: 17px;
        margin-bottom: 0px;
        border: none;
        background: #fff;
        padding: 15px;
    }

    label:not(.form-check-label):not(.custom-file-label) {
        font-weight: 700;
    }

    .col-md-6 {
        margin-bottom: 10px;
    }
</style>

<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span>
        <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" class="btn-close" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
                <h3 class="text-success">
                    <i class="fa fa-check-circle"></i> Success
                </h3>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('failed')) : ?>
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" class="btn-close" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
                <h3 class="text-warning">
                    <i class="fa fa-exclamation-triangle"></i> Warning
                </h3>
                <?php echo $this->session->flashdata('failed'); ?>
            </div>
        <?php endif; ?>
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">All Your Orders Details</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">All Your Orders Details</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
        <div class="card card-primary card-outline">
            <div class="card-header">
            <span class="card-title">Order Chat <?= $order_id ?></span>
            <div class="pull-right error_msg">
                <button class="btn btn-success " data-bs-toggle="tooltip" title=" "> Back</i></button>
            </div>
            </div>
            <div class="card-body">
            <div class="modal-content">
                <div class="modal-header">
               <h4> Order Chat With   <b style="color:green"><?=  $user_name ?> </b>  </h4>
                
                </div>
                <div class="modal-body">
                <div class="row col-md-12">
                        <div class="card-body" style="height: 200px; overflow-y: auto; background-color: white;">
                            <div class="message mCustomScrollbar" data-mcs-theme="minimal-dark">
                                <ul>
                                    <div class="col-md-12">
                                        <li class="msg-left">
                                            <div class="msg-left-sub">
                                                <div class="msg-desc">
                                                    <pre>dfdsf</pre>
                                                </div>
                                                <small><b></b></small>
                                            </div>
                                        </li>
                                        <br>
                                        <li class="msg-right">
                                            <div class="msg-left-sub">
                                                <div class="msg-desc"></div>
                                                <small><b>sdsadsa</b></small>
                                            </div>
                                        </li>
                                        <br>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="card-footer">
                    <form class="form-horizontal mobile-display" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/insertOrdermessage" enctype="multipart/form-data">
                        <input type="text"  name= "url" value="<?= $current_page ?>">
                        <input type="text" name="login_id" value="<?= $loginid ?>">
                        <input type="text" name="swid" value="<?= $swid ?>">
                        <input type="text" name="id" value="<?= $id ?>">
                        <input type="hidden" name="backurl" value="">
                        <div class="form-group">
                        <div class="row col-md-12">
                            <div class="row col-md-12">
                            <div class="col-md-12 col-sm-12">
                                <textarea type="text" placeholder="Type message" name="description" class="form-control" rows="2" value="" autofocus autocomplete="off" style="resize: none;"></textarea>
                            </div>
                            </div>
                            <div class="row col-md-12">
                            <div class="col-md-12 col-sm-12">
                                <br />
                                <button type="submit" class="btn btn-primary btn-block">Send</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </form>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->

<script src="<?php echo base_url(); ?>assets/node_modules/jquery/dist/jquery.min.js"></script>
