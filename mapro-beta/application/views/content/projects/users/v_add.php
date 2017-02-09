<form id="form_tambah" class="form-horizontal">
	<input type="hidden" name="form_tambah" value="form_tambah">
	<input type="hidden" name="id_projects" value="<?php echo $id_projects;?>">
	<div class="form-group">
		<label class="col-md-3">Users <span class="text-danger" style="font-weight:700;">*</span></label>
		<div class="col-md-9">
			<select name="id_users" id="id_users" class="form-control input-sm">
				<option value="">- Choose Users -</option>
				<?php
				foreach($users as $row){
					echo '<option value="'.$row['id_users'].'">'.$row['username'].'</option>';
				}
				?>
			</select>
			<span class="text-danger" id="error_id_users" style="font-size:10px;"></span>
		</div>
	</div>
</form>