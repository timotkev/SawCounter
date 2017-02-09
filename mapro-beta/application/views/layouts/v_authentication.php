<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo (isset($title) ? $title . ' - ' . sys_name() : sys_name());?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />

		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/custom.min.css');?>">

		<script src="<?php echo base_url('assets/js/jquery-1.10.2.min.js');?>"></script>
		<script src="<?php echo base_url('assets/js/lazyload.min.js');?>"></script>	
	</head>
	<body class="login-bg">
		<div class="col-lg-4 col-lg-push-4 col-md-6 col-md-push-3 col-sm-8 col-sm-push-2 col-xs-12">		
			<div class="login-box-body">
				<p class="login-box-msg"><?php echo sys_name();?> LOGIN</p>
				<?php echo validation_errors();?>
				<form action="<?php echo base_url('authentication/do_login');?>" method="post">
					<div class="form-group has-feedback">
						<input type="text" name="param1" class="form-control" placeholder="Enter Username" required="required" autofocus>
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" name="param2" class="form-control" placeholder="Enter Password" required="required">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<label class="text-primary text-captcha" style="width:65px;font-weight:600;"><?php echo $captcha_math;?></label> <i class="glyphicon glyphicon-refresh" data-toggle="tooltip" data-placement="top" title="Click here to change questions!" style="cursor:pointer;"></i>
						<input type="text" name="math_captcha" class="form-control" placeholder="Enter Security Code" required="required">
						<span class="glyphicon glyphicon-barcode form-control-feedback"></span>
					</div>
					<div class="row">
						<div class="col-xs-8"></div>
						<div class="col-xs-4">
							<button type="submit" class="btn btn-primary btn-block btn-flat btn-login" value="login" name="login">Login</button>
						</div>
					</div>
				</form>
			</div>
			<?php
				if($this->session->flashdata('message')){
					echo $this->session->flashdata('message');
				}
			?>
		
		</div>
	
    <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>	
    <script>
		$('[data-toggle="tooltip"]').tooltip();
		$('.glyphicon-refresh').click(function(){
			$.post( "<?php echo base_url('authentication/load_captcha');?>", function( data ) {
				$( ".text-captcha" ).html(data);
			});
		});
	</script>	
	</body>
</html>