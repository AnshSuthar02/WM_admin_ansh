<?php
$role_id = $this->session->userdata['logged_in']['role_id'];
?>
<!-- <style>
    .alert-dismissible {
        padding-right: 3rem;
        animation: hideMe 10s forwards !important;
    }

    @keyframes hideMe {
        0% {
            opacity: 1;
        }

        100% {
            opacity: 0;
        }
    }
</style> -->
<!-- ============================================================== -->
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
                <h4 class="text-themecolor">Dashboard</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white">
                                <i class="fa fa-plus-circle"></i> Create New
                            </button> -->
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Info box -->
        <!-- ============================================================== -->
        <!-- Row -->
        <?php if ($role_id == 1) { ?>
            <div class="row " style="justify-content: center; ">
                <!-- Column -->
                <div class="col-md-3 col-md-3 " >
                    <a href="<?= base_url('index.php/Employees/index'); ?>">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success">
                                        <i class="ti-user"></i>
                                    </div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">
                                            <?= $total_customers ?>
                                        </h3>
                                        <h5 class="text-muted m-b-0">Total Customers</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-md-3 col-md-3">
                    <a href="<?= base_url('index.php/Orders/index'); ?>">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info">
                                        <i class="ti-book"></i>
                                    </div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"><?= $TotalOrders ?></h3>
                                        <h5 class="text-muted m-b-0">Total Orders</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-md-3 col-md-3">
                    <a href="https://www.assignnmentinneed.com/admin/index.php/Orders/online_orders?customer_id=0&order_id=0&from_date=&upto_date=&order_date_filter=order_date&status=Pending&filter_check=title&title=">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-danger">
                                        <i class="icon-clock"></i>
                                    </div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"><?= $pending_orders ?></h3>
                                        <h5 class="text-muted m-b-0">Pending Orders</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-md-3 col-md-3">
                    <a href="<?= base_url('index.php/Orders/index') ;?>?customer_id=0&order_id=0&from_date=<?php echo date("d-m-Y"); ?>&upto_date=<?php echo date("d-m-Y"); ?>&order_date_filter=order_date&status=&title=">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success">
                                        <i class="ti-shopping-cart"></i>
                                    </div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"><?= $TotalOrdersToday ?></h3>
                                        <h5 class="text-muted m-b-0">Today's Order</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
            </div>
        <?php } ?>
        <!-- Row -->
        <!-- ============================================================== -->
        <!-- End Info box -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Over Visitor, Our income , slaes different and  sales prediction -->
        <!-- ============================================================== -->
        <?php if ($role_id == 1) { ?>
            <div class="row">
                <!-- Column -->
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title ">Orders</h5>
                            <div id="morris-donut-chart" class="ecomm-donute" style="height: 317px;">
                            </div>
                            <ul class="list-inline m-t-30 text-center">
                                <li class="p-r-20">
                                    <h5 class="text-muted">
                                        <i class="fa fa-circle" style="color: #01c0c8;"></i>
                                        Total Orders
                                    </h5>
                                    <h4 class="m-b-0">
                                        <span id="tocm">
                                            <?= $TotalOrdersCurrentMonth ?>
                                        </span>
                                    </h4>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Last 6 Month Orders</h5>
                            <ul class="list-inline text-center">
                                <li>
                                    <h5>
                                        <i class="fa fa-circle m-r-5" style="color: #b4becb;"></i>
                                        Pending
                                    </h5>
                                </li>
                                <li>
                                    <h5>
                                        <i class="fa fa-circle m-r-5" style="color: #00bfc7;"></i>
                                        Total
                                    </h5>
                                </li>
                            </ul>
                            <div id="morris-bar-chart" style="height: 370px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!-- ============================================================== -->
        <!-- New Customers List and New Products List -->
        <!-- ============================================================== -->
        <!-- /row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <h5 class="card-title m-b-0">New Customers List</h5>
                        <p class="text-muted">list of last top 10 orders</p> -->
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order Code</th>
                                        <th>Title</th>
                                        <th>Order Date</th>
                                        <th>Project Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($orders_10)) {
                                        $i = 1;
                                        foreach ($orders_10 as $order) {
                                    ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $order['order_id'] ?></td>
                                                <td><?= $order['title'] ?></td>
                                                <td><?= $order['order_date'] ?></td>
                                                <td>
                                                    <?php
                                                    if ($order['projectstatus'] == 'Pending') {
                                                        $color = "#ff8acc";
                                                    } elseif ($order['projectstatus'] == 'Cancelled') {
                                                        $color = "#ff5b5b";
                                                    } elseif ($order['projectstatus'] == 'Completed' || $order['projectstatus'] == 'Delivered') {
                                                        $color = "#10c469";
                                                    } elseif ($order['projectstatus'] == 'In Progress') {
                                                        $color = "#5b69bc";
                                                    } elseif ($order['projectstatus'] == 'Feedback' || $order['projectstatus'] == 'Feedback Delivered') {
                                                        $color = "#71b6f9";
                                                    } elseif ($order['projectstatus'] == 'Draft Ready' || $order['projectstatus'] == 'Draft Delivered') {
                                                        $color = "#0062cc";
                                                    } else {
                                                        $color = "#35b8e0";
                                                    }
                                                    ?>
                                                    <span class="label label-primary" style="background-color:<?= $color ?>;">
                                                        <?= $order['projectstatus'] ?>
                                                    </span>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title m-b-0">New Product List</h5>
                        <p class="text-muted">this is the sample data here for crm</p>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Products</th>
                                        <th>Popularity</th>
                                        <th>Sales</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Milk Powder</td>
                                        <td><span class="peity-line" data-width="120" data-peity='{ "fill": ["#13dafe"], "stroke":["#13dafe"]}' data-height="40">0,-3,-2,-4,-5,-4,-3,-2,-5,-1</span> </td>
                                        <td><span class="text-danger text-semibold"><i class="fa fa-level-down" aria-hidden="true"></i> 28.76%</span> </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Air Conditioner</td>
                                        <td><span class="peity-line" data-width="120" data-peity='{ "fill": ["#13dafe"], "stroke":["#13dafe"]}' data-height="40">0,-1,-1,-2,-3,-1,-2,-3,-1,-2</span> </td>
                                        <td><span class="text-warning text-semibold"><i class="fa fa-level-down" aria-hidden="true"></i> 8.55%</span> </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>RC Cars</td>
                                        <td><span class="peity-line" data-width="120" data-peity='{ "fill": ["#13dafe"], "stroke":["#13dafe"]}' data-height="40">0,3,6,1,2,4,6,3,2,1</span> </td>
                                        <td><span class="text-success text-semibold"><i class="fa fa-level-up" aria-hidden="true"></i> 58.56%</span> </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Down Coat</td>
                                        <td><span class="peity-line" data-width="120" data-peity='{ "fill": ["#13dafe"], "stroke":["#13dafe"]}' data-height="40">0,3,6,4,5,4,7,3,4,2</span> </td>
                                        <td><span class="text-info text-semibold"><i class="fa fa-level-up" aria-hidden="true"></i> 35.76%</span> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        <!-- /.row -->
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <div class="right-sidebar">
            <div class="slimscrollright">
                <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                <div class="r-panel-body">
                    <ul id="themecolors" class="m-t-20">
                        <li><b>With Light sidebar</b></li>
                        <li><a href="javascript:void(0)" data-skin="skin-default" class="default-theme">1</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-green" class="green-theme">2</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-red" class="red-theme">3</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-blue" class="blue-theme">4</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-purple" class="purple-theme">5</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-megna" class="megna-theme">6</a></li>
                        <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                        <li><a href="javascript:void(0)" data-skin="skin-default-dark" class="default-dark-theme working">7</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-green-dark" class="green-dark-theme">8</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-red-dark" class="red-dark-theme">9</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-blue-dark" class="blue-dark-theme">10</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-purple-dark" class="purple-dark-theme">11</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-megna-dark" class="megna-dark-theme ">12</a></li>
                    </ul>
                    <ul class="m-t-20 chatonline">
                        <li><b>Chat option</b></li>
                        <li>
                            <a href="javascript:void(0)"><img src="<?php echo base_url(); ?>assets/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="<?php echo base_url(); ?>assets/images/users/2.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="<?php echo base_url(); ?>assets/images/users/3.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="<?php echo base_url(); ?>assets/images/users/4.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="<?php echo base_url(); ?>assets/images/users/5.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="<?php echo base_url(); ?>assets/images/users/6.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="<?php echo base_url(); ?>assets/images/users/7.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="<?php echo base_url(); ?>assets/images/users/8.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->

<script>    
    var tocmc = <?= $TotalOrdersCurrentMonthCancelled ?>;
    var tocmp = <?= $TotalOrdersCurrentMonthPending ?>;
    var tocmo = <?= $TotalOrdersCurrentMonthOther ?>;
    var tocm  = <?= $TotalOrdersCurrentMonth ?>;
    var one   = <?= $one ?>;
    var two   = <?= $two ?>;
    var three = <?= $three ?>;
    var four  = <?= $four ?>;
    var five  = <?= $five ?>;
    var six   = <?= $six ?>;
</script>

<script src="<?php echo base_url(); ?>assets/dist/js/dashboard1.js"></script>
