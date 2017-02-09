<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-th-large pull-right hidden-xs"></i>
		<h4 class="panel-title">Edit Project</h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form method="post" action="<?php echo base_url('projects/update');?>" id="form" class="form-horizontal">
					<input type="hidden" value="<?php echo $data['id_projects'];?>" name="id_projects">
					<div class="form-group">
				    	<label class="col-md-2">Project <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<input type="text" name="projects" class="form-control input-sm" placeholder="Enter projects Name" value="<?php echo $data['projects'];?>">
				    		<?php echo form_error('projects', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<label class="col-md-2">Description <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<textarea type="text" name="description" class="form-control input-sm" placeholder="Enter Description" rows="4" style="resize:none;"><?php echo $data['description'];?></textarea>
				    		<?php echo form_error('description', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<label class="col-md-2">Start Project <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<input type="text" name="start_projects" class="form-control input-sm tanggal" placeholder="Enter Start Project" value="<?php echo dateSlash($data['start_projects']);?>">
				    		<?php echo form_error('start_projects', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<label class="col-md-2">End Project <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<input type="text" name="end_projects" class="form-control input-sm tanggal" placeholder="Enter End Project"  value="<?php echo dateSlash($data['end_projects']);?>">
				    		<?php echo form_error('end_projects', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<label class="col-md-2">Budget <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<input type="text" name="budget" class="form-control input-sm angka" placeholder="Enter Budget" value="<?php echo $data['budget'];?>">
				    		<?php echo form_error('budget', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<label class="col-md-2">Users <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<?php
				    		foreach($users as $row){
				    			$checked = '';
				    			if(in_array($row['id_users'], $users_projects)){
				    				$checked = ' checked ';
				    			}
				    			echo '<label for="id_users_'.$row['id_users'].'" class="radio">
				    					<input type="checkbox" name="id_users[]" id="id_users_'.$row['id_users'].'" value="'.$row['id_users'].'" '.$checked.'> '.$row['username'].'
				    				</label>';
				    		}
				    		?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<div class="col-md-3">
				    		<a class="btn btn-sm btn-default" href="<?php echo base_url('projects');?>">
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
<style type="text/css">
	.ui-autocomplete .highlight {
		text-decoration: underline;
	}
	.ui-autocomplete-loading { 
		background:url('assets/plugins/jQuery-UI/images/loader.gif') no-repeat right center;
	}
	.ui-front{
		z-index: 999999 !important;
	}
	.ui-datepicker .ui-datepicker-title select {
		color:#333333;
	}
</style>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/jQuery-UI/jquery-ui.min.css');?>">
<script src="<?php echo base_url('assets/plugins/jQuery-UI/jquery-ui.min.js');?>"></script>
<script>
	$(document).ready(function() {
		$('.tanggal').datepicker({
			dateFormat: "dd/mm/yy",
		    //onSelect: validasi,
		    changeMonth: true,
        	changeYear: true
		})
		.next().on('click', function(){
			$(this).prev().focus();
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
	});
</script>