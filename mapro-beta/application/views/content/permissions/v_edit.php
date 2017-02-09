<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-th-large pull-right hidden-xs"></i>
		<h4 class="panel-title">Edit Permissions</h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form method="post" action="<?php echo base_url('permissions/update');?>" id="form" class="form-horizontal">
					<input type="hidden" value="<?php echo $data['id_permissions'];?>" name="id_permissions">
					<div class="form-group">
				    	<label class="col-md-2">Customer Name <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<input type="text" name="permissions" class="form-control input-sm" placeholder="Enter Permissions" value="<?php echo $data['permissions'];?>">
				    		<?php echo form_error('permissions', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<label class="col-md-2">Parent <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<select name="parent_permissions" class="form-control input-sm">
				    			<option value="0">- No Parent -</option>
				    			<?php
				    			foreach($parent_permissions as $row){
				    				if($data['parent_permissions'] == $row['id_permissions']){
				    					echo '<option value="'.$row['id_permissions'].'" selected="selected">'.$row['permissions'].'</option>';
				    				} else {
				    					echo '<option value="'.$row['id_permissions'].'">'.$row['permissions'].'</option>';
				    				}
				    			}
				    			?>
				    		</select>
				    		<?php echo form_error('parent_permissions', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<div class="col-md-3">
				    		<a class="btn btn-sm btn-default" href="<?php echo base_url('permissions');?>">
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