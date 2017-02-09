<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo (isset($title) ? $title . ' - ' . sys_name() : sys_name());?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />

		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/custom.min.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/dropzone.min.css');?>">

        <script src="<?php echo base_url('assets/js/jquery-1.10.2.min.js');?>"></script>
        <script src="<?php echo base_url('assets/js/lazyload.min.js');?>"></script>
        <!-- see https://github.com/plotly/plotly.js/tree/master/dist#plotlyjs-basic for details -->
        <script src="<?php echo base_url('assets/js/plotly-basic-1.21.2.min.js');?>"></script>
        <script src="<?php echo base_url('assets/js/dropzone.min.js');?>"></script>
	</head>
	<body>		
		<?php 
		echo $this->load->view('partials/v_header');		
		?>
		
		<div class="content-data">
			<?php echo $this->load->view($content);?>
		</div>

		<div class="modal fade" id="logout-modal" role="dialog" data-backdrop="static">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<small class="modal-title logout-title">I N F O R M A T I O N</small>
					</div>
					<div class="modal-body logout-body">
						<div class="alert alert-info text-center" style="font-weight:bolder;font-size:14px;text-shadow:1px 0px #000;">ARE YOU SURE TO LOGOUT SYSTEMS ?</div>
					</div>
					<div class="modal-footer">							
						<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-arrow-left"></i> Cancel</button>
						<button type="button" class="btn btn-primary btn-sm" onclick="window.location.href='<?php echo base_url('authentication/do_logout');?>'"><i class="glyphicon glyphicon-off"></i> Logout</button>
					</div>
				</div>
			</div>
		</div>

    <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
    <script>
    	function do_logout(){
    		$('#logout-modal').modal('show');
    	}
    </script>
	</body>
</html>