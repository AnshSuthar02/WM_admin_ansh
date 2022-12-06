<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php
if (isset($this->session->userdata['logged_in'])) {
	$username 		= ($this->session->userdata['logged_in']['username']);
	$email 			= ($this->session->userdata['logged_in']['email']);
	$role_id 		= $this->session->userdata['logged_in']['role_id'];
	$employee_id 	= $this->session->userdata['logged_in']['id'];
} else {
	header("location: login");
}

$curr_url 		= current_url();
$result 		= $this->user_rights_url->getUrlList($role_id, $employee_id);
$last 			= [];
$current_page 	= current_url();
$data 			= explode('index.php', $current_page);

$auth_page_old = $data[1];
$edit_data 	   = explode('/', $data[1]);

if (!empty($edit_data[3])) {
	$auth_page = '/' . $edit_data[1] . '/' . $edit_data[2];
} else {
	$auth_page = $auth_page_old;
}
if (in_array($auth_page, $result)) {
?>
	<!DOCTYPE html>
	<html>
	<?php $this->load->view('template/css'); ?>

	<body class="hold-transition sidebar-mini">
		<div class="wrapper">
			<!-- include your header view here -->
			<?php $this->load->view('template/header'); ?>
			<?php $this->load->view('template/menu'); ?>

			<div class="content-wrapper">
				<section class="content">
					<?= $contents ?>
				</section>
			</div>
			<?php $this->load->view('template/footer'); ?>

		</div>
	</body>
	<?php $this->load->view('template/js'); ?>

	</html>

<?php } else {
	redirect('User_authentication/dashboard');
} ?>