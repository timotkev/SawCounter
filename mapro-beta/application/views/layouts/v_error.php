<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo (isset($title) ? $title . ' - ' . sys_name() : sys_name());?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />

		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/custom.min.css');?>">
	</head>
	<body>		
		<?php echo $this->load->view('partials/v_header');?>
		
		<div class="content-data">
			<div class="error-pages">
				<div class="well">
					<h1><span class="text-primary"><i class="glyphicon glyphicon-flash"></i>404</span> Page Not Found</h1>
					<hr>
					<h3>We could not find the page you were looking for. Meanwhile, you may return to <a href="<?php echo base_url('dashboard');?>">dashboard</a>.</h3>
				</div>
			</div>
		</div>

	<script src="<?php echo base_url('assets/js/jquery-1.10.2.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>		
	</body>
</html>