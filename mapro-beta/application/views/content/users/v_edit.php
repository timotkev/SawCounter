<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-th-large pull-right hidden-xs"></i>
		<h4 class="panel-title">Edit Users</h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form method="post" action="<?php echo base_url('users/update');?>" id="form" class="form-horizontal">
					<input type="hidden" name="id_users" value="<?php echo $data['id_users'];?>">
					<div class="form-group">
				    	<label class="col-md-2">Fullname <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<input type="text" name="fullname" class="form-control input-sm" placeholder="Enter Fullname" value="<?php echo $data['fullname'];?>">
				    		<?php echo form_error('fullname', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<label class="col-md-2">Email <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<input type="email" name="email" class="form-control input-sm" placeholder="Enter Email" value="<?php echo $data['email'];?>">
				    		<?php echo form_error('email', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<label class="col-md-2">Username <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<input type="text" name="username" class="form-control input-sm" placeholder="Enter Username" value="<?php echo $data['username'];?>">
				    		<?php echo form_error('username', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<label class="col-md-2">Roles <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<select name="id_roles" class="form-control input-sm" style="width:200px;">
				    			<option value="">- Choose Roles -</option>
				    			<?php
				    			foreach($roles as $r){
				    				if($r['id_roles'] == $data['id_roles']){
				    					echo '<option value="'.$r['id_roles'].'" selected="selected">'.$r['roles'].'</option>';
				    				} else {
				    					echo '<option value="'.$r['id_roles'].'">'.$r['roles'].'</option>';
				    				}
				    			}
				    			?>
				    		</select>
				    		<?php echo form_error('id_roles', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<label class="col-md-2">Active <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
							<label for="yes" class="radio-inline">
								<input type="radio" value="0" id="yes" name="active" <?php echo ($data['active'] == 0 ? 'checked' : '');?> > YES
							</label>
							<label for="no" class="radio-inline">
								<input type="radio" value="1" id="no" name="active" <?php echo ($data['active'] == 1 ? 'checked' : '');?> > NO
							</label>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<label class="col-md-3 text-danger">
				    		<input type="checkbox" value="1" name="change_password" id="change_password" onClick="cpass()" <?php echo (!empty(form_error('password') || form_error('password_confirmation')) ? 'checked' : '');?> > CLICK HERE TO CHANGE PASSWORD
				    	</label>
				    </div>
				    <div class="form-group cpass" style=" <?php echo (!empty(form_error('password') || form_error('password_confirmation')) ? 'display:block;' : 'display:none;');?> ">
				    	<label class="col-md-2">Password <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<input type="password" name="password" class="form-control input-sm" placeholder="Enter Password">
				    		<?php echo form_error('password', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group cpass" style="<?php echo (!empty(form_error('password') || form_error('password_confirmation')) ? 'display:block;' : 'display:none;');?> ">
				    	<label class="col-md-2">Confirm Password <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<input type="password" name="password_confirmation" class="form-control input-sm" placeholder="Enter Confirm Password">
				    		<?php echo form_error('password_confirmation', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<div class="col-md-3">
				    		<a class="btn btn-sm btn-default" href="<?php echo base_url('users');?>">
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
<script>
	function cpass(){
		if($("#change_password").is(':checked')){
			$('.cpass').show();
		} else {
			$('.cpass').hide();
		}
	}
</script>