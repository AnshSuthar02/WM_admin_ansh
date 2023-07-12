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
    
  /*  @media screen and (max-device-width:640px), screen and (max-width:992px)*/
  /*{*/
  /*  .hide-mb*/
  /*  {*/
  /*    display: none;*/
  /*  }*/
  }
  
 
</style>

<?php if($role_id ==2){?>
    
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<!--begin::Toolbar-->
		<div class="toolbar" id="kt_toolbar">
			<!--begin::Container-->
			<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
				<!--begin::Page title-->
				<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
									<!--begin::Title-->
									<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Order List
									<!--begin::Separator-->
									<span class="h-20px border-gray-200 border-start ms-3 mx-2">Home</span>
									<!--end::Separator-->
									<!--begin::Description-->
									
									<!--end::Description--></h1>
                                    
									<!--end::Title-->
				</div>
                
				<!--end::Page title-->
				<!--begin::Actions-->
				<div class="card-toolbar" >
					<a href="<?php echo base_url()?>/Orders/add" class="btn btn-sm btn-light btn-active-primary" >
					<!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
					<span class="svg-icon svg-icon-3">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
							<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
						</svg>
					</span>
					<!--end::Svg Icon-->New Orders</a>
				</div>
				<!--end::Actions-->
			</div>
			<!--end::Container-->
		</div>

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
		<!--end::Toolbar-->
		<!--begin::Post-->
		<div class="post d-flex flex-column-fluid" id="kt_post">
			<!--begin::Container-->
			<div id="kt_content_container" class="container-xxl">
				<div class="card">
					<div class="p-10">
                        <div class="col-xl-12">
							<div class="card card-xl-stretch mb-5 mb-xl-12">
								<div class="card-body py-3">
									<div class="table-responsive">
										<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
											<thead>
											    <tr class="fw-bolder text-muted">
    
											    	<th class="min-w-150px">Order Id /Delivery Date/ Title</th>
											    	<th class="min-w-140px">Action</th>
    
											    </tr>
											</thead>
											<tbody>
											     <?php foreach ($leads as $obj ) { ?>
                                                   <tr>
                                                         <td>
                                                           <a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6 d-flex"><?php echo $obj['order_id']; ?> <span class="label label-primary" style="background-color:#ff8acc" > Pending </span> </a>
                                                           <b><span style="color:blue" class="">(<?php echo date('d-M-Y', strtotime($obj['deadline'])); ?>)</span></b>
                                                           <span class="text-muted fw-bold text-muted d-block fs-7"><?php echo $obj['project_title']; ?></span>
                                                           
                                                       </td>
                                                       <td>
                                                       <div class="d-flex flex-shrink-0">
																 <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 " data-bs-toggle="modal" data-bs-target="#kt_modal_new_targetleads<?php echo $obj['order_id']; ?>">
																	<span class="svg-icon svg-icon-3">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
																			<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
																		</svg>
																	</span>
                                                                   
																</a>
                                                                <div class="modal fade" id="kt_modal_new_targetleads<?php echo $obj['order_id']; ?>" tabindex="-1" aria-hidden="true">
                                                                        <!--begin::Modal dialog-->
                                                                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                                                            <!--begin::Modal content-->
                                                                            <div class="modal-content rounded">
                                                                                <!--begin::Modal header-->
                                                                                <div class="modal-header pb-0 border-0 justify-content-end">
                                                                                    <!--begin::Close-->
                                                                                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                                                        <span class="svg-icon svg-icon-1">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                                                                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                                                                            </svg>
                                                                                        </span>
                                                                                        <!--end::Svg Icon-->
                                                                                    </div>
                                                                                    <!--end::Close-->
                                                                                </div>
                                                                                <!--begin::Modal header-->
                                                                                <!--begin::Modal body-->
                                                                                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                                                                                    <!--begin:Form-->
                                                                                    <form id="kt_modal_new_target_form" class="form" action="#">
                                                                                        <!--begin::Heading-->
                                                                                        <div class="mb-13 text-center">
                                                                                       
                                                                                            <!--begin::Title-->
                                                                                            <h1 class="mb-3">Order View <?php echo $obj['id']; ?> </h1>
                                                                                            <!--end::Title-->
                                                                                            <!--begin::Description-->
                                                                                            <div class="text-muted fw-bold fs-5"><?php echo $obj['order_id']; ?>
                                                                                            <a href="#" class="fw-bolder link-primary"> <span class="label label-primary" style="background-color:#ff8acc;">Pending</span></a></div>
                                                                                            <!--end::Description-->
                                                                                        </div>
                                                                                        <!--end::Heading-->
                                                                                        <!--begin::Input group-->
                                                                                        <div class="d-flex flex-column mb-8 fv-row">
                                                                                            <!--end::Label-->
                                                                                             <label class=" fs-6 fw-bold mb-2">Title</label>
                                                                                            <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo $obj['project_title']; ?>" name="target_title" />
                                                                                        </div>
                                                                                        <!--end::Input group-->
                                                                                        <!--begin::Input group-->
                                                                                        <div class="row g-9 mb-8">
                                                                                            <!--begin::Col-->
                                                                                           
                                                                                            <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Order Date</label>
                                                                                            <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo date('d-M-Y', strtotime($obj['create_at'])); ?>" name="target_title" />
                                                                                               
                                                                                            </div>
                                                                                            <!--end::Col-->
                                                                                            <!--begin::Col-->
                                                                                            <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Delivery  Date</label>
                                                                                                <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo date('d-M-Y', strtotime($obj['deadline'])); ?>" name="target_title" />
                                                                                           
                                                                                            </div>
                                                                                            <!--end::Col-->
                                                                                        </div>

                                                                                       

                                                                                        <div class="row g-9 mb-8">
                                                                                            <!--begin::Col-->
                                                                                            <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Pages</label>
                                                                                            <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo $obj['pages']; ?>" name="target_title" />
                                                                                               
                                                                                            </div>
                                                                                            <!--end::Col-->
                                                                                            <!--begin::Col-->
                                                                                            <!-- <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Total Amount</label>
                                                                                                <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo $obj['amount']; ?>" name="target_title" />
                                                                                           
                                                                                            </div> -->
                                                                                            <!--end::Col-->
                                                                                        </div>

                                                                                        <div class="row g-9 mb-8">
                                                                                            <!--begin::Col-->
                                                                                            <!-- <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Paid Amount</label>
                                                                                            <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo $obj['received_amount']; ?>" name="target_title" />
                                                                                               
                                                                                            </div> -->
                                                                                            <!--end::Col-->
                                                                                            <!--begin::Col-->
                                                                                            <!-- <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Due amount</label>
                                                                                                <input readonly type="text" class="form-control form-control-solid" placeholder="" value=" <?php
                                                                                                if (!isset($obj['amount']) && empty($obj['amount'])) {
                                                                                                    $obj['amount'] = 0;
                                                                                                }
                                                                                                echo (int)$obj['amount'] - (int)$obj['received_amount'];
                                                                                                ?>" name="target_title" />
                                                                                           
                                                                                            </div> -->
                                                                                            <!--end::Col-->
                                                                                        </div>

                                                                                       
                                                                                    </form>
                                                                                    <!--end:Form-->
                                                                                </div>
                                                                                <!--end::Modal body-->
                                                                            </div>
                                                                            <!--end::Modal content-->
                                                                        </div>
                                                                        <!--end::Modal dialog-->
                                                            </div>
                                                                
                                                                <!-- <a href="<?php echo base_url(); ?>index.php/Orders/feedback/<?php echo $obj['id']; ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 " ><i style='font: size 10px;' class="	fas fa-comments"></i></a>
                                                               <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 " data-bs-toggle="modal" data-bs-target="#kt_modal_new_target1<?php echo $obj['order_id']; ?>">
																<i style='font: size 10px;' class="	fas fa-download"></i> -->
                                                                   
																</a>
															</div>
                                                       </td>
                                                       
                                                   </tr> 
                                                    
                                                <?php  }?>
                                                <?php foreach ($orders as $obj) { ?>
                                                    <?php
                                                        if ($obj['projectstatus'] == 'Pending') {
                                                            $color = "#ff8acc";
                                                        }elseif ($obj['projectstatus'] == 'Hold Work') {
                                                            $color = "red";
                                                        } elseif ($obj['projectstatus'] == 'Cancelled') {
                                                            $color = "red";
                                                        } elseif ($obj['projectstatus'] == 'Completed' || $obj['projectstatus'] == 'Draft Ready') {
                                                            $color = "#fec107";
                                                        } elseif ($obj['projectstatus'] == 'In Progress') {
                                                            $color = "#5b69bc";
                                                        } elseif ($obj['projectstatus'] == 'Feedback') {
                                                            $color = "black";
                                                        } elseif ($obj['projectstatus'] == 'Delivered' || $obj['projectstatus'] == 'Draft Delivered' || $obj['projectstatus'] == 'Feedback Delivered') {
                                                            $color = "green";
                                                        } elseif ($obj['projectstatus'] == 'initiated') {
                                                            $color = "#fb9678";
                                                        } else {
                                                            $color = "#35b8e0";
                                                        }
                                                    ?>
													<tr>
														<td>
														   
															<a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6 d-flex"><?php echo $obj['order_id']; ?>   <span class="label label-primary" style="background-color:<?= $color ?>;"><?= $obj['projectstatus'] ?> </span> </a>
															<b><span style="color:blue" class="">(<?php echo date('d-M-Y', strtotime($obj['delivery_date'])); ?>)</span></b>
															<span class="text-muted fw-bold text-muted d-block fs-7"><?php echo $obj['title']; ?></span>

															
															
														</td>
														<td>
															<div class="d-flex flex-shrink-0">
																<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 " data-bs-toggle="modal" data-bs-target="#kt_modal_new_target<?php echo $obj['order_id']; ?>">
																	<span class="svg-icon svg-icon-3">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
																			<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
																		</svg>
																	</span>
                                                                   
																</a>
                                                                <a href="<?php echo base_url(); ?>index.php/Orders/feedback/<?php echo $obj['id']; ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 " ><i style='font: size 10px;' class="	fas fa-comments"></i></a>
                                                               <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 " data-bs-toggle="modal" data-bs-target="#kt_modal_new_target1<?php echo $obj['order_id']; ?>">
																<i style='font: size 10px;' class="	fas fa-download"></i>
                                                                   
																</a>
															</div>
                                                            <div class="modal fade" id="kt_modal_new_target<?php echo $obj['order_id']; ?>" tabindex="-1" aria-hidden="true">
                                                                        <!--begin::Modal dialog-->
                                                                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                                                            <!--begin::Modal content-->
                                                                            <div class="modal-content rounded">
                                                                                <!--begin::Modal header-->
                                                                                <div class="modal-header pb-0 border-0 justify-content-end">
                                                                                    <!--begin::Close-->
                                                                                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                                                        <span class="svg-icon svg-icon-1">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                                                                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                                                                            </svg>
                                                                                        </span>
                                                                                        <!--end::Svg Icon-->
                                                                                    </div>
                                                                                    <!--end::Close-->
                                                                                </div>
                                                                                <!--begin::Modal header-->
                                                                                <!--begin::Modal body-->
                                                                                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                                                                                    <!--begin:Form-->
                                                                                    <form id="kt_modal_new_target_form" class="form" action="#">
                                                                                        <!--begin::Heading-->
                                                                                        <div class="mb-13 text-center">
                                                                                       
                                                                                            <!--begin::Title-->
                                                                                            <h1 class="mb-3">Order View <?php echo $obj['id']; ?> </h1>
                                                                                            <!--end::Title-->
                                                                                            <!--begin::Description-->
                                                                                            <div class="text-muted fw-bold fs-5"><?php echo $obj['order_id']; ?>
                                                                                            <a href="#" class="fw-bolder link-primary"> <span class="label label-primary" style="background-color:<?= $color ?>;"><?= $obj['projectstatus'] ?></span></a></div>
                                                                                            <!--end::Description-->
                                                                                        </div>
                                                                                        <!--end::Heading-->
                                                                                        <!--begin::Input group-->
                                                                                        <div class="d-flex flex-column mb-8 fv-row">
                                                                                            <!--end::Label-->
                                                                                             <label class=" fs-6 fw-bold mb-2">Title</label>
                                                                                            <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo $obj['title']; ?>" name="target_title" />
                                                                                        </div>
                                                                                        <!--end::Input group-->
                                                                                        <!--begin::Input group-->
                                                                                        <div class="row g-9 mb-8">
                                                                                            <!--begin::Col-->
                                                                                           
                                                                                            <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Order Date</label>
                                                                                            <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo date('d-M-Y', strtotime($obj['order_date'])); ?>" name="target_title" />
                                                                                               
                                                                                            </div>
                                                                                            <!--end::Col-->
                                                                                            <!--begin::Col-->
                                                                                            <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Delivery  Date</label>
                                                                                                <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo date('d-M-Y', strtotime($obj['delivery_date'])); ?>" name="target_title" />
                                                                                           
                                                                                            </div>
                                                                                            <!--end::Col-->
                                                                                        </div>

                                                                                       

                                                                                        <div class="row g-9 mb-8">
                                                                                            <!--begin::Col-->
                                                                                            <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Pages</label>
                                                                                            <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo $obj['pages']; ?>" name="target_title" />
                                                                                               
                                                                                            </div>
                                                                                            <!--end::Col-->
                                                                                            <!--begin::Col-->
                                                                                            <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Total Amount</label>
                                                                                                <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo $obj['amount']; ?>" name="target_title" />
                                                                                           
                                                                                            </div>
                                                                                            <!--end::Col-->
                                                                                        </div>

                                                                                        <div class="row g-9 mb-8">
                                                                                            <!--begin::Col-->
                                                                                            <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Paid Amount</label>
                                                                                            <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo $obj['received_amount']; ?>" name="target_title" />
                                                                                               
                                                                                            </div>
                                                                                            <!--end::Col-->
                                                                                            <!--begin::Col-->
                                                                                            <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Due amount</label>
                                                                                                <input readonly type="text" class="form-control form-control-solid" placeholder="" value=" <?php
                                                                                                if (!isset($obj['amount']) && empty($obj['amount'])) {
                                                                                                    $obj['amount'] = 0;
                                                                                                }
                                                                                                echo (int)$obj['amount'] - (int)$obj['received_amount'];
                                                                                                ?>" name="target_title" />
                                                                                           
                                                                                            </div>
                                                                                            <!--end::Col-->
                                                                                        </div>

                                                                                       
                                                                                    </form>
                                                                                    <!--end:Form-->
                                                                                </div>
                                                                                <!--end::Modal body-->
                                                                            </div>
                                                                            <!--end::Modal content-->
                                                                        </div>
                                                                        <!--end::Modal dialog-->
                                                            </div>
                                                            
                                                            
                                                            <div class="modal fade" id="kt_modal_new_target1<?php echo $obj['order_id']; ?>" tabindex="-1" aria-hidden="true">
                                                                        <!--begin::Modal dialog-->
                                                                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                                                            <!--begin::Modal content-->
                                                                            <div class="modal-content rounded">
                                                                                <!--begin::Modal header-->
                                                                                <div class="modal-header pb-0 border-0 justify-content-end">
                                                                                    <!--begin::Close-->
                                                                                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                                                        <span class="svg-icon svg-icon-1">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                                                                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                                                                            </svg>
                                                                                        </span>
                                                                                        <!--end::Svg Icon-->
                                                                                    </div>
                                                                                    <!--end::Close-->
                                                                                </div>
                                                                                <!--begin::Modal header-->
                                                                                <!--begin::Modal body-->
                                                                                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                                                                                   <fieldset class="scheduler-border">
                                                                <legend class="scheduler-border"> Documents Details</legend>
                                                                <?php
                                                                if (!empty($obj['order_file_details'])) {
                                                                    $j = 1;
                                                                    foreach ($obj['order_file_details'] as  $file_details) {  ?>
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label><?= $j ?></label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <label class="control-label">Uploaded File :</label>
                                                                                 <div style="height: 10%;width: 100%;">
                                                                                    <a href="<?php echo $file_details['file']; ?>" target="_blank">
                                                                                        <?php
                                                                                        $name = explode('/', $file_details['file']);

                                                                                        if ($obj['order_type'] == "Website") {
                                                                                            echo $name[4];
                                                                                        } else {
                                                                                            echo $name[5];
                                                                                        }
                                                                                        ?>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                <?php $j++;
                                                                    }
                                                                } ?>
                                                            </fieldset>
                                                                                </div>
                                                                                <!--end::Modal body-->
                                                                            </div>
                                                                            <!--end::Modal content-->
                                                                        </div>
                                                                        <!--end::Modal dialog-->
                                                            </div>
														</td>
													</tr>
                                                <?php } ?>
											</tbody>
											<!--end::Table body-->
										</table>
									</div>
								</div>
							</div>
					    </div>
				    </div>
				</div>
			</div>
			<!--end::Container-->
		</div>
		<!--end::Post-->
	</div>
<?php } else { ?>
<!-- Page wrapper  -->
<!-- ============================================================== -->
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
                        <?php if($role_id != '2') { ?>
                        <form method="get" id="filterForm">
                            <div class="row">
                                
                                <?php if ($role_id == '1' || $role_id == '3' || $role_id == '4'  ) {  ?>
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
                                <?php } elseif( $role_id == '5') { ?>
                                    <div class="col-md-3 col-sm-3 d-none ">
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
                                    <?php }?>

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
                                            <option value="draft_deadline">Draft deadline</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <select class="form-control" name="status">
                                            <option value="">Select Order Status</option>
                                            <option value="Pending">Pending</option>
                                             <option value="Hold Work">Hold Work</option>
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
                                        <select id='purpose' class="form-control purpose" name="filter_check">
                                            <option value="title">Title</option>
                                            <option value="writer">Writer Name</option>
                                            <option value="college">College Name</option>
                                        </select>
                                    </div>
                                    <div id='hideqw' class="col-md-3 col-sm-3">
                                        <input type="text" name="title" class="form-control" value="" placeholder="Title, College, ">
                                    </div>

                                    <div class="col-md-3 col-sm-3" id='business' style='display:none'>
                                        <select name="writer_name" class="form-control" required>
                                            <option value=" " <?php if (@$obj['writer_name'] == ' ') {
                                                            echo "selected";
                                                        } ?>> </option>
                                            <option value="team 01" <?php if (@$obj['writer_name'] == 'team 01') {
                                                            echo "selected";
                                                        } ?>>team 1</option>
                                            <option value="team 02" <?php if (@$obj['writer_name'] == 'team 02') {
                                                            echo "selected";
                                                        } ?>>team 2</option>
                                            <option value="team 03" <?php if (@$obj['writer_name'] == 'team 03') {
                                                            echo "selected";
                                                        } ?>>team 3</option>
                                            <option value="team 04" <?php if (@$obj['writer_name'] == 'team 04') {
                                                            echo "selected";
                                                        } ?>>team 4</option>
                                            <option value="team 05" <?php if (@$obj['writer_name'] == 'team 05') {
                                                            echo "selected";
                                                        } ?>>team 5</option>
                                            <option value="team 06" <?php if (@$obj['writer_name'] == 'team 06') {
                                                            echo "selected";
                                                        } ?>>team 6</option>
                                            <option value="team 07" <?php if (@$obj['writer_name'] == 'team 07') {
                                                            echo "selected";
                                                        } ?>>team 7</option>
                                            <option value="team 08" <?php if (@$obj['writer_name'] == 'team 08') {
                                                            echo "selected";
                                                        } ?>>team 8</option>
                                            <option value="team 09" <?php if (@$obj['writer_name'] == 'team 09') {
                                                            echo "selected";
                                                        } ?>>team  9</option>
                                            <option value="team 010" <?php if (@$obj['writer_name'] == 'team 010') {
                                                        } ?>>team 10</option>
                                            <option value="team 011" <?php if (@$obj['writer_name'] == 'team 011') {
                                            } ?>>team 11</option>

                                            <option value="team 012" <?php if (@$obj['writer_name'] == 'team 012') {
                                            } ?>>team 12</option>
                                             <option value="team 013" <?php if (@$obj['writer_name'] == 'team 013') {
                                                                                                } ?>>team 13</option>
                                        </select>
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
                                        <a href="<?php echo base_url('index.php/Orders/ordersCSV'); ?>" class="btn btn-success" type="button" style="border:none; background-color: red; color:white;">
                                            Export
                                        </a>
                                    </div>
                                <?php } ?>

                            </div>
                        </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- <?php foreach($deliverd as $deli){?>
                <input type="hidden" id='get<?php echo $obj['order_id']; ?>' value='<?php echo $deli['id_orders'] ?>'>
                <input type="hidden" id='time<?php echo $obj['order_id']; ?>' value='<?php echo $deli['deliveredDate'] ?>'>
                <input type="hidden" id='order<?php echo $obj['order_id']; ?>' value='<?php echo $deli['deliveredTime'] ?>'>

            <?php }?> -->
            <!-- Closed : Filters -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list" data-paging="true" data-paging-size="7">
                                <thead>
                                    <tr>
                                        <th style="white-space: nowrap; " class="hide-mb"> #</th>
                                        <th style="white-space: nowrap;"  > Order Code</th>
                                        <th style="white-space: nowrap;" class="hide-mb"> Order Date</th>
                                        <th style="white-space: nowrap;"  class="hide-mb"> Delivery Date</th>
                                        <th style="white-space: nowrap;"class="hide-mb"> Title</th>
                                        <th style="white-space: nowrap;"  class="hide-mb"> Status</th>
                                        <th style="white-space: nowrap;" class="hide-mb"> Words</th>
                                        <?php if($role_id != '5') {  ?>
                                        <th style="white-space: nowrap;" class="hide-mb"> Amount</th>
                                        <th style="white-space: nowrap;" class="hide-mb"> Paid </th>
                                        <th style="white-space: nowrap;" class="hide-mb"> Due </th>
                                        <?php } if ($role_id != 2) { ?>
                                            <?php  if ($role_id != 4) { ?>
                                            <th style="white-space: nowrap;"class="hide-mb"> Writer Name</th>
                                          
                                            <th style="white-space: nowrap;" class="hide-mb"> Writer Deadline</th>
                                            <?php } ?>
                                        <?php } ?>
                                        <!-- <th style="white-space: nowrap;" > Action </th> -->
                                        <?php if($role_id != '2') { ?>
                                        <th style="white-space: nowrap;" class="hide-mb">Action</th>
                                     
                                       <?php  } else { ?>
                                           <th style="white-space: nowrap; " class="" >  <i class="fa fa-check btn bg-primary" style="font-size: 15px;"></i> </th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($orders as $obj) { ?>
                                   <?php
                                      
                                      if ($obj['c_is_fail'] == 1 && $obj['is_fail'] == 1) {
                                        $class = "red-background";
                                    } elseif ($obj['c_is_fail'] == 1 && $obj['is_fail'] == 0) {
                                        $class = "lite-blue-background";
                                    } else {
                                        $class = "";  // No background color
                                    }


                                     ?>

                                    <style>
                                            .lite-blue-background {
                                                color: blue;
                                            }
                                            
                                            .red-background {
                                                color: red;
                                            }
                                        </style>
                                    



                                        <tr <?php if ($obj['is_read'] == 0) { ?> style="font-weight: 700;" <?php } ?> class="read_order " order_id="<?= $obj['id'] ?>">
                                            <input type="hidden" class="row_id" value="<?= $obj['id'] ?>">
                                            <input type="hidden" class="uid" value="<?= $obj['uid'] ?>">
                                            <td class="hide-mb">
                                                <?php echo $i; ?>
                                            </td>
                                            <td style="white-space: nowrap;">
                                                <?php echo $obj['order_id']; ?>
                                            </td >
                                            <td class="hide-mb" style="white-space: nowrap;">
                                                <?php echo date('d-M-Y', strtotime($obj['order_date'])); ?>
                                            </td >
                                            <td class="hide-mb" id='v' style="white-space: nowrap;">
                                                <?php
                                                echo date('d-M-Y', strtotime($obj['delivery_date']));
                                                if (isset($obj['delivery_time']) && !empty($obj['delivery_time'])) {echo ' ( ' . $obj['delivery_time'] . ' )';}
                                                ?>
                                                <div style="color:green">
                                                <?php if($obj['draftrequired'] == 'Yes') 
                                                {
                                                    echo date('d-M-Y', strtotime($obj['draft_date']));
                                                    if (isset($obj['draft_time']) && !empty($obj['draft_time'])) {
                                                        echo ' ( ' . $obj['draft_time'] . ' )';
                                                    }
                                                }
                                                ?>
                                                </div>

                                                
                                            </td>
                                           
                                            
                                               
                                               
                                            <td class="hide-mb">
                                                <?php echo $obj['title']; 
                                                ?>
                                                <div style='color:red'>
                                                <?php 
                                                if ($obj['typeofpaper'] == 'Dissertation (all chapters)' ||$obj['typeofpaper'] == 'Thesis (all chapters)' || $obj['typeofpaper'] == 'Research Paper')
                                                {
                                                    echo $obj['chapter'];
                                                }
                                                ?>
                                                </div>
                                                
                                            </td>

                                            <td class="hide-mb" style="white-space: nowrap;">
                                                <?php
                                                if ($obj['projectstatus'] == 'Pending') {
                                                    $color = "#ff8acc";
                                                } elseif ($obj['projectstatus'] == 'Cancelled') {
                                                    $color = "red";
                                                    
                                                } elseif ($obj['projectstatus'] == 'Hold Work') {
                                                    $color = "red";
                                                    
                                                } elseif ($obj['projectstatus'] == 'Completed' || $obj['projectstatus'] == 'Draft Ready') {
                                                    $color = "#fec107";
                                                } elseif ($obj['projectstatus'] == 'In Progress') {
                                                    $color = "#5b69bc";
                                                } elseif ($obj['projectstatus'] == 'Feedback') {
                                                    $color = "black";
                                                } elseif ($obj['projectstatus'] == 'Delivered' || $obj['projectstatus'] == 'Draft Delivered' || $obj['projectstatus'] == 'Feedback Delivered') {
                                                    $color = "green";
                                                } elseif ($obj['projectstatus'] == 'initiated') {
                                                    $color = "#fb9678";
                                                } else {
                                                    $color = "#35b8e0";
                                                }
                                                ?>
                                                <span class="label label-primary" style="background-color:<?= $color ?>;">
                                                    <?= $obj['projectstatus'] ?>
                                                </span>
                                            </td>

                                            <td style="white-space: nowrap; " class="hide-mb">
                                                <?php
                                                $data = $obj['pages'];
                                                $data1 = explode(' (', $data);
                                                @$data_new = explode(' ', $data1['1']);
                                                if (isset($data_new['0']) && !empty($data_new['0'])) {
                                                    echo $data_new['0'];
                                                } else {
                                                    echo $obj['pages'];
                                                }
                                                ?>
                                            </td>
 
                                            <?php if($role_id != 5) { ?>
                                            <td style="white-space: nowrap;" class="hide-mb">
                                                <?php echo @$obj['amount']; ?> &#163;
                                            </td>
                                            <?php } ?>
                                            <?php
                                            if (!isset($obj['amount']) && empty($obj['amount'])) {
                                                $obj['amount'] = 0;
                                            }
                                            ?>
                                             <?php if($role_id != 5) { ?>
                                            <td style="white-space: nowrap;" class="hide-mb">
                                                <?php echo @$obj['received_amount']; ?> &#163;
                                            </td>
                                            
                                            
                                            <td style="white-space: nowrap;" class="hide-mb">
                                                <?php
                                                if (!isset($obj['amount']) && empty($obj['amount'])) {
                                                    $obj['amount'] = 0;
                                                }
                                                echo (float)$obj['amount'] - (float)$obj['received_amount'];
                                                ?>
                                                &#163;
                                            </td>
                                            <?php } ?>

                                            <?php
                                            if ($role_id != 2) {
                                                
                                                if($role_id != 4) {
                                                ?>
                                                
                                                <td class="hide-mb">
                                                    <?php echo $obj['writer_name']; ?>
                                                </td>
                                                
                                                <td class="hide-mb" >
                                                    <?php if (($obj['writer_deadline'] != '1970-01-01') and (!empty($obj['writer_deadline']))) {
                                                        echo date('d-M-Y', strtotime($obj['writer_deadline']));
                                                    }  ?>
                                                </td>
                                                <?php } ?>
                                            <?php } ?>

                                            <td style="display:none;"><?php echo $obj['c_name']; ?></td>
                                            <td style="display:none;"><?php echo $obj['c_mobile']; ?></td>
                                            <td style="display:none;"><?php echo $obj['c_email']; ?></td>

                                            <!-- Action Buttons -->
                                            <td style="white-space: nowrap;">
                                                    
                                            <?php if($role_id != '2') { ?>
                                                <a class="btn btn-xs btn-info btn-sm m-1" data-bs-toggle="modal" data-bs-target="#view<?php echo $obj['id']; ?>">
                                                    <i style="color:#fff;" class="fa fa-eye"></i>
                                                </a>
                                                <?php  }   ?>

                                                <?php if ($role_id == 1) { ?>
                                                    <!-- <a href="<?php echo base_url(); ?>index.php/Orders/edit/<?php echo $obj['order_id']; ?>" class="btn btn-xs btn-dark btn-sm m-1">
                                                        <i style="color:#fff;" class="fa fa-edit"></i>
                                                    </a> -->
                                                    <a type="button" class="btn btn-xs btn-dark btn-sm m-1" data-bs-toggle="modal" data-bs-target="#editModal<?= $obj['id'] ?>" title="Order Edit">
                                                        <i style="color:#fff;" class="fa fa-edit"></i>
                                                    </a>
                                                <?php } ?>

                                                <?php if ($role_id != 2) { ?>

                                                    <?php
                                                    if (isset($obj['quotation_status']) && $obj['quotation_status'] == 1) {
                                                        $btn_class = 'success';
                                                    } else {
                                                        $btn_class = 'danger';
                                                    }
                                                    ?>
                                                    <?php if (($obj['projectstatus'] == 'Other') || ($obj['projectstatus'] == 'In Progress') || ($obj['projectstatus'] == 'Pending')  || ($obj['projectstatus'] == 'initiated') ) { ?>
                                                        <a class="btn btn-xs btn-<?= $btn_class ?> btn-sm m-1" href="<?php echo base_url(); ?>index.php/Orders/Emails/<?php echo $obj['uid']; ?>">
                                                            <i class="fa fa-envelope"></i>
                                                        </a>
                                                    <?php } ?>

                                                    <?php if (($obj['projectstatus'] != 'Feedback Delivered') || ($obj['paymentstatus'] != 'Completed')) { ?>
                                                        <?php if ($role_id == 3 || $role_id == 4 || $role_id == 5) { ?>
                                                            <a type="button" class="btn btn-xs btn-dark btn-sm m-1" data-bs-toggle="modal" data-bs-target="#editModal<?= $obj['id'] ?>" title="Order Edit">
                                                                <i style="color:#fff;" class="fa fa-edit"></i>
                                                            </a>
                                                        <?php } ?>
                                                    <?php } ?>

                                                    <?php if ($obj['paymentstatus'] != 'Completed') { ?>
                                                        <!-- <a href="<?php echo base_url(); ?>index.php/Orders/payments/<?php echo $obj['id']; ?>" class="btn btn-xs btn-light btnPayment m-1" title="Add Payment" style="background-color: red;">
                                                            <i style="color:#fff;" class="fa fa-money"></i>
                                                        </a> -->
                                                        <?php if($role_id != 5) { ?>
                                                        <a type="button" class="btn btn-xs btn-primary btn-sm m-1" data-bs-toggle="modal" data-bs-target="#paymentModal<?= $obj['id'] ?>" title="Order Payment" style="background-color: red;">
                                                            <i style="color:#fff;" class="fa fa-money"></i>
                                                        </a>
                                                    <?php }  }?>

                                                    <?php if ($obj['projectstatus'] == 'Pending' || $obj['projectstatus'] == 'Cancelled') { ?>
                                                        <a class="btn btn-xs btn-warning btn-sm m-1" href="<?php echo base_url(); ?>index.php/Orders/callstatus/<?php echo $obj['id']; ?>">
                                                            <i style="color:#fff;" class="fa fa-phone"></i>
                                                        </a>
                                                    <?php } ?>

                                                <?php } ?>

                                                <!-- Mark Job Failed -->
                                                <?php if($role_id != '2') { ?>
                                                <a type="button" class="btn btn-xs btn-primary btn-sm m-1 mark_as_failed" title="Mark as failed job" style="background-color:tomato;">
                                                    <i style="color:#fff;" class="fa fa-close"></i>
                                                </a>
                                                <?php } ?>

                                               
                                                <!-- / Mark Job Failed -->

                                                <!-- Button trigger modal -->
                                                <a type="button" class="btn btn-xs btn-primary btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $obj['id'] ?>" title="More buttons">
                                                    <i style="color:#fff;" class="fa fa-list"></i>
                                                </a>
                                                <!-- Button trigger modal -->

                                                <!-- More Buttons Modal -->
                                                <div class="modal fade" id="exampleModal<?= $obj['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">More Buttons</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-bodwy">
                                                                <?php if ($role_id == 1) { ?>
                                                                    <a style="color:#fff;" class="btn btn-xs btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#duplicate<?php echo $obj['id']; ?>">
                                                                        <i class="fa fa-first-order" aria-hidden="true"></i>
                                                                    </a>

                                                                    <a href="<?php echo base_url(); ?>index.php/Orders/indusialemail/<?php echo $obj['id']; ?>" style="color:#fff;" class="btn btn-xs btn-warning btn-sm">
                                                                        <i class="fa fa-envelope-open-o" aria-hidden="true"></i>
                                                                    </a>

                                                                    <!-- <a href="<?php echo base_url(); ?>index.php/Orders/payments/<?php echo $obj['id']; ?>" class="btn btn-xs btn-light btnPayment m-1" title="Add Payment" style="background-color: red;">
                                                                        <i style="color:#fff;" class="fa fa-money"></i>
                                                                    </a> -->
                                                                    <a type="button" class="btn btn-xs btn-primary btn-sm m-1" data-bs-toggle="modal" data-bs-target="#paymentModal<?= $obj['id'] ?>" title="Order Payment" style="background-color: red;">
                                                                        <i style="color:#fff;" class="fa fa-money"></i>
                                                                    </a>

                                                                    <!-- Duplicate row modal -->
                                                                    <div class="modal fade" id="duplicate<?php echo $obj['id']; ?>" role="dialog">
                                                                        <div class="modal-dialog">
                                                                            <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/duplicate/<?php echo $obj['id']; ?>">
                                                                                <!-- Modal content-->
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title">Confirm Header </h4>
                                                                                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <p>Are you sure, you want to create duplicate Order ? </p>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="submit" class="btn btn-primary ">Submit</button>
                                                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>

                                                                <?php } ?>

                                                                <?php if ($role_id == 2) { ?>
                                                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" title="Download File" data-bs-target="#download<?php echo $obj['id']; ?>"><i class="fa fa-download"></i></button>
                                                                <?php } ?>

                                                                <a class="btn btn-xs btn-success btn-sm" href="<?php echo base_url(); ?>index.php/Orders/feedback/<?php echo $obj['id']; ?>">
                                                                    <i style="color:#fff;" class="fa fa-comments"></i>
                                                                </a>
 
                                                                <?php if($role_id == '2') { ?>
                                                                <a class="btn btn-xs btn-info btn-sm m-1" data-bs-toggle="modal" data-bs-target="#view<?php echo $obj['id']; ?> " >
                                                                    <i style="color:#fff;" class="fa fa-eye"></i>
                                                                </a>    
                                                                <?php } ?>
                                                                
                                                                <?php if ($role_id != 2) { ?>

                                                                    <?php 
                                                                    // if (($obj['projectstatus'] == 'Delivered') ||  ($obj['projectstatus'] == 'Feedback Delivered') || ($obj['projectstatus'] == 'Draft Delivered')|| ($obj['projectstatus'] == 'Completed')) {
                                                                    ?>
                                                                        <a class="btn btn-xs btn-success btn-sm" href="<?php echo base_url(); ?>index.php/Orders/UploadOrder/<?php echo $obj['id']; ?>">
                                                                            <i style="color:#fff;" class="fa fa-check"></i>
                                                                        </a>
                                                                    <?php
                                                                    // }
                                                                    ?>

                                                                    <a class="btn btn-xs  btn-secondary btn-sm m-1" href="<?php echo base_url(); ?>index.php/Orders/callstatus/<?php echo $obj['id']; ?>">
                                                                        <i style="color:#fff;" class="fa fa-phone"></i>
                                                                    </a>

                                                                    <a class="btn btn-xs btn-success btn-sm" href="<?php echo base_url(); ?>index.php/Orders/EditOrderFile/<?php echo $obj['id']; ?>">
                                                                        <i style="color:#fff;" class="fa fa-upload"></i>
                                                                    </a>

                                                                    <?php if ($role_id != 1) { ?>
                                                                        <a style="color:#fff;" class="btn btn-xs btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#duplicate<?php echo $obj['id']; ?>">
                                                                            <i class="fa fa-first-order" aria-hidden="true"></i>
                                                                        </a>

                                                                        <!-- Duplicate row modal -->
                                                                        <div class="modal fade" id="duplicate<?php echo $obj['id']; ?>" role="dialog">
                                                                            <div class="modal-dialog">
                                                                                <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/duplicate/<?php echo $obj['id']; ?>">
                                                                                    <!-- Modal content-->
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h4 class="modal-title">Confirm Header </h4>
                                                                                            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <p>Are you sure, you want to create duplicate Order ? </p>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="submit" class="btn btn-primary ">Submit</button>
                                                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>

                                                                    <?php if ($role_id == 1) { ?>
                                                                        <a class="btn btn-xs btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?php echo $obj['id']; ?>">
                                                                            <i style="color:#fff;" class="fa fa-trash"></i>
                                                                        </a>
                                                                    <?php } ?>

                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- / More Buttons Modal -->

                                                <!-- Payment Details Model -->
                                                <div class="modal fade bd-example-modal-xl" id="paymentModal<?= $obj['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title" id="exampleModalLabel">
                                                                    <a href="<?php echo base_url(); ?>index.php/Orders/payments/<?php echo $obj['id']; ?>" target="_blank">
                                                                        <i class="fa fa-external-link"></i>
                                                                    </a>
                                                                    Payment Details <span style="color:lightsalmon"> Order ID : <?= $obj['order_id'] ?> </span>
                                                                </h3>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <!-- modal-header -->
                                                            <div class="modal-body">
                                                                <div class="card-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-striped">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th> Payment Date</th>
                                                                                    <th> Amount </th>
                                                                                    <th> References </th>
                                                                                    <th> Status </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php
                                                                                if (!empty($obj['payment_details'])) {
                                                                                    foreach ($obj['payment_details'] as $p_obj) { ?>
                                                                                        <tr>
                                                                                            <td><?php echo $p_obj['payment_date']; ?></td>
                                                                                            <td><?php echo $p_obj['paid_amount']; ?></td>
                                                                                            <td>
                                                                                                <?php echo $p_obj['reference']; ?>
                                                                                                <input type="hidden" class="row_id" value="<?php echo $p_obj['id']; ?>">
                                                                                                
                                                                                                <input type="hidden" class="row_paid_amount" value="<?php echo $p_obj['paid_amount']; ?>">
                                                                                                <input type="hidden" class="row_order_row_id" value="<?= $p_obj['order_id'] ?>">
                                                                                            </td>
                                                                                            <td>
                                                                                                <?php if ($p_obj['account_status'] == 1) {
                                                                                                    echo "Verified";
                                                                                                } else {
                                                                                                    echo "Not Verified";
                                                                                                } ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                    <?php
                                                                                    }
                                                                                } else { ?>
                                                                                    <tr>
                                                                                        <td>No records found!</td>
                                                                                    </tr>
                                                                                <?php } ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>

                                                                    <br>
                                                                    <hr>
                                                                    <h3> Make New Payment Here </h3>
                                                                    <span style="color:lightsalmon">
                                                                        Order Amount : <?php echo $obj['amount']; ?>
                                                                    </span>
                                                                    <hr>

                                                                    <?php
                                                                    $amt   = $obj['amount'];
                                                                    $r_amt = $obj['received_amount'];
                                                                    if (isset($obj['received_amount']) && !empty($obj['received_amount']) && isset($obj['amount']) && !empty($obj['amount'])) {
                                                                        $r_a_new = (float)$amt - (float)$r_amt;
                                                                    } else {
                                                                        $r_a_new = '0';
                                                                    }
                                                                    $remaining_amount_old = $r_a_new;
                                                                    ?>
                                                                    <!-- Form -->
                                                                    <form class="form-horizontal" id="myForm" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/addPayment" enctype="multipart/form-data">
                                                                        <input type="hidden" name="from_order_list" value="1">
                                                                        <input type="hidden" class="order_row_id" name="order_row_id" value="<?= $obj['id'] ?>">
                                                                        <input type="hidden" class="order_total" name="order_total" value="<?= $obj['amount'] ?>">
                                                                        <input type="hidden" class="received_amount" name="received_amount" value="<?= $obj['received_amount'] ?>">
                                                                        <input type="hidden" class="current_page" name="current_page" value="<?= $current_page ?>">
                                                                        <input type="hidden" class="remaining_amount_old" name="remaining_amount_old" value="<?php echo $remaining_amount_old; ?>">
                                                                        <input type="hidden" name="backurl" value="<?= $current_page ?>">

                                                                        <div class="row d-flex">
                                                                            <div class="col-md-4">
                                                                                <?php if ($role_id == 1) { ?>
                                                                                    <label class="control-label"> Payment Date </label>
                                                                                    <br>
                                                                                    <input type="text" name="payment_date" value="<?php echo date('l d F Y h:i A'); ?>" class="form-control min-date" required>
                                                                                <?php } else { ?>
                                                                                    <label class="control-label"> Payment Date </label>
                                                                                    <br>
                                                                                    <input type="text" name="payment_date" value="<?php echo date('l d F Y h:i A'); ?>" class="form-control min-date" readonly>
                                                                                <?php } ?>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <label> Paid Amount :</label>
                                                                                <br>
                                                                                <input type="text" placeholder="Enter Paid Amount" name="paid_amount" class="form-control paid_amount" required="required">
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <label> Remaining Amount :</label>
                                                                                <br>
                                                                                <input type="text" placeholder="Remaining Amount" name="remaining_amount" class="form-control remaining_amount" value="<?php echo (float)($remaining_amount_old); ?>" readonly="readonly">
                                                                            </div>
                                                                        </div>
                                                                        <br>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <label> Payment Reference :</label>
                                                                                <br>
                                                                                <textarea type="text" placeholder="Enter reference here" name="reference" class="form-control " value="" rows="3" required></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <br>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <button type="submit" class="btn btn-primary btn-block"> Submit Payment</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                    <!-- Form -->
                                                                </div>
                                                                <!-- card-body -->
                                                            </div>
                                                            <!-- modal-body -->
                                                        </div>
                                                        <!-- modal-content -->
                                                    </div>
                                                    <!-- modal-dialog modal-xl -->
                                                </div>
                                                <!-- / Payment Details Model -->
                                                                                    
                                                <!-- Update Order Model -->
                                                <div class="modal fade bd-example-modal-xl" id="editModal<?= $obj['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title" id="exampleModalLabel">
                                                                    <a href="<?php echo base_url(); ?>index.php/Orders/edit/<?php echo $obj['order_id']; ?>" target="_blank">
                                                                        <i class="fa fa-external-link"></i>
                                                                    </a>
                                                                     Update Order <a href="<?php echo base_url(); ?>index.php/Orders/UploadOrder/<?php echo $obj['id']; ?>"> <span style="color:lightsalmon"> Order ID : <?= $obj['order_id'] ?> </span></a>

                                                                </h3>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <!-- modal-header -->
                                                            <div class="modal-body">
                                                                <div class="card-body">
                                                                    
                                                                    <?php if($o_counts <= 10) { ?>
                                                                    <form class="floating-labels m-t-40" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/editorder/<?= $obj['id'] ?>" enctype="multipart/form-data">

                                                                        <?php if ($role_id != '2') { ?>
                                                                            <?php if (@$referal == 'No') { ?>
                                                                                <!-- blank -->
                                                                            <?php } ?>
                                                                        <?php } else { ?>
                                                                            <input type="hidden" name="referal" value="<?= @$referal ?>">
                                                                        <?php } ?>

                                                                        <input type="hidden" name="backurl" value="<?= $current_page ?>">
                                                                        <input type="hidden" name="edit_id" value="<?= $obj['id'] ?>">
                                                                        <input type="text" style="display:none;" name="order_id" class="form-control" value="<?= $obj['order_id'] ?>" autofocus readonly="readonly">
                                                                        <input type="text" style="display:none;" name="order_type" value="Back-End">

                                                                        <div class="row">
                                                                       <!--new update email-->
                                                                        <!--<input type="hidden" class="form-control pages" name="u_email" value="<?= $obj['c_email'] ?>" required="required">-->
                                                                        <input type="hidden" class="form-control" name="u_id" value="<?= $obj['uid'] ?>" required="required">
                                                                        <input type="hidden" value="<?php echo (int)$obj['amount'] - (int)$obj['received_amount']; ?>" name="due_amount" >
                                                                        <input type="hidden" class="form-control" name="u_name" value="<?= $obj['c_name'] ?>" required="required">
                                                                        <!--end new update email-->
                                                                        <?php if($role_id != '5') {   ?>
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    <input  type="text" class="form-control" name="u_email" value="<?php echo  $obj['c_email'] ?>" required="required">
                                                                                    <span class="bar"></span>
                                                                                    <label for="input10">Email</label>
                                                                                </div>
                                                                            </div>
                                                                            <?php }  else {  ?> 
                                                                                    <input type="hidden" class="form-control" name="u_email" value="<?php echo  $obj['c_email'] ?>" required="required">
                                                                                    <?php } ?>

                                                                            <?php if($role_id == '4') {   ?>
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    <input type="text" readonly class="form-control" name="u_mobile_no" value="<?php echo $obj['c_mobile'] ?>" required="required">
                                                                                    <span class="bar"></span>
                                                                                    <label for="input10">Mobile No</label>
                                                                                </div>
                                                                            </div>
                                                                            <?php } elseif($role_id != '5') { ?>
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    <input type="text"  class="form-control" name="u_mobile_no" value="<?php echo $obj['c_mobile'] ?>" required="required">
                                                                                    <span class="bar"></span>
                                                                                    <label for="input10">Mobile No</label>
                                                                                </div>
                                                                            </div>
                                                                          
                                                                            <?php } ?>
                                                                            <input type="hidden"  class="form-control" name="u_mobile_no" value="<?php echo $obj['c_mobile'] ?>" required="required">

                                                                        
                                                                        
                                                                         <?php if($role_id != '5') {   ?>
                                                                            <!-- Select Customer -->
                                                                            <?php if ($role_id != '2') {  ?>
                                                                                <?php if ($role_id == '1') {  ?>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group has-warning m-b-40">
                                                                                            <?php echo form_dropdown('user_id', $users, $obj['uid'], '', 'required="required"') ?>
                                                                                            <span class="bar"></span>
                                                                                            <label for="input10">Select customer</label>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php } else { ?>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group has-warning m-b-40">
                                                                                            <input type="text" value="<?php if (isset($obj['c_name']) && !empty($obj['c_name'])) {
                                                                                                                            echo $obj['c_name'];
                                                                                                                        } ?>" class="form-control" id="input10" readonly>
                                                                                            <span class="bar"></span>
                                                                                            <label for="input10">Select customer</label>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            <?php } else { ?>
                                                                                <input type="text" style="display:none;" name="user_id" value="<?= @$obj['uid'] ?>">
                                                                            <?php } } ?>
                                                                            <!-- Select Customer -->

                                                                                
                                                                            <!-- Project Title -->
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    <input type="text" class="form-control" name="title" value="<?= $obj['title'] ?>" required="required">
                                                                                    <span class="bar"></span>
                                                                                    <label for="input10">Project title</label>
                                                                                </div>
                                                                            </div>
                                                                            <!-- / Project Title -->

                                                                            <!-- Select pages -->
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    <input type="text" class="form-control pages" name="pages" value="<?= $obj['pages'] ?>" required="required">
                                                                                    <span class="bar"></span>
                                                                                    <label for="input10">Select pages</label>
                                                                                </div>
                                                                            </div>
                                                                            <!-- / Select pages -->

                                                                            <!-- Order total -->
                                                                            <div class="col-lg-4" hidden>
                                                                                <div class="form-group has-warning">
                                                                                    <input type="text" name="actualorder" class="actualorder form-control" id="input10" value="<?php echo $obj['amount']; ?>">
                                                                                    <span class="bar"></span>
                                                                                    <strike class="actualorder" style="font-size: 22px;color:red;"></strike>
                                                                                </div>
                                                                            </div>
                                                                            <!-- / Order total -->

                                                                            <!-- Price -->
                                                                            <?php if($role_id != '5') { ?>
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group has-warning">
                                                                                    <?php if ($role_id != '2') {  ?>
                                                                                        <input type="text" name="order_total" class="form-control order_total" value="<?php echo $obj['amount']; ?>" required>
                                                                                    <?php } else { ?>
                                                                                        <input type="hidden" name="order_total" class="order_total" value="<?php echo $obj['amount']; ?>">
                                                                                    <?php } ?>
                                                                                    <span class="bar"></span>
                                                                                    <label for="input10">Price </label>
                                                                                </div>
                                                                            </div>
                                                                            <!-- / Price -->
                                                                            <?php } else { ?>
                                                                           <input type="hidden" name="order_total" class="form-control order_total" value="<?php echo $obj['amount']; ?>" required>
                                                                           <?php } ?>

                                                                            <!-- Delivery Date Time -->
                                                                            <div class="col-lg-4" style="display: flex;">
                                                                                <?php if($role_id != 5) {?>
                                                                                <div class="col-6">
                                                                                    <div class="form-group has-warning m-b-40">
                                                                                        <input type="text" class="form-control second delivery_date mdate" name="delivery_date" value="<?php echo  date("Y-m-d", strtotime($obj['delivery_date'])); ?>">
                                                                                        <span class="bar"></span>
                                                                                        <label for="input10">Delivery date</label>
                                                                                    </div>
                                                                                </div>
                                                                                <?php } else{ ?>
                                                                                    <div class="col-6">
                                                                                    <div class="form-group has-warning m-b-40">
                                                                                        <input readonly type="text" class="form-control second delivery_date" name="delivery_date" value="<?php echo  date("Y-m-d", strtotime($obj['delivery_date'])); ?>">
                                                                                        <span class="bar"></span>
                                                                                        <label for="input10">Delivery date</label>
                                                                                    </div>
                                                                                </div>
                                                                                <?php } ?>
                                                                                <div class="col-2">
                                                                                    <!-- blank -->
                                                                                </div>
                                                                                <?php if($role_id != 5){ ?>
                                                                                <div class="col-4">
                                                                                    <div class="form-group has-warning m-b-40">
                                                                                        <input type="text" class="form-control timepicker" name="delivery_time" value="<?php if (isset($obj['delivery_time']) && !empty($obj['delivery_time'])) {
                                                                                                echo $obj['delivery_time'];
                                                                                            } ?>">
                                                                                        <span class="bar"></span>
                                                                                        <label for="input10">Time</label>
                                                                                    </div>
                                                                                </div>
                                                                                <?php } else{ ?>
                                                                                    <div class="col-4">
                                                                                        <div class="form-group has-warning m-b-40">
                                                                                            <input readonly type="text" class="form-control " name="delivery_time" value="<?php if (isset($obj['delivery_time']) && !empty($obj['delivery_time'])) {
                                                                                                    echo $obj['delivery_time'];
                                                                                                } ?>">
                                                                                            <span class="bar"></span>
                                                                                            <label for="input10">Time</label>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php } ?>    
                                                                            </div>
                                                                            <!-- / Delivery Date Time -->
                                                                         <?php if($role_id != '4') { ?>
                                                                            <!-- Writer name -->
                                                                            <div class="col-lg-4" name="numberDrop<?php echo $obj['order_id']; ?>" id="numberDropId<?php echo $obj['order_id']; ?>" onChange="getButtons<?php echo $obj['order_id']; ?>()">
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    <?php if ($role_id != '3') { ?>
                                                                                        <?php if ($obj['projectstatus'] == 'In Progress') { ?>
                                                                                             <select name="writer_name" class="form-control" required>
                                                                                                <option value=" " <?php if (@$obj['writer_name'] == ' ') {
                                                                                                                echo "selected";
                                                                                                            } ?>> </option>
                                                                                                <option value="team 01" <?php if (@$obj['writer_name'] == 'team 01') {
                                                                                                                echo "selected";
                                                                                                            } ?>>team 1</option>
                                                                                                <option value="team 02" <?php if (@$obj['writer_name'] == 'team 02') {
                                                                                                                echo "selected";
                                                                                                            } ?>>team 2</option>
                                                                                                <option value="team 03" <?php if (@$obj['writer_name'] == 'team 03') {
                                                                                                                echo "selected";
                                                                                                            } ?>>team 3</option>
                                                                                                <option value="team 04" <?php if (@$obj['writer_name'] == 'team 04') {
                                                                                                                echo "selected";
                                                                                                            } ?>>team 4</option>
                                                                                                <option value="team 05" <?php if (@$obj['writer_name'] == 'team 05') {
                                                                                                                echo "selected";
                                                                                                            } ?>>team 5</option>
                                                                                                <option value="team 06" <?php if (@$obj['writer_name'] == 'team 06') {
                                                                                                                echo "selected";
                                                                                                            } ?>>team 6</option>
                                                                                                <option value="team 07" <?php if (@$obj['writer_name'] == 'team 07') {
                                                                                                                echo "selected";
                                                                                                            } ?>>team 7</option>
                                                                                                <option value="team 08" <?php if (@$obj['writer_name'] == 'team 08') {
                                                                                                                echo "selected";
                                                                                                            } ?>>team 8</option>
                                                                                                <option value="team 09" <?php if (@$obj['writer_name'] == 'team 09') {
                                                                                                                echo "selected";
                                                                                                            } ?>>team  9</option>
                                                                                                <option value="team 010" <?php if (@$obj['writer_name'] == 'team 010') {
                                                                                                            } ?>>team 10</option>
                                                                                                <option value="team 011" <?php if (@$obj['writer_name'] == 'team 011') {
                                                                                                } ?>>team 11</option>
                                                    
                                                                                                <option value="team 012" <?php if (@$obj['writer_name'] == 'team 012') {
                                                                                                } ?>>team 12</option>
                                                                                                 <option value="team 013" <?php if (@$obj['writer_name'] == 'team 013') {
                                                                                                } ?>>team 13</option>
                                                                                            </select>
                                                                                            <span class="bar"></span>
                                                                                            <label for="input10">Writer name (Select team)</label>
                                                                                        <?php } else { ?>
                                                                                             <select name="writer_name" class="form-control" required>
                                                                                                <option value=" " <?php if (@$obj['writer_name'] == ' ') {
                                                                                                                echo "selected";
                                                                                                            } ?>> </option>
                                                                                                <option value="team 01" <?php if (@$obj['writer_name'] == 'team 01') {
                                                                                                                echo "selected";
                                                                                                            } ?>>team 1</option>
                                                                                                <option value="team 02" <?php if (@$obj['writer_name'] == 'team 02') {
                                                                                                                echo "selected";
                                                                                                            } ?>>team 2</option>
                                                                                                <option value="team 03" <?php if (@$obj['writer_name'] == 'team 03') {
                                                                                                                echo "selected";
                                                                                                            } ?>>team 3</option>
                                                                                                <option value="team 04" <?php if (@$obj['writer_name'] == 'team 04') {
                                                                                                                echo "selected";
                                                                                                            } ?>>team 4</option>
                                                                                                <option value="team 05" <?php if (@$obj['writer_name'] == 'team 05') {
                                                                                                                echo "selected";
                                                                                                            } ?>>team 5</option>
                                                                                                <option value="team 06" <?php if (@$obj['writer_name'] == 'team 06') {
                                                                                                                echo "selected";
                                                                                                            } ?>>team 6</option>
                                                                                                <option value="team 07" <?php if (@$obj['writer_name'] == 'team 07') {
                                                                                                                echo "selected";
                                                                                                            } ?>>team 7</option>
                                                                                                <option value="team 08" <?php if (@$obj['writer_name'] == 'team 08') {
                                                                                                                echo "selected";
                                                                                                            } ?>>team 8</option>
                                                                                                <option value="team 09" <?php if (@$obj['writer_name'] == 'team 09') {
                                                                                                                echo "selected";
                                                                                                            } ?>>team  9</option>
                                                                                                <option value="team 010" <?php if (@$obj['writer_name'] == 'team 010') {
                                                                                                            } ?>>team 10</option>
                                                                                                <option value="team 011" <?php if (@$obj['writer_name'] == 'team 011') {
                                                                                                } ?>>team 11</option>
                                                    
                                                                                                <option value="team 012" <?php if (@$obj['writer_name'] == 'team 012') {
                                                                                                } ?>>team 12</option>
                                                                                                 <option value="team 013" <?php if (@$obj['writer_name'] == 'team 013') {
                                                                                                } ?>>team 13</option>
                                                                                            </select>
                                                                                            <span class="bar"></span>
                                                                                            <label for="input10">Writer name (Select team)</label>
                                                                                        <?php } ?>

                                                                                    <?php } else { ?>
                                                                                        <input type="hidden" name="writer_name" id="input10" class="form-control writer_name" value="<?= @$obj['writer_name'] ?>" />
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                            <!-- / Writer name -->
                                                                             <?php } else { ?>
                                                                            <input type="hidden" name="writer_name" id="input10" class="form-control writer_name" value="<?= @$obj['writer_name'] ?>" />
                                                                            <?php } ?>

                                                                            <!-- Writer price -->
                                                                            <div class="col-lg-4" style="display: none;">
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    <?php if ($role_id != '3') { ?>
                                                                                        <input type="text" name="writer_price" class="form-control writer_price" value="<?= @$obj['writer_price'] ?>" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" />
                                                                                    <?php } else { ?>
                                                                                        <input type="hidden" name="writer_price" class="form-control writer_price" value="<?= @$obj['writer_price'] ?>" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" />
                                                                                    <?php } ?>
                                                                                    <span class="bar"></span>
                                                                                    <label for="input10">Writer price</label>
                                                                                </div>
                                                                            </div>
                                                                            <!-- / Writer price -->

                                                                            <!-- Writer deadline -->
                                                                            <?php if($role_id != 4) {?> 
                                                                            <div class="col-lg-4 writer_deadline" >
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    <?php if (!empty($obj['writer_deadline'])) {
                                                                                        if (@$obj['writer_deadline'] != '1970-01-01') {
                                                                                            $writer_deadlinenew = date("Y-m-d", strtotime(@$obj['writer_deadline']));
                                                                                        } else {
                                                                                            $writer_deadlinenew = date("Y-m-d");
                                                                                        }
                                                                                    } else {
                                                                                        $writer_deadlinenew = date("Y-m-d");
                                                                                    } ?>

                                                                                    <input type="text" class="form-control mdate" name="writer_deadline" value="<?php if (isset($writer_deadlinenew) && !empty($writer_deadlinenew)) {
                                                                                                                                                                    echo $writer_deadlinenew;
                                                                                                                                                                } ?>">
                                                                                    <span class="bar"></span>
                                                                                    <label for="input10">Writer deadline</label>
                                                                                </div>
                                                                            </div>
                                                                            <?php } else { ?>
                                                                                <div class="col-lg-4 writer_deadline" style='display:none' >
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    <?php if (!empty($obj['writer_deadline'])) {
                                                                                        if (@$obj['writer_deadline'] != '1970-01-01') {
                                                                                            $writer_deadlinenew = date("Y-m-d", strtotime(@$obj['writer_deadline']));
                                                                                        } else {
                                                                                            $writer_deadlinenew = date("Y-m-d");
                                                                                        }
                                                                                    } else {
                                                                                        $writer_deadlinenew = date("Y-m-d");
                                                                                    } ?>

                                                                                    <input type="text" class="form-control mdate" name="writer_deadline" value="<?php if (isset($writer_deadlinenew) && !empty($writer_deadlinenew)) {
                                                                                                                                                                    echo $writer_deadlinenew;
                                                                                                                                                                } ?>">
                                                                                    <span class="bar"></span>
                                                                                    <label for="input10">Writer deadline</label>
                                                                                </div>
                                                                            </div>
                                                                            <?php } ?>
                                                                            <!-- / Writer deadline -->

                                                                            <!-- College Name -->
                                                                            
                                                                            <?php if($role_id != '5' && $role_id != '4') { ?>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group has-warning m-b-40">
                                                                                        <input type="text" class="form-control" id="input10" name="college_name" value="<?= @$obj['college_name'] ?>">
                                                                                        <span class="bar"></span>
                                                                                        <label for="input10">College name</label>
                                                                                    </div>
                                                                                </div>
                                                                            <?php } else{?>
                                                                                <input type="hidden" class="form-control" id="input10" name="college_name" value="<?= @$obj['college_name'] ?>">
                                                                            <?php } ?> 
                                                                           
                                                                            
                                                                            <!-- / College Name -->

                                                                            <!-- Order Date -->
                                                                            <?php if($role_id != 5){ ?>
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    <input type="text" class="form-control first mdate" name="order_date" value="<?php echo date('Y-m-d', strtotime($obj['order_date'])); ?>">
                                                                                    <span class="bar"></span>
                                                                                    <label for="input10">Order date</label>
                                                                                </div>
                                                                            </div>
                                                                            <?php } else{ ?>
                                                                                <div class="col-lg-4">
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    <input type="text" class="form-control" name="order_date" value="<?php echo date('Y-m-d', strtotime($obj['order_date'])); ?>" readonly>
                                                                                    <span class="bar"></span>
                                                                                    <label for="input10">Order date</label>
                                                                                </div>
                                                                            </div>
                                                                            <?php } ?>
                                                                            <!-- / Order Date -->

                                                                            <!-- Formatting & Citation Style -->
                                                                            <?php if($role_id != 5 && $role_id != 4) { ?>
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    <select class="form-control " name="formatting">
                                                                                        <option value=""></option>
                                                                                        <?php
                                                                                        foreach ($formattings as $key => $value) {
                                                                                            if ($obj['formatting'] == $value['formatting_name']) {
                                                                                        ?>
                                                                                                <option value="<?= $value['formatting_name'] ?>" selected><?= $value['formatting_name'] ?></option>
                                                                                            <?php } else { ?>
                                                                                                <option value="<?= $value['formatting_name'] ?>"><?= $value['formatting_name'] ?></option>

                                                                                        <?php  }
                                                                                        } ?>
                                                                                    </select>
                                                                                    <span class="bar"></span>
                                                                                    <label for="input10">Formatting style</label>
                                                                                </div>
                                                                            </div>
                                                                            <?php } else{ ?>
                                                                            <div class="col-lg-4 d-none">
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    <select class="form-control " name="formatting">
                                                                                        <option value=""></option>
                                                                                        <?php
                                                                                        foreach ($formattings as $key => $value) {
                                                                                            if ($obj['formatting'] == $value['formatting_name']) {
                                                                                        ?>
                                                                                                <option value="<?= $value['formatting_name'] ?>" selected><?= $value['formatting_name'] ?></option>
                                                                                            <?php } else { ?>
                                                                                                <option value="<?= $value['formatting_name'] ?>"><?= $value['formatting_name'] ?></option>

                                                                                        <?php  }
                                                                                        } ?>
                                                                                    </select>
                                                                                    <span class="bar"></span>
                                                                                    <label for="input10">Formatting style</label>
                                                                                </div>
                                                                            </div>
                                                                            <?php } ?>
                                                                            <!-- / Formatting & Citation Style -->

                                                                            <!-- Choose type of service -->
                                                                            <?php if($role_id != 5 && $role_id != 4) { ?>
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    <select class="form-control typeofservice" name="typeofservice">
                                                                                        <option value=""></option>
                                                                                        <?php
                                                                                        foreach ($services as $key => $value) {
                                                                                            if ($obj['services'] == $value['service_name']) {
                                                                                        ?>
                                                                                                <option value="<?= $value['service_name'] ?>" typservice="<?= $value['factor'] ?>" selected><?= $value['service_name'] ?> </option>
                                                                                            <?php } else { ?>
                                                                                                <option value="<?= $value['service_name'] ?>" typservice="<?= $value['factor'] ?>"><?= $value['service_name'] ?></option>
                                                                                        <?php  }
                                                                                        } ?>
                                                                                    </select>
                                                                                    <span class="bar"></span>
                                                                                    <label for="input10">Choose type of service</label>
                                                                                </div>
                                                                            </div>
                                                                            <?php } else{ ?>
                                                                                <div class="col-lg-4 d-none">
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    <select class="form-control typeofservice" name="typeofservice">
                                                                                        <option value=""></option>
                                                                                        <?php
                                                                                        foreach ($services as $key => $value) {
                                                                                            if ($obj['services'] == $value['service_name']) {
                                                                                        ?>
                                                                                                <option value="<?= $value['service_name'] ?>" typservice="<?= $value['factor'] ?>" selected><?= $value['service_name'] ?> </option>
                                                                                            <?php } else { ?>
                                                                                                <option value="<?= $value['service_name'] ?>" typservice="<?= $value['factor'] ?>"><?= $value['service_name'] ?></option>
                                                                                        <?php  }
                                                                                        } ?>
                                                                                    </select>
                                                                                    <span class="bar"></span>
                                                                                    <label for="input10">Choose type of service</label>
                                                                                </div>
                                                                            </div>
                                                                            <?php } ?>
                                                                            <!-- / Choose type of service -->

                                                                            <!-- Choose type of paper -->
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    <select id='id<?php echo $obj['order_id']; ?>'  class="id form-control typeofpaper" name="typeofpaper">
                                                                                        <option value=""></option>
                                                                                        <?php
                                                                                        foreach ($typeofpapers as $key => $value) {
                                                                                            if ($obj['typeofpaper'] == $value['paper_type']) {
                                                                                        ?>
                                                                                                <option value="<?= $value['paper_type'] ?>" selected typpaper="<?= $value['factor'] ?>"><?= $value['paper_type'] ?></option>
                                                                                            <?php } else { ?>
                                                                                                <option value="<?= $value['paper_type'] ?>" typpaper="<?= $value['factor'] ?>"><?= $value['paper_type'] ?></option>
                                                                                        <?php  }
                                                                                        } ?>
                                                                                    </select>
                                                                                    <span class="bar"></span>
                                                                                    <label for="input10">Choose type of paper</label>
                                                                                </div>
                                                                            </div>
                                                                            <!-- / Choose type of paper -->

                                                                            <?php  if ($obj['typeofpaper'] == 'Dissertation (all chapters)' ||$obj['typeofpaper'] == 'Thesis (all chapters)' || $obj['typeofpaper'] == 'Research Paper') {?>
                                                                            <div class="col-lg-4" id='chap<?php echo $obj['order_id']; ?>' >
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    
                                                                                    <select id='chap<?php echo $obj['order_id']; ?>'  class=" form-control pages" name="chapter" >
                                                                                    <option value=" " <?php if ( $obj['chapter'] == ' ') {
                                                                                                                    echo "selected";
                                                                                                                } ?>> </option>
                                                                                         <option value="Chapter 1:  Introduction" <?php if ($obj['chapter'] == 'Chapter 1:  Introduction') {
                                                                                                                    echo "selected";
                                                                                                                } ?>>Chapter 1:  Introduction</option>
                                                                                         <option value="Chapter 2: Litreature Review" <?php if ($obj['chapter'] == 'Chapter 2: Litreature Review') {
                                                                                                                    echo "selected";
                                                                                                                } ?>>Chapter 2: Litreature Review</option>
                                                                                
                                                                                         <option value="Chapter 3: Methedology" <?php if ($obj['chapter'] == 'Chapter 3: Methedology') {
                                                                                                                    echo "selected";
                                                                                                                } ?>>Chapter 3: Methedology</option>
                                                                                         <option value="Chapter 4: Data Analysis" <?php if ($obj['chapter'] == 'Chapter 4: Data Analysis') {
                                                                                                                    echo "selected";
                                                                                                                } ?>>Chapter 4: Data Analysis</option>
                                                                                        <option value="Chapter 5: Conclusion & Recommendation" <?php if ($obj['chapter']== 'Chapter 5: Conclusion & Recommendation') {
                                                                                                                    echo "selected";
                                                                                                                } ?>>Chapter 5: Conclusion & Recommendation</option>
                                                                                    </select>
                                                                                    <span class="bar"></span>
                                                                                    <label for="input10">Choose Chapter</label>
                                                                                </div>
                                                                            </div>
                                                                            <?php } else{ ?>
                                                                                <div class="col-lg-4" id='chap<?php echo $obj['order_id']; ?>'  style="display:none">
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    
                                                                                    <select id='chap<?php echo $obj['order_id']; ?>'  class=" form-control pages" name="chapter" >
                                                                                    <option value=" " <?php if ($obj['chapter'] == ' ') {
                                                                                                                    echo "selected";
                                                                                                                } ?>> </option>
                                                                                         <option value="Chapter 1  Introduction" <?php if ($obj['chapter'] == 'Chapter 1  Introduction') {
                                                                                                                    echo "selected";
                                                                                                                } ?>>Chapter 1:  Introduction</option>
                                                                                         <option value="Chapter 2: Litreature Review" <?php if ($obj['chapter'] == 'Chapter 2: Litreature Review') {
                                                                                                                    echo "selected";
                                                                                                                } ?>>Chapter 2: Litreature Review</option>
                                                                                
                                                                                         <option value="Chapter 3: Methedology" <?php if ($obj['chapter'] == 'Chapter 3: Methedology') {
                                                                                                                    echo "selected";
                                                                                                                } ?>>Chapter 3: Methedology</option>
                                                                                         <option value="Chapter 4: Data Analysis" <?php if ($obj['chapter'] == 'Chapter 4: Data Analysis') {
                                                                                                                    echo "selected";
                                                                                                                } ?>>Chapter 4: Data Analysis</option>
                                                                                        <option value="Chapter 5: Conclusion & Recommendation" <?php if ($obj['chapter'] == 'Chapter 5: Conclusion & Recommendation') {
                                                                                                                    echo "selected";
                                                                                                                } ?>>Chapter 5: Conclusion & Recommendation</option>
                                                                                    </select>
                                                                                    <span class="bar"></span>
                                                                                    <label for="input10">Choose Chapter</label>
                                                                                </div>
                                                                            </div>

                                                                            <?php } ?>
                                                                            <script>
                                                                             $(document).ready(function(){ //Make script DOM ready
                                                                                $('#id<?php echo $obj['order_id']; ?>').change(function() { //jQuery Change Function
                                                                                    var chapterhide = $(this).val(); //Get value from select element
                                                                                    if(chapterhide=="Dissertation (all chapters)" || chapterhide=="Thesis (all chapters)" || chapterhide=='Research Paper'){ //Compare it and if true
                                                                                        document.getElementById('chap<?php echo $obj['order_id']; ?>').style.display = 'block';
                                                                                        // document.getElementById('nd<?php echo $obj['order_id']; ?>').style.display = 'none';
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        // document.getElementById('nd<?php echo $obj['order_id']; ?>').style.display = 'block';
                                                                                        document.getElementById('chap<?php echo $obj['order_id']; ?>').style.display = 'none';
                                                                                    }
                                                                                });
                                                                            });

                                                                            // var currentTime = new Date(); // Get the current time



                                                                            </script>

                                                                            <!-- Choose type of writing -->
                                                                            <?php if($role_id != 4) { ?>
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    <select class="form-control typeofwritting" name="typeofwritting">
                                                                                        <option value=""></option>
                                                                                        <?php
                                                                                        foreach ($typeofwritings as $key => $value) {
                                                                                            if ($obj['typeofwritting'] == $value['type_of_writing']) {
                                                                                        ?>
                                                                                                <option value="<?= $value['type_of_writing'] ?>" selected typwrtg="<?= $value['factor'] ?>"><?= $value['type_of_writing'] ?></option>
                                                                                            <?php } else { ?>
                                                                                                <option value="<?= $value['type_of_writing'] ?>" typwrtg="<?= $value['factor'] ?>"><?= $value['type_of_writing'] ?></option>
                                                                                        <?php  }
                                                                                        } ?>
                                                                                    </select>
                                                                                    <span class="bar"></span>
                                                                                    <label for="input10">Choose type of writing</label>
                                                                                </div>
                                                                            </div>
                                                                            <?php } else { ?>
                                                                                <div class="col-lg-4 d-none">
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    <select class="form-control typeofwritting" name="typeofwritting">
                                                                                        <option value=""></option>
                                                                                        <?php
                                                                                        foreach ($typeofwritings as $key => $value) {
                                                                                            if ($obj['typeofwritting'] == $value['type_of_writing']) {
                                                                                        ?>
                                                                                                <option value="<?= $value['type_of_writing'] ?>" selected typwrtg="<?= $value['factor'] ?>"><?= $value['type_of_writing'] ?></option>
                                                                                            <?php } else { ?>
                                                                                                <option value="<?= $value['type_of_writing'] ?>" typwrtg="<?= $value['factor'] ?>"><?= $value['type_of_writing'] ?></option>
                                                                                        <?php  }
                                                                                        } ?>
                                                                                    </select>
                                                                                    <span class="bar"></span>
                                                                                    <label for="input10">Choose type of writing</label>
                                                                                </div>
                                                                            </div>
                                                                            <?php } ?>
                                                                            <!-- / Choose type of writing -->
                                                                           
                                                                            <!-- Project status -->
                                                                            <?php $projectstatus = $obj['projectstatus']; ?>
                                                                            <?php if ($role_id != 1) { ?>
                                                                                <?php if ($projectstatus != 'Cancelled') { ?>
                                                                                    <!-- Order status -->
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group has-warning m-b-40">
                                                                                            <select id="new<?php echo $obj['order_id']; ?>" class="change form-control pages" name="projectstatus" required>

                                                                                                <option value="Pending" <?php if ($projectstatus == 'Pending') {
                                                                                                                            echo "selected";
                                                                                                                        } ?>>Pending</option>
                                                                                                                        
                                                                                                <option value="Hold Work" <?php if ($projectstatus == 'Hold Work') {
                                                                                                                            echo "selected";
                                                                                                                        } ?>>Hold Work</option>                        
                                                                                                                        
                                                                                                <option value="In Progress" <?php if ($projectstatus == 'In Progress') {
                                                                                                                                echo "selected";
                                                                                                                            } ?>>In Progress</option>
                                                                                                <option value="Completed" <?php if ($projectstatus == 'Completed') {
                                                                                                                                echo "selected";
                                                                                                                            } ?>>Completed</option>

                                                                                                 <?php if($role_id  != 5) {  ?>                           
                                                                                                <option value="Delivered" <?php if ($projectstatus == 'Delivered') {
                                                                                                                                echo "selected";
                                                                                                                            } ?>>Delivered</option>
                                                                                                    <?php } ?>

                                                                                                <option value="Feedback" <?php if ($projectstatus == 'Feedback') {
                                                                                                                                echo "selected";
                                                                                                                            } ?>>Feedback</option>

                                                                                                 <?php if($role_id  != 5) {  ?>                           
                                                                                                                            
                                                                                                <option value="Feedback Delivered" <?php if ($projectstatus == 'Feedback Delivered') {
                                                                                                                                        echo "selected";
                                                                                                                                    } ?>>Feedback Delivered</option>

                                                                                                <?php } ?>

                                                                                                <option value="Cancelled" <?php if ($projectstatus == 'Cancelled') {
                                                                                                                                echo "selected";
                                                                                                                            } ?>>Cancelled</option>
                                                                                                <option value="Draft Ready" <?php if ($projectstatus == 'Draft Ready') {
                                                                                                                                echo "selected";
                                                                                                                            } ?>>Draft Ready</option>

                                                                                                    <?php if($role_id  != 5) {  ?>                           
                                                                                                <option value="Draft Delivered" <?php if ($projectstatus == 'Draft Delivered') {
                                                                                                                                    echo "selected";
                                                                                                                                } ?>>Draft Delivered</option>
                                                                                                    <?php } ?>                    

                                                                                                <option value="Other" <?php if ($projectstatus == 'Other') {
                                                                                                                            echo "selected";
                                                                                                                        } ?>>Other</option>
                                                                                                <option value="initiated" <?php if ($projectstatus == 'initiated') {
                                                                                                                                echo "selected";
                                                                                                                            } ?>>initiated</option>
                                                                                            </select>
                                                                                            <span class="bar"></span>
                                                                                            <label for="input10">Order status</label>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php } ?>
                                                                                
                                                                            <?php } else { ?>
                                                                                <!-- Order status -->
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group has-warning m-b-40">
                                                                                    <select id="new<?php echo $obj['order_id']; ?>" class="change form-control pages projectstatus<?php echo $obj['order_id']; ?>" name="projectstatus" onClick="getDropDown<?php echo $obj['order_id']; ?>()">
                                                                                        <option value="Pending" <?php if ($projectstatus == 'Pending') {
                                                                                                                        echo "selected";
                                                                                                                    } ?>>Pending</option>
                                                                                                                    
                                                                                            <option value="Hold Work" <?php if ($projectstatus == 'Hold Work') {
                                                                                                                            echo "selected";
                                                                                                                        } ?>>Hold Work</option>                         
                                                                                                                    
                                                                                            <option value="In Progress" <?php if ($projectstatus == 'In Progress') {
                                                                                                                            echo "selected";
                                                                                                                        } ?>>In Progress</option>
                                                                                            <option value="Completed" <?php if ($projectstatus == 'Completed') {
                                                                                                                            echo "selected";
                                                                                                                        } ?>>Completed</option>
                                                                                            <?php if($role_id  != 5) {  ?>                           
                                                                                            <option value="Delivered" <?php if ($projectstatus == 'Delivered') {
                                                                                                                                echo "selected";
                                                                                                                            } ?>>Delivered</option>
                                                                                            <?php } ?>
                                                                                            <option value="Feedback" <?php if ($projectstatus == 'Feedback') {
                                                                                                                            echo "selected";
                                                                                                                        } ?>>Feedback</option>
                                                                                          
                                                                                          <?php if($role_id  != 5) {  ?>                           
                                                                                                                            
                                                                                            <option value="Feedback Delivered" <?php if ($projectstatus == 'Feedback Delivered') {
                                                                                                echo "selected";
                                                                                            } ?>>Feedback Delivered</option>
                                                                                                                
                                                                                        <?php } ?>                            

                                                                                            <option value="Cancelled" <?php if ($projectstatus == 'Cancelled') {
                                                                                                                            echo "selected";
                                                                                                                        } ?>>Cancelled</option>
                                                                                            <option value="Draft Ready" <?php if ($projectstatus == 'Draft Ready') {
                                                                                                                            echo "selected";
                                                                                                                        } ?>>Draft Ready</option>
                                                                                            <?php if($role_id  != 5) {  ?>                           
                                                                                            <option value="Draft Delivered" <?php if ($projectstatus == 'Draft Delivered') {
                                                                                                                                echo "selected";
                                                                                                                            } ?>>Draft Delivered</option>
                                                                                            <?php } ?>       
                                                                                            <option value="Other" <?php if ($projectstatus == 'Other') {
                                                                                                                        echo "selected";
                                                                                                                    } ?>>Other</option>
                                                                                            <option value="initiated" <?php if ($projectstatus == 'initiated') {
                                                                                                                            echo "selected";
                                                                                                                        } ?>>initiated</option>
                                                                                   </select>
                                                                                        
                                                                                        <span class="bar"></span>
                                                                                        <label for="input10">Order status</label>
                                                                                    </div>
                                                                                </div>
                                                                                   
                                                                            <?php } ?>


                                                                            <?php if((int)$obj['amount'] - (int)$obj['received_amount'] != 0  )  { ?>
                                                                            <script>
                                                                                  $(document).ready(function(){ //Make script DOM ready
                                                                                    $('#new<?php echo $obj['order_id']; ?>').change(function() { //jQuery Change Function
                                                                                        var opval = $(this).val(); //Get value from select element
                                                                                        if(opval=="Delivered"){ //Compare it and if true

                                                                                            swal({
                                                                                                title: "Due Amount <?php echo (int)$obj['amount'] - (int)$obj['received_amount'];?>",
                                                                                                text: "When you have received the full amount, you will be able to mail it.",
                                                                                                icon: "warning",
                                                                                                buttons: true,
                                                                                                dangerMode: true,
                                                                                                })
                                                                                               
                                                                                                }
                                                                                                    });
                                                                                                });
                                                                            </script>

                                                                            <script>
                                                                             $(document).ready(function(){ //Make script DOM ready
                                                                                $('#new<?php echo $obj['order_id']; ?>').change(function() { //jQuery Change Function
                                                                                    var opval = $(this).val(); //Get value from select element
                                                                                    if(opval=="Delivered"){ //Compare it and if true
                                                                                        document.getElementById('d<?php echo $obj['order_id']; ?>').style.display = 'block';
                                                                                        document.getElementById('nd<?php echo $obj['order_id']; ?>').style.display = 'none';
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        document.getElementById('nd<?php echo $obj['order_id']; ?>').style.display = 'block';
                                                                                        document.getElementById('d<?php echo $obj['order_id']; ?>').style.display = 'none';
                                                                                    }
                                                                                });
                                                                            });

                                                                            function myFunction<?php echo $obj['order_id']; ?>() {
                                                                                swal({
                                                                                    title: "Due Amount <?php echo (int)$obj['amount'] - (int)$obj['received_amount'];?>",
                                                                                    text: "When you have received the full amount, you will be able to mail it.",
                                                                                    icon: "warning",
                                                                                    buttons: true,
                                                                                    dangerMode: true,
                                                                                    })
                                                                                }


                                                                            </script>
                                                                           

                                                                            <?php } ?>

                                                                            <!-- / Project status -->
                                                                            <!-- Payment status -->
                                                                            <?php $paymentstatus = $obj['paymentstatus']; ?>
                                                                            <?php if($role_id != 5 && $role_id != 4){ ?> 
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    <select class="form-control" name="paymentstatus" required>
                                                                                        <option value="Pending" <?php if ($paymentstatus == 'Pending') {
                                                                                                                    echo "selected";
                                                                                                                } ?>>Pending</option>

                                                                                        <option value="Completed" <?php if ($paymentstatus == 'Completed') {
                                                                                                                        echo "selected";
                                                                                                                    } ?>>Completed</option>
                                                                                    </select>
                                                                                    <span class="bar"></span>
                                                                                    <label for="input10">Payment status</label>
                                                                                </div>
                                                                            </div>
                                                                            <?php } else{?>
                                                                                <div class="col-lg-4 d-none">
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    <select class="form-control" name="paymentstatus" required>
                                                                                        <option value="Pending" <?php if ($paymentstatus == 'Pending') {
                                                                                                                    echo "selected";
                                                                                                                } ?>>Pending</option>

                                                                                        <option value="Completed" <?php if ($paymentstatus == 'Completed') {
                                                                                                                        echo "selected";
                                                                                                                    } ?>>Completed</option>
                                                                                    </select>
                                                                                    <span class="bar"></span>
                                                                                    <label for="input10">Payment status</label>
                                                                                </div>
                                                                            </div>
                                                                            <?php } ?>
                                                                            <!-- / Payment status -->
                                                                            <div class="col-lg-4" id='draft' >
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    <select id='draft<?php echo $obj['order_id']; ?>'  class=" form-control pages" name="draftrequired" >
                                                                                        <option value=" " <?php if ( $obj['draftrequired'] == ' ') {
                                                                                                                    echo "selected";
                                                                                                                } ?>> </option>
                                                                                        <option value="Yes" <?php if ($obj['draftrequired'] == 'Yes') {
                                                                                                                    echo "selected";
                                                                                                                } ?>>Yes</option>
                                                                                        <option value="No" <?php if ($obj['draftrequired'] == 'No') {
                                                                                                                    echo "selected";
                                                                                                                } ?>>No</option>
                                                                                    </select>
                                                                                    <span class="bar"></span>
                                                                                    <label for="input10">Draft required</label>
                                                                                </div>
                                                                            </div>  
                                                                            <!-- Delivery Date Time -->
                                                                            <?php if($obj['draftrequired'] == 'Yes') { ?>
                                                                            <div class="col-lg-4"  id='show<?php echo $obj['order_id']; ?>' style='display:flex' >
                                                                                <div class="col-6" >
                                                                                    <div class="form-group has-warning m-b-40">
                                                                                        <input type="text" class="form-control second  mdate" name="draft_date" value="<?php echo  date("Y-m-d", strtotime($obj['draft_date'])); ?>">
                                                                                        <span class="bar"></span>
                                                                                        <label for="input10">Draft Date</label>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="col-4">
                                                                                    <div class="form-group has-warning m-b-40">
                                                                                        <input type="text" class="form-control timepicker" name="draft_time" value="<?php if (isset($obj['draft_time']) && !empty($obj['draft_time'])) {
                                                                                                          echo $obj['draft_time'];
                                                                                                    } ?>">
                                                                                        <span class="bar"></span>
                                                                                        <label for="input10">Draft Time</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php }  else{?>
                                                                                <div class="col-lg-4"  id='show<?php echo $obj['order_id']; ?>' style='display:flex; display:none' >
                                                                                <div class="col-6" >
                                                                                    <div class="form-group has-warning m-b-40">
                                                                                        <input type="text" class="form-control second  mdate" name="draft_date" value="">
                                                                                        <span class="bar"></span>
                                                                                    `    <label for="input10">Draft Date</label>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="col-4">
                                                                                    <div class="form-group has-warning m-b-40">
                                                                                        <input type="text" class="form-control timepicker" name="draft_time" value="">
                                                                                        <span class="bar"></span>
                                                                                        <label for="input10">Draft Time</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php } ?>

                                                                            <!-- / Delivery Date Time -->
                                                                            <script>
                                                                             $(document).ready(function(){ //Make script DOM ready
                                                                                $('#draft<?php echo $obj['order_id']; ?>').change(function() { //jQuery Change Function
                                                                                    var chapterhide = $(this).val(); //Get value from select element
                                                                                    if(chapterhide=="Yes"){ //Compare it and if true
                                                                                        document.getElementById('show<?php echo $obj['order_id']; ?>').style.display = 'flex';
                                                                                        // document.getElementById('nd<?php echo $obj['order_id']; ?>').style.display = 'none';
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        // document.getElementById('nd<?php echo $obj['order_id']; ?>').style.display = 'block';
                                                                                        document.getElementById('show<?php echo $obj['order_id']; ?>').style.display = 'none';
                                                                                    }
                                                                                });
                                                                            });
                                                                            </script>
                                                                        
                                                                        <!-- Enter message -->
                                                                        <div class="col-lg-12" >
                                                                            <div class="form-group has-warning m-b-40">
                                                                                <textarea type="text" name="message" class="form-control" rows="3" value="" autofocus autocomplete="off" style="resize: none;"><?= $obj['message'] ?></textarea>
                                                                                <span class="bar"></span>
                                                                                <label for="input10">Enter message</label>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Enter message -->
                                                                        
                                                                        <!-- Upload Files -->
                                                                        <div class="col-lg-12" style="display: none;">
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
                                                                                                <!-- js -->
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </fieldset>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                        <input style="display:none" type="button" id="d<?php echo $obj['order_id']; ?>" class="btn btn-primary btn-block" value="Update" onclick="myFunction<?php echo $obj['order_id']; ?>()()" >
                                                                                <button type="submit" id='nd<?php echo $obj['order_id']; ?>' class="btn btn-primary btn-block">Update</button>                                                                        </div>

                                                                    </form>
                                                                                                                                                                                        
                                                                    

                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                            <!-- modal-body -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- / Update Order Model -->

                                            </td>
                                            <!-- / Action Buttons -->

                                            <!-- Download Modal -->
                                            <div class="modal fade" id="download<?php echo $obj['id']; ?>" role="dialog" tabindex="-1" aria-labelledby="classInfo" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"><?php echo $obj['order_id']; ?> Details </h4>
                                                            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
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
                                                            if (!empty($obj['completed_orders'])) {
                                                                $k = 1;
                                                                foreach ($obj['completed_orders'] as  $file_details) { ?>
                                                                    <div class="row">
                                                                        <div class="col-md-2 col-sm-2 ">
                                                                            <label class="control-label"> <?= $k ?></label>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <?php $name = explode('/', $file_details['file_path']);
                                                                            echo $name[5]; ?>
                                                                        </div>
                                                                        <div class="col-md-2 col-sm-2 ">
                                                                            <?= date("d-m-Y H:i:s", strtotime($file_details['updated_on'])) ?>
                                                                        </div>
                                                                        <div class="col-md-2 col-sm-2 ">
                                                                            <label class="control-label"> <a href="<?php echo base_url() . '/uploads/' . $file_details['file_path']; ?>" download="download"> <i class="fa fa-download"></i></a></label>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                            <?php $k++;
                                                                }
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- / Modal -->

                                            <!-- View Modal -->
                                            <div class="modal fade" id="view<?php echo $obj['id']; ?>" role="dialog" tabindex="-1" aria-labelledby="classInfo" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"><?php echo $obj['order_id']; ?> Details </h4>
                                                            <button type="button" class="close btn" data-bs-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <?php if($role_id != '5') { ?> 
                                                                    <fieldset class="scheduler-border">
                                                                        <legend class="scheduler-border"> Customer Details <?= $obj['c_name'] ?></legend>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Customer Name :</label>
                                                                                <span> <?php echo $obj['c_name']; ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Email :</label>
                                                                                <span> <?php echo $obj['c_email']; ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Mobile :</label>
                                                                                <span> <?php echo '+' . $obj['countrycode'] . ' - ' . $obj['c_mobile']; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </fieldset>
                                                                    <?php } ?>
                                                                    <fieldset class="scheduler-border">
                                                                        <legend class="scheduler-border"> Order Details</legend>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Order Type :</label>
                                                                                <span> <?php echo $obj['order_type']; ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Project Title:</label>
                                                                                <span> <?php echo $obj['title']; ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Order Id :</label>
                                                                                <span> <?php echo $obj['order_id']; ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Order Date :</label>
                                                                                <span> <?php echo date('d-M-Y', strtotime($obj['order_date'])); ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Delivery Date :</label>
                                                                                <span> <?php echo date('d-M-Y', strtotime($obj['delivery_date'])); ?></span>
                                                                            </div>
                                                                            <?php if($role_id != 5 && $role_id != 4) { ?>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Type Of Service :</label>
                                                                                <span> <?php echo $obj['services']; ?></span>
                                                                            </div>
                                                                           
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Formatting:</label>
                                                                                <span> <?php echo $obj['formatting']; ?></span>
                                                                            </div>
                                                                            <?php } ?>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Type Of Paper:</label>
                                                                                <span> <?php echo $obj['typeofpaper']; ?></span>
                                                                            </div>
                                                                            <?php if($role_id != 4){ ?>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Type Of Writting:</label>
                                                                                <span> <?php echo $obj['typeofwritting']; ?></span>
                                                                            </div>
                                                                            <?php } ?>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Pages:</label>
                                                                                <span> <?php echo $obj['pages']; ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Deadline:</label>
                                                                                <span> <?php echo $obj['deadline']; ?> Day</span>
                                                                            </div>
                                                                            <?php if($role_id != '5') { ?>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Discount % :</label>
                                                                                <span> <?php echo $obj['discount_per']; ?> %</span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Final Amount:</label>
                                                                                <span> <?php echo $obj['amount']; ?> &#163;</span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Paid Amount:</label>
                                                                                <span> <?php echo $obj['received_amount']; ?> &#163;</span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Due Amount:</label>
                                                                                <span>
                                                                                    <?php
                                                                                    if (!isset($obj['amount']) && empty($obj['amount'])) {
                                                                                        $obj['amount'] = 0;
                                                                                    }
                                                                                    echo (int)$obj['amount'] - (int)$obj['received_amount'];
                                                                                    ?>
                                                                                    &#163;
                                                                                </span>
                                                                            </div>
                                                                           <?php } ?>
                                                                           <?php if($role_id != '5' && $role_id != '4'){ ?>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Payment Status:</label>
                                                                                <span> <?php echo $obj['paymentstatus']; ?></span>
                                                                            </div>
                                                                            <?php } ?>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Project Status:</label>
                                                                                <span> <?php echo $obj['projectstatus']; ?></span>
                                                                            </div>
                                                                          

                                                                            <?php if($obj['typeofpaper'] == 'Dissertation (all chapters)' ||$obj['typeofpaper'] == 'Thesis (all chapters)' || $obj['typeofpaper'] == 'Research Paper') { ?>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Chapter:</label>
                                                                                <span> <?php echo $obj['chapter']; ?></span>
                                                                            </div>
                                                                            <?php } ?>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Message:</label>
                                                                                <span> <?php echo $obj['message']; ?></span>
                                                                            </div>

                                                                        </div>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                            <fieldset class="scheduler-border">
                                                                <legend class="scheduler-border"> Documents Details</legend>
                                                                <?php
                                                                if (!empty($obj['order_file_details'])) {
                                                                    $j = 1;
                                                                    foreach ($obj['order_file_details'] as  $file_details) {  ?>
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label><?= $j ?></label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <label class="control-label">Uploaded File :</label>
                                                                                 <div style="height: 10%;width: 100%;">
                                                                                    <a href="<?php echo $file_details['file']; ?>" target="_blank">
                                                                                        <?php
                                                                                        $name = explode('/', $file_details['file']);

                                                                                        if ($obj['order_type'] == "Website") {
                                                                                            echo $name[4];
                                                                                        } else {
                                                                                            echo $name[5];
                                                                                        }
                                                                                        ?>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                <?php $j++;
                                                                    }
                                                                } ?>
                                                            </fieldset>
                                                            <?php if ($obj['projectstatus'] == 'Completed'||$obj['projectstatus'] == 'Delivered') { ?>
                                                                 <fieldset class="scheduler-border">
                                                                    <legend class="scheduler-border">Completed Assignment File</legend>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-4 col-sm-4">
                                                                                <label> Uploaded File from Assignmentinneed.com </label>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <?php 
                                                                    if (!empty($obj['completed_orders'])) {
                                                                    $j = 1;
                                                                    foreach ($obj['completed_orders'] as  $file_details) {  ?>
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label><?= $j ?></label>
                                                                            </div>
                                                                            
                                                                            <div class="col-md-8">
                                                                                <label class="control-label"> File :</label>
                                                                                 <div style="height: 10%;width: 100%;">
                                                                                    <a href="<?php echo $file_details['file_path']; ?>" target="_blank">
                                                                                        <?php
                                                                                        $name = explode('/', $file_details['file_path']);

                                                                                        if ($obj['order_type'] == "Website") {
                                                                                            echo $name[4];
                                                                                        } else {
                                                                                            echo $name[5];
                                                                                        }
                                                                                        ?>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                <?php $j++;
                                                                    }
                                                                } ?>

                                                                </fieldset>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- / Modal -->

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="delete<?php echo $obj['id']; ?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/deleteorder/<?php echo $obj['id']; ?>">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"> Delete Order </h4>
                                                                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure, you want to delete Order <b><?php echo $obj['order_id']; ?> </b>? </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary ">Submit</button>
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- / Modal -->

                                            <!-- Approve Modal -->
                                            <div class="modal fade" id="approve<?php echo $obj['id']; ?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/ActionOrder" enctype="multipart/form-data">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color: #168c56;color: azure;">
                                                                <h4 class="modal-title"> Complete Order </h4>
                                                                <button type="button" class="close" data-bs-dismiss="modal" style="color: azure;">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure, you want to <b style="color:#168c56;"> Complete </b>this Order <b><?php echo $obj['order_id']; ?> </b>? </p>
                                                                <input type="hidden" name="user_id" value="<?php echo $obj['uid']; ?>">
                                                                <input type="hidden" name="order_id" value="<?php echo $obj['id']; ?>">
                                                                <input type="hidden" name="status" value="Completed">
                                                                <input type="hidden" name="approved_date" value="<?= date('Y-m-d') ?>">
                                                                <div class="form-group">
                                                                    <div class="row col-md-12">
                                                                        <label class="control-label"> Comment </label>
                                                                        <textarea class="form-control Comment" rows="2" placeholder="Enter comment here" name="completed_comment"></textarea>
                                                                    </div>
                                                                    <div class="row col-md-12">
                                                                        <label class="control-label"> Upload Assignment </label>
                                                                        <input type="file" name="assignment_file[]" multiple="multiple" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success modal_approve_button" style="background-color: #168c56;">Submit</button>
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- / Modal -->
                                        </tr>

                                    <?php $i++;
                                    } ?>
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

<?php } ?>

    
 


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
            var uid = $(this).closest("tr").find('.uid').val();
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
                            uid: uid,
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

        // $(document).on('click', '.mark_as_failed_user', function() {
            
        //     swal({
        //         title: "Are you sure User Failed?",
        //         text: "Mark this order as failed job!",
        //         icon: "warning",
        //         buttons: [
        //             'No, cancel it!',
        //             'Yes, I am sure!'
        //         ],
        //         dangerMode: true,
        //     }).then(function(isConfirm) {
        //         if (isConfirm) {
        //             $.ajax({
        //                 type: "POST",
        //                 url: '<?php echo base_url(); ?>index.php/Orders/userOrderFail',
        //                 data: {
                            
        //                 },
        //                 success: function(response) {
        //                     window.location.reload();
        //                 }
        //             });
        //         } else {
        //             // window.location.reload();
        //         }
        //     });
        // });
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
<script>
    //      $(document).ready(function(){ //Make script DOM ready
    //      $('.change').change(function() { //jQuery Change Function
    //          var opval = $(this).val(); //Get value from select element
    //          if(opval==""){ //Compare it and if true
    //              swal({
    //  title: "Are you sure?",
    //  text: "plz check payment is done or not!",
    //  icon: "warning",
    //  buttons: true,
    //  dangerMode: true,
    //  })
    //  .then((willDelete) => {
    //  if (willDelete) {
    //      swal("click  on update and derivered the email with attachment!", {
    //      icon: "success",
    //      });
    //  } else {
    //      swal("change order status and update!");
    //  }
    //  });
    //          }
    //      });
    //  });

     
</script>
                                    
                                                
    <!-- <script>

        $(document).ready(function(){ //Make script DOM ready
                                             

         var currentDate = new Date();
         var day = currentDate.getDate();
         var month = currentDate.toLocaleString('default', { month: 'short' });
         var year = currentDate.getFullYear().toString();
         day = day < 10 ? '0' + day : day;
         var dateString = day + '-' + month + '-' + year ;


         var currentTime = new Date();
         var hours = currentTime.getHours();
         var minutes = currentTime.getMinutes();
                                                    
         // Determine AM or PM
         var amPM = hours >= 12 ? 'PM' : 'AM';
                                                    
        // Convert to 12-hour format
        hours = hours % 12;
        hours = hours ? hours : 12;
                                                    
        // Add leading zero if hours, minutes, or seconds is less than 10
        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
                                                    
        var timeString = hours + ':' + minutes + ' ' + amPM;
                                                    

         var opval = $(this).val();
         var inputValue = $('#get<?php echo $obj['order_id']; ?>').val();
         var time = $('#time<?php echo $obj['order_id']; ?>').val();
         var order = $('#order<?php echo $obj['order_id']; ?>').val();
         //Get value from select element
         // if(inputValue == dateString && timeString == time) {
         $.ajax({
         url: "<?php echo site_url('Orders/get_data'); ?>",
         type: "GET",
         // dataType: "json",
         success: function(response) {
             // Handle the successful response here
             $html(response);
             //  location.reload();
             // console.log(response);      
        // Show a SweetAlert success notification
        // alert("Data ID: " + response.id);
                                                        
        },
        error: function(xhr, status, error) {
            // Handle any errors here
            console.log(xhr.responseText);

                // Show a SweetAlert error notification
                alert("Error retrieving data");
            }
        });
    // }

            
                swal({
                    title: 'Deliveri Time',
                    text:  order,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    
                        });
        </script> -->


        <script>
           $(document).ready(function(){
               $('.purpose').on('change', function() {
                   var chapterhide = $(this).val();
               if ( chapterhide =='writer');
                   {
                   // $("#business").show();
                   // $("#hideqw").hide();
                   document.getElementById("hideqw").style.display = "none";;
                   document.getElementById("business").style.display = "block";;
               }

               if(chapterhide =='title' || chapterhide =='college' )
               {
                   document.getElementById("hideqw").style.display = "block";;
                   document.getElementById("business").style.display = "none";;
               }
           });

          
           });

           
           </script>


                                               