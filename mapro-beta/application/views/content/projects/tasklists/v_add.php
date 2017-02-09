<form id="form_tambah" class="form-horizontal">
	<input type="hidden" name="form_tambah" value="form_tambah">
	<input type="hidden" name="id_projects" value="<?php echo $id_projects;?>">
	<input type="hidden" name="id_milestones" value="<?php echo $id_milestones;?>">
	<div class="form-group">
		<label class="col-md-3">Tasks <span class="text-danger" style="font-weight:700;">*</span></label>
		<div class="col-md-9">
			<input type="text" name="tasks" class="form-control input-sm" placeholder="Tasks" autofocus>
			<span class="text-danger" id="error_tasks" style="font-size:10px;"></span>
		</div>
	</div>
    <div class="form-group">
        <label class="col-md-3">Budget <span class="text-danger">*</span></label>
        <div class="col-md-9">
            <input type="text" name="budget" class="form-control input-sm angka" placeholder="Budget">
            <span class="text-danger" id="error_budget_tasks" style="font-size:10px;"></span>
        </div>
    </div>
	<div class="form-group">
		<label class="col-md-3">Description</label>
		<div class="col-md-9">
			<textarea name="description_tasks" class="form-control input-sm" rows="3" placeholder="Enter Description.."></textarea>
			<span class="text-danger" id="error_description_tasks" style="font-size:10px;"></span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-3">Due <span class="text-danger" style="font-weight:700;">*</span></label>
		<div class="col-md-9">
			<input type="text" name="due_tasks" class="form-control input-sm date-picker" value="<?php echo gmdate("d/m/Y", time()+60*60*7);?>">
			<span class="text-danger" id="error_due_tasks" style="font-size:10px;"></span>
		</div>
	</div>
	<div class="form-group">
    	<label class="col-md-3">Users <span class="text-danger">*</span></label>
    	<div class="col-md-9">
    		<?php
    		foreach($users as $row){
    			echo '<label for="id_users_'.$row['id_users'].'" class="radio">
    					<input type="checkbox" name="id_users[]" id="id_users_'.$row['id_users'].'" value="'.$row['id_users'].'"> '.$row['username'].'
    				</label>';
    		}
    		?>
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

    $(".angka").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
            // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
</script>