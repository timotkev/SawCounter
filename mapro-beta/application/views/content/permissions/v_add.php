<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-th-large pull-right hidden-xs"></i>
		<h4 class="panel-title">Add Permissions</h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form method="post" action="<?php echo base_url('permissions/add');?>" id="form" class="form-horizontal">
					<div class="form-group">
				    	<label class="col-md-2">Permissions <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<input type="text" name="permissions" class="form-control input-sm" placeholder="Enter Permissions" value="<?php echo set_value('permissions');?>">
				    		<?php echo form_error('permissions', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<label class="col-md-2">Parent <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<select name="parent_permissions" class="form-control input-sm">
				    			<option value="0">- No Parent -</option>
				    			<?php
				    			foreach($parent_permissions as $data){
				    				echo '<option value="'.$data['id_permissions'].'">'.$data['permissions'].'</option>';
				    			}
				    			?>
				    		</select>
				    		<?php echo form_error('parent_permissions', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<div class="col-md-3">
				    		<a class="btn btn-sm btn-default" href="<?php echo base_url('permissions');?>">
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