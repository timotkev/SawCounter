<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-th-large pull-right hidden-xs"></i>
		<h4 class="panel-title">Change Password</h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<?php
				echo (!empty($this->session->flashdata('message')) ? $this->session->flashdata('message') : '');
				?>
				<form method="post" action="<?php echo base_url('account/change_password');?>" id="form" class="form-horizontal">
					<div class="form-group">
				    	<label class="col-md-2">Current Password <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<input type="password" name="password_old" class="form-control input-sm" placeholder="Enter Current Password" value="">
				    		<?php echo form_error('password_old', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
					<div class="form-group">
				    	<label class="col-md-2">New Password <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<input type="password" name="password" class="form-control input-sm" placeholder="Enter New Password" value="">
				    		<?php echo form_error('password', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<label class="col-md-2">New Password Confirmation <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<input type="password" name="password_confirmation" class="form-control input-sm" placeholder="Enter Password Confirmation" value="">
				    		<?php echo form_error('password_confirmation', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<div class="col-md-3">
				    		<a class="btn btn-sm btn-default" href="<?php echo base_url('account');?>">
				      			<i class="glyphicon glyphicon-remove"></i> Cancel
				      		</a>
				      		<button type="submit" class="btn btn-sm btn-primary btn-update" data-loading-text="Updating..." onClick="$('.btn-update').button('loading');">
				      			<i class="glyphicon glyphicon glyphicon-ok"></i> Update
				      		</button>
				    	</div>
				    </div>
				</form>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>