<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-th-large pull-right hidden-xs"></i>
		<h4 class="panel-title">Add Role</h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form method="post" action="<?php echo base_url('roles/add');?>" id="form" class="form-horizontal">
					<div class="col-md-3">
						<div class="form-group">
					    	<label>Role <span class="text-danger">*</span></label>
					    	<div>
					    		<input type="text" name="roles" class="form-control input-sm" placeholder="Enter Roles Name" value="<?php echo set_value('roles');?>">
					    		<?php echo form_error('roles', '<span class="text-danger">', '</span>'); ?>
					    	</div>
					    </div>
					    <div class="form-group">
					    	<label>Description <span class="text-danger">*</span></label>
					    	<div>
					    		<textarea type="text" name="description" class="form-control input-sm" placeholder="Enter Description" rows="4" style="resize:none;"><?php echo set_value('description');?></textarea>
					    		<?php echo form_error('description', '<span class="text-danger">', '</span>'); ?>
					    	</div>
					    </div>
					</div>

					<div class="col-md-9">
						<h5>Permissions</h5>
						<div>
							<?php
								foreach($parent_permissions as $row){
									echo '<div class="col-sm-3 loop-permissions">
											<div class="parent-permissions">
												<label>
													<input type="checkbox" onClick="ChangeParent('.$row['id_permissions'].')" id="p-'.$row['id_permissions'].'">
													'.$row['permissions'].'
												</label>
											</div>
											<div class="permissions">';
											
											$permissions = $this->m_permissions->get_all_permissions_by_parent_permissions($row['id_permissions']);
											
											foreach($permissions as $row2){
												echo '<label>
														<input type="checkbox" name="permissions[]" class="parent-'.$row['id_permissions'].'" value="'.$row2['id_permissions'].'"> '.$row2['permissions'].'
													</label>';
											}

										echo '</div>
										</div>';
								}
							?>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-12">							
					    <div class="form-group">
					    	<a class="btn btn-sm btn-default" href="<?php echo base_url('roles');?>">
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

<style type="text/css">
	.loop-permissions{
		height: 190px;
	}

	@media screen and (max-width:767px){
		.loop-permissions{
			height: 100%;
		}
	}
	.parent-permissions{
		padding:5px;
		border-bottom: 1px #CEDADC solid;
		margin:10px 0px;
	}
	.parent-permissions label{
		text-transform: uppercase;
		font-weight: 600;
	}
	.permissions label{
		display: block;
		margin-left: 10px;
	}
</style>
<script>
	function ChangeParent(id){
		if ($("#p-"+id).is(':checked')) {
			$(".parent-"+id).prop("checked", true);
		} else {
			$(".parent-"+id).prop("checked", false);
		}
	}
</script>