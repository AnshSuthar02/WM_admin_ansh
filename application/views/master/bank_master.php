<?php
defined('BASEPATH') or exit('No direct script access allowed');
$base                = base_url();
$hyperlink_ordes     = $base . 'index.php/Orders/index';
$hyperlink_customers = $base . 'index.php/Employees/index';
$role_id             = $this->session->userdata['logged_in']['role_id'];
?>

<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">

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
                <h4 class="text-themecolor"> <?= $title ?> </h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"> <?= $title ?> </li>
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
                    <h3 class="card-title"><?= $title ?></h3>
                    <div class="pull-right ">
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <?php if (!empty($id)) { ?>
                                <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Banks/editbank/<?= $id ?>">
                                <?php } else { ?>
                                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Banks/add_new_bank">
                                    <?php } ?>
                                    <div class="form-group">
                                        <div class="row col-md-12">
                                            <div class="col-md-12 col-sm-12 ">
                                                <label class="control-label">Bank Name</label>
                                                <input type="text" placeholder="Enter Bank name" name="name" class="form-control" value="<?= $name ?>" required autofocus>
                                            </div>
                                        </div>
                                        <div class="row col-md-12">
                                            <div class="col-md-12 col-sm-12 ">
                                                <label class="control-label">Account Holder</label>
                                                <input type="text" placeholder="Enter Account Holder name" name="account_holder" class="form-control" value="<?= $account_holder ?>" required autofocus>
                                            </div>
                                        </div>
                                        <div class="row col-md-12">
                                            <div class="col-md-12 col-sm-12 ">
                                                <label class="control-label">Account Number</label>
                                                <input type="text" placeholder="Enter Account Number" name="account_number" class="form-control" value="<?= $account_number ?>" required autofocus>
                                            </div>
                                        </div>
                                        <div class="row col-md-12">
                                            <div class="col-md-12 col-sm-12 ">
                                                <label class="control-label">Sort Code</label>
                                                <input type="text" placeholder="Enter Sort Code" name="sort_code" class="form-control" value="<?= $sort_code ?>" required autofocus>
                                            </div>
                                        </div>
                                        <span class="help-block"></span>
                                        <?php if (!empty($id)) { ?>
                                            <div class="row col-md-12">
                                                <div class="col-md-12 col-sm-12 ">
                                                    <label class="control-label">Status</label>
                                                    <select class="form-control" name="flag">
                                                        <option value="0"> Active</option>
                                                        <option value="1"> De-active</option>
                                                    </select>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="row col-md-12">
                                            <div class="col-md-12 col-sm-12 ">
                                                <label class="control-label" style="visibility: hidden;"> Name</label><br>
                                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                        </div>
                        <div class="col-md-8">
                            <h5> Bank List</h5>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th> Sr.No.</th>
                                        <th> Bank Name</th>
                                        <th> Account Holder</th>
                                        <th> Account Number</th>
                                        <th> Sort Code</th>
                                        <th> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($categories as $category) { ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $category['name'] ?></td>
                                            <td><?= $category['account_holder'] ?></td>
                                            <td><?= $category['account_number'] ?></td>
                                            <td><?= $category['sort_code'] ?></td>
                                            <td> <a class="btn btn-xs btn-info btnEdit" href="<?php echo base_url(); ?>index.php/Banks/index/<?php echo $category['id']; ?>"><i class="fa fa-edit"></i></a></td>
                                        </tr>
                                    <?php $i++;
                                    } ?>
                                </tbody>
                            </table>
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