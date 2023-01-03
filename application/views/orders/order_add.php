<?php
defined('BASEPATH') or exit('No direct script access allowed');
$current_page = current_url();
$data = explode('?', $current_page);
$role_id = $this->session->userdata['logged_in']['role_id'];
?>

<!-- Page wrapper  -->
<!-- ============================================================== -->
  
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor"><?php echo $title; ?></h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo $title; ?></li>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4>Order ID: <?= $order_id ?></h4>

                        <form class="floating-labels m-t-40" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/add_new_order" enctype="multipart/form-data">
                            <input type="text" style="display:none;" name="order_id" class="form-control" value="<?= $order_id ?>" autofocus readonly="readonly">
                            <input type="text" style="display:none;" name="order_type" value="Back-End">

                            <div class="row">
                                <!-- Select Customer -->
                                <?php if ($role_id != '2') {  ?>
                                    <div class="col-lg-4">
                                        <div class="form-group has-warning m-b-40">
                                            <?php echo form_dropdown('user_id', $users, '', 'required="required"') ?>
                                            <span class="bar"></span>
                                            <label for="input10">Select customer</label>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <input type="text" style="display:none;" name="user_id" value="<?= @$user_id ?>">
                                <?php } ?>

                                <!-- Project Title -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <input type="text" class="form-control" name="title" required>
                                        <span class="bar"></span>
                                        <label for="input10">Project title</label>
                                    </div>
                                </div>

                                <!-- Select pages -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <input type="text" class="form-control pages" name="pages" required="required">
                                        <span class="bar"></span>
                                        <label for="input10">Select pages</label>
                                    </div>
                                </div>

                                <!-- Enter Discount -->
                                <?php if ($role_id != '2') {  ?>
                                    <div class="col-lg-4">
                                        <div class="form-group has-warning m-b-40">
                                            <input type="text" name="discount_per" class="form-control" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" />
                                            <span class="bar"></span>
                                            <label for="input10">Enter discount</label>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <!-- <div class="col-lg-4">
                                        <div class="form-group has-warning">
                                            <input type="text" name="discount_per" class="form-control discount_per" value="40" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" readonly="readonly" />
                                            <span class="bar"></span>
                                            <label for="input10">Enter discount</label>
                                        </div>
                                    </div> -->
                                <?php } ?>

                                <!-- Order total -->
                                <div class="col-lg-4" hidden>
                                    <div class="form-group has-warning">
                                        <input type="text" name="actualorder" class="actualorder form-control" value="" placeholder="Order total ( &#163; )">
                                        <span class="bar"></span>
                                        <strike class="actualorder" style="font-size: 22px;color:red;"></strike>
                                    </div>
                                </div>

                                <!-- Price after applying coupon -->
                                <?php if($role_id != '2') { ?>
                                <div class="col-lg-4">
                                    <div class="form-group has-warning">
                                        <?php if ($role_id != '2') {  ?>
                                            <input type="text" name="order_total" class="order_total form-control" value="" required>
                                        <?php } else { ?>
                                            <input type="text" style="display:none;" name="order_total" class="order_total form-control" value="">
                                        <?php } ?>
                                        <input type="text" style="display:none;" name="no_of_days" class="no_of_days form-control" value="">
                                        <span class="bar"></span>
                                        <label for="input10">Price after applying coupon</label>
                                        <strike class="actualorder" style="font-size: 22px;color:red;"></strike>
                                        <!-- <span class="ordershow" style="font-size: 22px;color:green;"> </span> -->
                                        <!-- <i style="font-size: 18px;color:green;" class="fa fa-check"></i> -->
                                    </div>
                                </div>
                                <?php } ?>

                                <!-- Delivery Date -->
                                <div class="col-lg-4" style="display: flex;">
                                    <div class="col-6">
                                        <div class="form-group has-warning m-b-40">
                                            <input type="text" class="form-control second delivery_date mdate" name="delivery_date" value="" required>
                                            <span class="bar"></span>
                                            <label for="input10">Delivery date</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <!-- blank -->
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group has-warning m-b-40">
                                            <input type="text" class="form-control timepicker" name="delivery_time" value="">
                                            <span class="bar"></span>
                                            <label for="input10">Time</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Order Date -->
                                <?php if($role_id != '2') { ?> 
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <input type="text" class="form-control first mdate" name="order_date" placeholder="" value="<?php echo date('Y-m-d'); ?>">
                                        <span class="bar"></span>
                                        <label for="input10">Order date</label>
                                    </div>
                                </div>
                                <?php } ?>

                                <!-- College Name -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <input type="text" class="form-control" name="college_name" placeholder="">
                                        <span class="bar"></span>
                                        <label for="input10">College name</label>
                                    </div>
                                </div>

                                <!-- Formatting & Citation Style -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <select class="form-control " name="formatting" required="required">
                                            <option value=""></option>
                                            <?php
                                            foreach ($formattings as $key => $value) { ?>
                                                <option value="<?= $value['formatting_name'] ?>" <?php if ('Harvard' == $value['formatting_name']) { ?> Selected <?php } ?>>
                                                    <?= $value['formatting_name'] ?>
                                                </option>
                                            <?php  } ?>
                                        </select>
                                        <span class="bar"></span>
                                        <label for="input10">Formatting and citation style</label>
                                    </div>
                                </div>

                                <!-- Choose type of service -->
                                <?php if($role_id != '2') { ?>
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <select class="form-control typeofservice" name="typeofservice" required="required">
                                            <option value=""></option>
                                            <?php
                                            foreach ($services as $key => $value) { ?>
                                                <option value="<?= $value['service_name'] ?>" typservice="<?= $value['factor'] ?>" <?php if ('First Class Standard' == $value['service_name']) { ?> selected <?php } ?>>
                                                    <?= $value['service_name'] ?>
                                                </option>
                                            <?php  } ?>
                                        </select>
                                        <span class="bar"></span>
                                        <label for="input10">Choose type of service</label>
                                    </div>
                                </div>
                                <?php } ?>
                                <!-- Choose type of paper -->
                                <?php if($role_id != '2') { ?>
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <select class="form-control typeofpaper" name="typeofpaper" required="required">
                                            <option value=""></option>
                                            <?php
                                            foreach ($typeofpapers as $key => $value) { ?>
                                                <option value="<?= $value['paper_type'] ?>" typpaper="<?= $value['factor'] ?>" <?php if ('Assignment' == $value['paper_type']) { ?> selected <?php } ?>>
                                                    <?= $value['paper_type'] ?>
                                                </option>
                                            <?php  } ?>
                                        </select>
                                        <span class="bar"></span>
                                        <label for="input10">Choose type of paper</label>
                                    </div>
                                </div>
                                <?php } ?>
                                <!-- Choose type of writing -->
                                <?php if($role_id != '2') { ?>
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <select class="form-control typeofwritting" name="typeofwritting" required="required">
                                            <option value=""></option>
                                            <?php
                                            foreach ($typeofwritings as $key => $value) { ?>
                                                <option value="<?= $value['type_of_writing'] ?>" typwrtg="<?= $value['factor'] ?>" <?php if ('Post Graduate' == $value['type_of_writing']) { ?> selected <?php } ?>>
                                                    <?= $value['type_of_writing'] ?>
                                                </option>
                                            <?php  } ?>
                                        </select>
                                        <span class="bar"></span>
                                        <label for="input10">Choose type of writing</label>
                                    </div>
                                </div>
                                <?php } ?>

                                <!-- Enter message -->
                                <div class="col-lg-12">
                                    <div class="form-group has-warning m-b-40">
                                        <textarea type="text" placeholder="" name="message" class="form-control" rows="3" value="" autofocus autocomplete="off" style="resize: none;"></textarea>
                                        <span class="bar"></span>
                                        <label for="input10">Enter message</label>
                                    </div>
                                </div>

                                <!-- Enter message -->
                                <div class="col-lg-12">
                                    <div class="form-group has-warning m-b-40">
                                        <fieldset>
                                            <legend> <b>Upload Files </b></legend>
                                            <div class="table-responsive">
                                                <table id="maintable" class="table">
                                                    <thead style="background-color: #355fa9;color: #ffffff;">
                                                        <tr>
                                                            <th style="width:5%;">S.No.</th>
                                                            <th style="width:90%;"> Upload File</th>
                                                            <th style="width:5%;"> Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="mainbody">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>

                            </div>
                            <!-- / row -->

                            <div class="row">
                                <div class="col">
                                    <button type="reset" class="btn btn-danger btn-block">Reset</button>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->

<script src="<?php echo base_url(); ?>assets/node_modules/jquery/dist/jquery.min.js"></script>

<table id="sample_table1" style="display: none;">
    <tbody>
        <tr class="main_tr1">
            <td>1.</td>
            <td>
                <input type="file" name="bill_image[]" class="form-control upload">
            </td>
            <td>
                <button type="button" class="btn btn-xs btn-primary addrow" style="padding:4px;" href="#" role='button'>
                    <i class="fa fa-plus"></i>
                </button>
                <button type="button" class="btn btn-xs btn-danger deleterow" href="#" style="padding:4px;" role='button'>
                    <i class="fa fa-minus"></i>
                </button>
            </td>
        </tr>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() {

        add_row();
        rename_rows();
        $('body').on('click', '.addrow', function() {

            var table = $(this).closest('table');
            add_row();
            rename_rows();
        });

        function add_row() {
            var tr1 = $("#sample_table1 tbody tr").clone();
            $("#maintable tbody#mainbody").append(tr1);
        }

        $('body').on('click', '.deleterow', function() {

            var table = $(this).closest('table');
            var rowCount = $("#maintable tbody tr.main_tr1").length;
            if (rowCount > 1) {
                if (confirm("Are you sure to remove row ?") == true) {
                    $(this).closest("tr").remove();
                    rename_rows();
                }
            }
        });

        function rename_rows() {
            var i = 0;

            $("#maintable tbody tr.main_tr1").each(function() {
                $(this).find("td:nth-child(1)").html(++i);
                var rowCount1 = $("#maintable tbody tr.main_tr1").length;
            });
        }

        $(document).on('change', '.pages,.typeofservice,.timeline,.typeofpaper,.typeofwritting,.discount_per,.second', function() {
            calculate_total12();
        });

        $(document).on('keyup', '.discount_per', function() {
            calculate_total12();
        });

        $(document).on('keyup', '.order_total', function() {
            var discount_price = $(this).val();

            var actual_price = $('.actualorder').val();

            var divide = (discount_price / actual_price);

            var acutal_discount = ((1 - divide) * 100).toFixed(2);
            $('.discount_per').val(acutal_discount);
            $('.ordershow').html(discount_price);

        });
    });
</script>