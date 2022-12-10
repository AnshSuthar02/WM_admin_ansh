<?php
defined('BASEPATH') or exit('No direct script access allowed');
$current_page   = current_url();
$data           = explode('?', $current_page);
$role_id        = $this->session->userdata['logged_in']['role_id'];
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

    .page-titles {
        margin: 0 !important;
    }

    .card-body {
        padding: 0 !important;
    }
</style>

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
                <h4 class="text-themecolor">Orders List</h4>
                <?php
                $params   = $_SERVER['QUERY_STRING'];
                $fullURL  = $current_page . '?' . $params;
                $_SESSION['fullURL'] = $fullURL;
                ?>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Order List</li>
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

            <!-- Start : Filters -->
            <div class="accordion" id="accordionExample">
                <div class="card m-b-0">
                    <div class="card-body">
                        <form method="get" id="filterForm">
                            <div class="row">
                                <?php if ($role_id == '1' || $role_id == '3' || $role_id == '4' || $role_id == '5') {  ?>
                                    <div class="col-md-3 col-sm-3">
                                        <select name="customer_id" class="form-control select2 customers">
                                            <option value="0"> Select customer name</option>
                                            <?php
                                            if ($all_customers) : ?>
                                                <?php
                                                foreach ($all_customers as $value) : ?>
                                                    <?php
                                                    if (isset($customer_id) && !empty($customer_id) && $value['id'] == $customer_id) : ?>
                                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?> <?= $value['email'] ?> <?= $value['mobile_no'] ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?> <?= $value['email'] ?> <?= $value['mobile_no'] ?></option>
                                                    <?php endif;   ?>
                                                <?php endforeach;  ?>
                                            <?php else : ?>
                                                <option value="0">No result</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                <?php } ?>

                                <?php if ($role_id == '1' || $role_id == '3' || $role_id == '4' || $role_id == '5') { ?>
                                    <div class="col-md-3 col-sm-3">
                                        <select name="order_id" class="form-control select2 ">
                                            <option value="0"> Search By Order Id</option>
                                            <?php
                                            if ($OrderIDs) : ?>
                                                <?php
                                                foreach ($OrderIDs as $value) : ?>

                                                    <option value="<?= $value['order_id'] ?>"><?= $value['order_id'] ?></option>
                                                <?php endforeach;  ?>
                                            <?php else : ?>
                                                <option value="0">No result</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                <?php } ?>

                                <div class="col-md-3 col-sm-3">
                                    <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control mdate" value="<?php echo @$from_date; ?>" placeholder="From Date">
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control mdate" value="<?php echo @$upto_date; ?>" placeholder="Upto Date">
                                </div>
                            </div>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="row mt-3">
                                    <div class="col-md-3 col-sm-3">
                                        <select class="form-control" name="order_date_filter">
                                            <option value="order_date">Order Date</option>
                                            <option value="delivery_date">Delivery Date</option>
                                            <option value="writer">Writer deadline</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <select class="form-control" name="status">
                                            <option value="">Select Order Status</option>
                                            <option value="Pending">Pending</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="Completed">Completed</option>
                                            <option value="Delivered">Delivered</option>
                                            <option value="Feedback">Feedback</option>
                                            <option value="Feedback Delivered">Feedback Delivered</option>
                                            <option value="Cancelled">Cancelled</option>
                                            <option value="Draft Ready">Draft Ready</option>
                                            <option value="Draft Delivered">Draft Delivered</option>
                                            <option value="Other">Other</option>
                                            <option value="initiated">initiated</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <select class="form-control" name="filter_check">
                                            <option value="title">Title</option>
                                            <option value="writer">Writer Name</option>
                                            <option value="college">College Name</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <input type="text" name="title" class="form-control" value="" placeholder="Title, College, Writer">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label class="control-label" style="visibility: hidden;"> Grade</label>
                                    <br>

                                    <input type="submit" class="btn btn-primary" value="Search" />

                                    <label class="control-label" style="visibility: hidden;"> Grade</label>

                                    <a href="<?php echo $data[0] ?>" class="btn btn-danger"> Reset</a>

                                    <label class="control-label" style="visibility: hidden;"> Grade</label>

                                    <button style="background-color: green; color:white;" id="headingOne" class="btn btn-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Show Filters
                                    </button>
                                </div>

                                <?php if ($role_id == 1) { ?>
                                    <div class="col-md-6 col-sm-6" style="text-align: right;">
                                        <label class="control-label" style="visibility: hidden;">Hidden</label>
                                        <br>
                                        <a href="<?php echo base_url('Orders/ordersCSV'); ?>" class="btn btn-success" type="button" style="border:none; background-color: red; color:white;">
                                            Export
                                        </a>
                                    </div>
                                <?php } ?>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Closed : Filters -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list" data-paging="true" data-paging-size="7">
                                <thead>
                                    <tr>
                                        <th style="white-space: nowrap;"> #</th>
                                        <th style="white-space: nowrap;"> Order Code</th>
                                        <th style="white-space: nowrap;"> Order Date</th>
                                        <th style="white-space: nowrap;"> Delivery Date</th>
                                        <th style="white-space: nowrap;"> Title</th>
                                        <th style="white-space: nowrap;"> Status</th>
                                        <th style="white-space: nowrap;"> Words</th>
                                        <th style="white-space: nowrap;"> Amount</th>
                                        <th style="white-space: nowrap;"> Paid </th>
                                        <th style="white-space: nowrap;"> Due </th>
                                        <?php if ($role_id != 2) { ?>
                                            <th style="white-space: nowrap;"> Writer Name</th>
                                            <th style="white-space: nowrap;"> Writer Deadline</th>
                                        <?php } ?>
                                        <th style="white-space: nowrap;"> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
           <?php
		  
          $i=1;foreach($orders as $obj){ ?>
              <tr <?php if($obj['flag']==0){?> style="font-weight: 700;" <?php } ?> class="read_order" order_id="<?=$obj['id'] ?>">
               <!-- <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td> -->
                <td><?php echo $i;?></td>
                <td><?php echo $obj['order_id']; ?></td>
                <td><?php echo date('d-M-Y',strtotime($obj['order_date'])); ?></td>
                <td><?php echo date('d-M-Y',strtotime($obj['delivery_date'])); ?></td>
                <td><?php echo $obj['title']; ?></td>
                 <td><?php $data=$obj['pages'];
                $data1=explode(' (',$data);
                @$data_new=explode(' ',$data1['1']);
               echo $data_new['0'];
                 ?></td>
                <td><?php echo @$obj['amount']; ?> &#163;</td>
                 <?php if($role_id==1){ ?>
                <td><?php echo @$obj['received_amount']; ?> &#163;</td>
                <td><?php echo $obj['amount']-$obj['received_amount']; ?> &#163;</td>
				<td style=""><?php echo @$obj['writer_name']; ?></td>
				<td><?php if(($obj['writer_deadline']!='1970-01-01') and (!empty($obj['writer_deadline']))){ echo date('d-M-Y',strtotime($obj['writer_deadline'])); }  ?></td>
				<td style=""><?php echo @$obj['college_name']; ?></td>
              <?php } ?>
			   <?php if($role_id==3){ ?>
					<td><?php if(($obj['writer_deadline']!='1970-01-01') and (!empty($obj['writer_deadline']))){ echo date('d-M-Y',strtotime($obj['writer_deadline'])); }  ?></td>
			   <?php } ?>
                <td><?php echo $obj['projectstatus']; ?></td>
				<td style="display:none;"><?php echo $obj['c_name']; ?></td>
				<td style="display:none;"><?php echo $obj['c_mobile']; ?></td>
				<td style="display:none;"><?php echo $obj['c_email']; ?></td>
                 <td>
				 
				    <?php if($role_id==1){ ?>
			   <a style="color:#fff;" class="btn btn-xs btn-primary btnEdit" data-toggle="modal" data-target="#duplicate<?php echo $obj['id'];?>"><i class="fa fa-first-order" aria-hidden="true"></i></a>
			   
			     <a  href="<?php echo base_url(); ?>index.php/Orders/indusialemail/<?php echo $obj['id'];?>" style="color:#fff;" class="btn btn-xs btn-warning btnEdit"><i class="fa fa-envelope-open-o" aria-hidden="true"></i></a>
				 
			    <div class="modal fade" id="duplicate<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/duplicate/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title">Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to create duplicate Order ? </p>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary ">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
			  
			  <?php } ?>
			  
                      <?php if($role_id==2){ ?>
                        <button class="btn btn-info btnEdit" data-toggle="modal" title="Download File" data-target="#download<?php echo $obj['id'];?>"><i class="fa fa-download"></i></button>
                        <?php } ?>
						 <a class="btn btn-xs btn-success btnEdit"  href="<?php echo base_url(); ?>index.php/Orders/feedback/<?php echo $obj['id'];?>" ><i style="color:#fff;"class="fa fa-comments"></i></a>

                   <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-eye"></i></a>
                 <?php if($role_id != 2){ ?>

                <?php if(($obj['projectstatus'] =='Delivered') ||  ($obj['projectstatus'] =='Feedback Delivered') || ($obj['projectstatus'] =='Draft Delivered')) { ?>
                  <a class="btn btn-xs btn-success btnEdit"  href="<?php echo base_url(); ?>index.php/Orders/UploadOrder/<?php echo $obj['id'];?>" ><i style="color:#fff;"class="fa fa-check"></i></a>

                <?php }
               ?>
				
                <a class="btn btn-xs btn-success btnEdit"  href="<?php echo base_url(); ?>index.php/Orders/EditOrderFile/<?php echo $obj['id'];?>" ><i style="color:#fff;"class="fa fa-upload"></i></a>
				
				  <a class="btn btn-xs  btn-secondary btnEdit"  href="<?php echo base_url(); ?>index.php/Orders/callstatus/<?php echo $obj['id'];?>" ><i style="color:#fff;"class="fa fa-phone"></i></a>
				  
                <!-- <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-eye"></i></a> -->
            
                <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Orders/Emails/<?php echo $obj['uid'];?>"><i class="fa fa-envelope"></i></a>
                  
              <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a>

            <?php if(($obj['projectstatus'] !='Feedback Delivered') || ($obj['paymentstatus'] !='Completed')) { ?>
			 <?php if($role_id==1){ ?>
              <a href="<?php echo base_url(); ?>index.php/Orders/edit/<?php echo $obj['order_id'];?>"
                  class="btn btn-xs btn-primary btnEdit" > <i style="color:#fff;"class="fa fa-edit"></i>
              </a>
			 <?php } ?>
              <?php } ?> 
                <?php if($obj['paymentstatus'] !='Completed') { ?> 
               <a href="<?php echo base_url(); ?>index.php/Orders/payments/<?php echo $obj['id'];?>"
                  class="btn btn-xs btn-primary btnPayment" > <i style="color:#fff;"class="fa fa-money"> Add Payment</i>
              </a> 
                
              <?php } }?> 
             
                </td>
                <div class="modal fade" id="download<?php echo $obj['id'];?>" role="dialog" tabindex="-1" aria-labelledby="classInfo" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"><?php echo $obj['order_id'];?> Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-md-2 col-sm-2 ">
                                    <label class="control-label"> # </label>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"> Name</label>
                                  </div>
								   <div class="col-md-2 col-sm-2 ">
                                    <label class="control-label"> Date time </label>
                                  </div>
                                   <div class="col-md-2 col-sm-2 ">
                                    <label class="control-label"> Action </label>
                                  </div>
                              </div>
                              <hr>
                              <?php 
                              if(!empty($obj['completed_orders'])){
                                  $k=1;foreach ($obj['completed_orders'] as  $file_details) { ?>
                                     <div class="row">
                                       <div class="col-md-2 col-sm-2 ">
                                        <label class="control-label"> <?= $k ?></label>
                                      </div>
                                       <div class="col-md-6 col-sm-6">
                                       
                                       <?php $name=explode('/',$file_details['file_path']); echo $name[5]; ?>
                                      </div>
									    <div class="col-md-2 col-sm-2 ">
											<?= date("d-m-Y H:i:s",strtotime($file_details['updated_on'])) ?>
									    </div>
                                       <div class="col-md-2 col-sm-2 ">
                                        <label class="control-label"> <a href="<?php echo base_url().'/uploads/'.$file_details['file_path']; ?>" download="download" > <i class="fa fa-download"></i></a></label>
                                      </div>
                                    </div>
                                    <hr>
                              <?php $k++;} }?>
                              
                          </div>
                        </div>
                      </div>
                  </div>
                 <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog" tabindex="-1" aria-labelledby="classInfo" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"><?php echo $obj['order_id'];?> Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                 <?php //if($role_id != '3') { ?>
                                  <fieldset>
                                    <legend> Customer Details</legend>
                                     <div class="row">
                                         <div class="col-md-6 col-sm-6 ">
                                          <label class="control-label">Customer Name :</label>
                                          <span> <?php echo $obj['c_name'];?></span>
                                        </div>
                                         <div class="col-md-6 col-sm-6 ">
                                          <label class="control-label">Email :</label>
                                          <span> <?php echo $obj['c_email'];?></span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 ">
                                          <label class="control-label">Mobile :</label>
                                          <span> <?php echo '+'.$obj['countrycode'].' - '.$obj['c_mobile'];?></span>
                                      </div>                         
                                  </div>
                              </fieldset>
                              <?php // } ?>
                              <fieldset>
                                    <legend> Order Details</legend>
                                   <div class="col-md-6 col-sm-6 ">
                                      <label class="control-label">Order Type :</label>
                                      <span> <?php echo $obj['order_type'];?></span>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Project Title:</label>
                                    <span> <?php echo $obj['title'];?></span>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Order Id :</label>
                                    <span> <?php echo $obj['order_id'];?></span>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Order Date :</label>
                                    <span> <?php echo date('d-M-Y',strtotime($obj['order_date'])); ?></span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Delivery Date :</label>
                                    <span> <?php echo date('d-M-Y',strtotime($obj['delivery_date'])); ?></span>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Type Of Service :</label>
                                    <span> <?php echo $obj['services'];?></span>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Formatting:</label>
                                    <span> <?php echo $obj['formatting'];?></span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Type Of Paper:</label>
                                    <span> <?php echo $obj['typeofpaper'];?></span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Type Of Writting:</label>
                                    <span> <?php echo $obj['typeofwritting'];?></span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Pages:</label>
                                    <span> <?php echo $obj['pages'];?></span>
                                  </div>
                                 <!--  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Number Of Sources:</label>
                                    <span> <?php echo $obj['numberofsources'];?></span>
                                  </div> -->
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Deadline:</label>
                                    <span> <?php echo $obj['deadline'];?> Day</span>
                                  </div>
                                 <!--  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Actual Amount:</label>
                                    <span> <?php echo $obj['actual_amount'];?> &#163;</span>
                                  </div> -->
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Discount % :</label>
                                    <span> <?php echo $obj['discount_per'];?> %</span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Final Amount:</label>
                                    <span> <?php echo $obj['amount'];?> &#163;</span>
                                  </div> 
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Paid Amount:</label>
                                    <span> <?php echo $obj['received_amount'];?> &#163;</span>
                                  </div> 
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Due Amount:</label>
                                    <span> <?php echo $obj['amount']-$obj['received_amount'];?> &#163;</span>
                                  </div> 
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Payment Status:</label>
                                    <span> <?php echo $obj['paymentstatus'];?></span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Project Status:</label>
                                    <span> <?php echo $obj['projectstatus'];?></span>
                                  </div> 
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Message:</label>
                                    <span> <?php echo $obj['message'];?></span>
                                  </div>
                                </div>
                            </div>
                            
                      
                      <fieldset>
                        <legend> Documents Details</legend>
                      
                        <?php 
                       
                        if(!empty($obj['order_file_details'])){
                        $j=1;foreach ($obj['order_file_details'] as  $file_details) {  ?>
                          
                          <div class="row">
                               <div class="col-md-12">
                                    <div class="col-md-4 col-sm-4">
                                      <label><?= $j?></label>
                                    </div>
                                    <div class="col-md-8 col-sm-8 ">
                                    <label class="control-label">Uploaded File :</label>
                                     <div style="height: 10%;width: 100%;">
                                       <a href="<?php echo $file_details['file']; ?>" target="_blank">
                                        <?php
                                         $name=explode('/',$file_details['file']);
                                        
                                         if($obj['order_type']=="Website"){
                                            echo $name[4];
                                         }else{
                                           echo $name[5]; 
                                         }
                                         ?>
                                    </a>
                                    </div>

                                  </div>
                              </div>     
                          </div><hr>
                        
                          <?php $j++;}} ?>
                      </fieldset>
                      <?php if($obj['projectstatus']=='Completed') { ?>
                       <fieldset>
                        <legend> Completed Assignment File </legend>
                          
                          <div class="row">
                               <div class="col-md-12">
                                    <div class="col-md-4 col-sm-4">
                                      <label> Uploaded File from Assignmentinneed.com</label>
                                    </div>
                                    <div class="col-md-8 col-sm-8 ">
                                    <label class="control-label"> File :</label>
                                     <div style="height: 10%;width: 100%;">
                                     <a href="<?php echo base_url().'/uploads/'.$obj['assignment_file']; ?>" target="_blank"> <?= $obj['assignment_file']?></a>
                                    </div>

                                  </div>
                              </div>     
                          </div><hr>                   
                      </fieldset>

                    <?php } ?>
                     
                        </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/deleteorder/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title">Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to delete Order <b><?php echo $obj['order_id'];?> </b>? </p>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary ">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>

                     <!-------------- Approved Requisition Slip Modal Code Start  ---------------->
                    <div class="modal fade" id="approve<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/ActionOrder" enctype="multipart/form-data">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #168c56;color: azure;">
                             <h4 class="modal-title" >Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal" style="color: azure;">&times;</button>
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to <b style="color:#168c56;"> Complete </b>this  Order <b><?php echo $obj['order_id'] ;?> </b>? </p>
                            <input type="hidden" name="user_id" value="<?php echo $obj['uid'];?>">
                            <input type="hidden" name="order_id" value="<?php echo $obj['id'];?>">
                            <input type="hidden" name="status" value="Completed">
                            <input type="hidden" name="approved_date" value="<?= date('Y-m-d') ?>">
                            <div class="form-group">
                                <div class="row col-md-12">
                                  <label  class="control-label"> Comment </label>
                                  <textarea class="form-control Comment" rows="2" placeholder="Enter comment here" name="completed_comment"></textarea>
                              </div>
                              <div class="row col-md-12">
                                  <label  class="control-label"> Upload Assignment </label>
                                  <input type="file" name="assignment_file[]"  multiple="multiple" class="form-control">
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success modal_approve_button" style="background-color: #168c56;">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                    <!--------------  Approved Requisition Slip Modal Code End  ------------ -->
                    
              </tr>
            <?php  $i++;} ?>
          </tbody>
                            </table>

                            <?php if ($role_id == 1 || $role_id == 2) { ?>
                                <?php if (empty($from_date)) { ?>
                                    <div class="pagination">
                                        <?php echo $links; ?> </p>
                                    </div>
                                <?php } ?>
                            <?php } ?>

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

<!-- Start : Models -->

<!-- Closed : Models -->

<script src="<?php echo base_url(); ?>assets/node_modules/jquery/dist/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.read_order').on('click', function(e) {
            var current = $(this);
            id = $(this).attr('order_id');
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/Orders/readorder/" + id,
                cache: false,
                success: function(response) {
                    current.css("font-weight", "");
                }
            });
        });
        jQuery('#master').on('click', function(e) {
            if ($(this).is(':checked', true)) {
                $(".sub_chk").prop('checked', true);
            } else {
                $(".sub_chk").prop('checked', false);
            }
        });
        jQuery('.delete_all').on('click', function(e) {
            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).val());
            });
            if (allVals.length <= 0) {
                alert("Please select row.");
            } else {
                WRN_PROFILE_DELETE = "Are you sure you want to delete all selected customers?";
                var check = confirm(WRN_PROFILE_DELETE);
                if (check == true) {
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>index.php/Orders/deleteorder",
                        cache: false,
                        data: 'ids=' + join_selected_values,
                        success: function(response) {
                            $(".successs_mesg").html(response);
                            location.reload();
                        }
                    });

                }
            }
        });

        $(document).on('click', '.mark_as_failed', function() {
            var row_id = $(this).closest("tr").find('.row_id').val();
            swal({
                title: "Are you sure?",
                text: "Mark this order as failed job!",
                icon: "warning",
                buttons: [
                    'No, cancel it!',
                    'Yes, I am sure!'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url(); ?>index.php/Orders/markAsFailed',
                        data: {
                            row_id: row_id,
                        },
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                } else {
                    // window.location.reload();
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        var base_url = '<?php echo base_url(); ?>';
        $(document).on('change', '.category', function() {
            var category_id = $('.category').find('option:selected').val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('index.php/Customers/getcustomerByCategory/') ?>" + category_id,
                dataType: 'html',
                success: function(response) {
                    $(".customers").html(response);
                    $('.select2').select2();
                }
            });
        });
    });
</script>


