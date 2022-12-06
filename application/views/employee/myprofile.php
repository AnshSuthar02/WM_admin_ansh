<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<style type="text/css">
	.select2 {
		height: 45px !important;
		width: 100% !important;
	}

	.btnEdit {
		width: 25%;
		border-radius: 5px;
		margin: 1px;
		padding: 1px;
	}
</style>


<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Container fluid  -->
	<!-- ============================================================== -->
	<div class="container-fluid">
		<div class="card card-primary card-outline">
			<div class="card-header">
				<h3 class="card-title"><?= $title ?></h3>
				<div class="button-group float-right">
				</div>
			</div>
			<!-- /.card-body -->
			<div class="card-body">
				<div class="row">
					<div class="col-md-2">
						<span>
							<?php if (isset($result['photo']) && !empty($result['photo'])) { ?>
								<img src="<?php echo base_url() . "uploads/" . $result['photo']; ?>" class="img-circle " alt="User Image" style="width: 100%;height: 100%;">
							<?php } ?>
						</span>
					</div>
					<div class="col-md-10 table-responsive">
						<table class="table">
							<tr>
								<th> Full Name </th>
								<td> <?= $result['name'] ?></td>
								<th> User Code </th>
								<td> <?= $result['employee_code'] ?></td>

							</tr>
							<tr>
								<th> Designation </th>
								<td> <?= $result['role'] ?></td>
								<th> Country </th>
								<td> <?= $result['cnty_name'] ?></td>
							</tr>
							<tr>
								<th> Email </th>
								<td> <?= $result['email'] ?></td>
								<th> Mobile </th>
								<td> <?= $result['mobile_no'] ?></td>
							</tr>
							<tr>
								<th> Username </th>
								<td> <?= $result['username'] ?></td>
								<th> Address </th>
								<td> <?= $result['address'] ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>