<form id="form_tambah" class="form-horizontal">
	<input type="hidden" name="form_tambah" value="form_tambah">
	<input type="hidden" name="id_projects" value="<?php echo $id_projects;?>">
	<div class="form-group">
		<label class="col-md-3">Milestones <span class="text-danger" style="font-weight:700;">*</span></label>
		<div class="col-md-9">
			<input type="text" name="milestones" class="form-control input-sm" placeholder="Milestones.." autofocus>
			<span class="text-danger" id="error_milestones" style="font-size:10px;"></span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-3">Description</label>
		<div class="col-md-9">
			<textarea name="decription_milestones" class="form-control input-sm" rows="3" placeholder="Enter Description.."></textarea>
			<span class="text-danger" id="error_decription_milestones" style="font-size:10px;"></span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-3">Start <span class="text-danger" style="font-weight:700;">*</span></label>
		<div class="col-md-9">
			<input type="text" name="start_milestones" class="form-control input-sm date-picker" value="<?php echo gmdate("d/m/Y", time()+60*60*7);?>">
			<span class="text-danger" id="error_start_milestones" style="font-size:10px;"></span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-3">End <span class="text-danger" style="font-weight:700;">*</span></label>
		<div class="col-md-9">
			<input type="text" name="end_milestones" class="form-control input-sm date-picker" value="<?php echo gmdate("d/m/Y", time()+60*60*7);?>">
			<span class="text-danger" id="error_end_milestones" style="font-size:10px;"></span>
		</div>
	</div>
</form>
<script>
	$(function() {
		$('.date-picker').datepicker({
			dateFormat: "dd/mm/yy",
		    //onSelect: validasi,
		    changeMonth: true,
	    	changeYear: true
		})
		.next().on('click', function(){
			$(this).prev().focus();
		});
	});
</script>