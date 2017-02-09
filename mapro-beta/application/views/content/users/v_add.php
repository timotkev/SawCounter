<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-th-large pull-right hidden-xs"></i>
		<h4 class="panel-title">Add Users</h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form method="post" action="<?php echo base_url('users/add');?>" id="form" class="form-horizontal">
					<div class="form-group">
				    	<label class="col-md-2">Fullname <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<input type="text" name="fullname" class="form-control input-sm" placeholder="Enter Fullname" value="<?php echo set_value('fullname');?>">
				    		<?php echo form_error('fullname', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<label class="col-md-2">Email <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<input type="email" name="email" class="form-control input-sm" placeholder="Enter Email" value="<?php echo set_value('email');?>">
				    		<?php echo form_error('email', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<label class="col-md-2">Username <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<input type="text" name="username" class="form-control input-sm" placeholder="Enter Username" value="<?php echo set_value('username');?>">
				    		<?php echo form_error('username', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<label class="col-md-2">Password <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<input type="password" name="password" class="form-control input-sm" placeholder="Enter Password">
				    		<?php echo form_error('password', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<label class="col-md-2">Confirm Password <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<input type="password" name="password_confirmation" class="form-control input-sm" placeholder="Enter Confirm Password">
				    		<?php echo form_error('password_confirmation', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<label class="col-md-2">Roles <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<select name="id_roles" class="form-control input-sm" style="width:200px;">
				    			<option value="">- Choose Roles -</option>
				    			<?php
				    			foreach($roles as $data){
				    				if($data['id_roles'] == set_value('id_roles')){
				    					echo '<option value="'.$data['id_roles'].'" selected="selected">'.$data['roles'].'</option>';
				    				} else {
				    					echo '<option value="'.$data['id_roles'].'">'.$data['roles'].'</option>';
				    				}
				    			}
				    			?>
				    		</select>
				    		<?php echo form_error('id_roles', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<div class="col-md-3">
				    		<a class="btn btn-sm btn-default" href="<?php echo base_url('users');?>">
				      			<i class="glyphicon glyphicon-arrow-left"></i> Back
				      		</a>
				      		<button type="submit" class="btn btn-sm btn-primary btn-save" data-loading-text="Saving..." onClick="$('.btn-save').button('loading');">
				      			<i class="glyphicon glyphicon-floppy-disk"></i> Save
				      		</button>
				    	</div>
				    </div>
				</form>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>