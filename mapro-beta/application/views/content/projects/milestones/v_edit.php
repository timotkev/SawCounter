<form id="form_ubah" class="form-horizontal">
	<input type="hidden" name="form_ubah" value="form_ubah">
	<input type="hidden" name="id_milestones" value="<?php echo $ubah['id_milestones'];?>">
	<div class="form-group">
		<label class="col-md-3">Milestones</label>
		<div class="col-md-9">
			<input type="text" name="milestones" class="form-control input-sm" placeholder="Milestones.." value="<?php echo $ubah['milestones'];?>">
			<span class="text-danger" id="error_milestones"></span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-3">Description</label>
		<div class="col-md-9">
			<textarea name="decription_milestones" class="form-control input-sm" rows="3" placeholder="Enter Description.."><?php echo $ubah['decription_milestones'];?></textarea>
			<span class="text-danger" id="error_decription_milestones"></span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-3">Start</label>
		<div class="col-md-9">
			<input type="text" name="start_milestones" class="form-control input-sm date-picker" value="<?php echo dateSlash($ubah['start_milestones']);?>">
			<span class="text-danger" id="error_start_milestones"></span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-3">End</label>
		<div class="col-md-9">
			<input type="text" name="end_milestones" class="form-control input-sm date-picker" value="<?php echo dateSlash($ubah['end_milestones']);?>">
			<span class="text-danger" id="error_end_milestones"></span>
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