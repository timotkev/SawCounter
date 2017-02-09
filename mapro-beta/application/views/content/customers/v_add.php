<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-th-large pull-right hidden-xs"></i>
		<h4 class="panel-title">Add Customer</h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form method="post" action="<?php echo base_url('customers/add');?>" id="form" class="form-horizontal">
					<div class="form-group">
				    	<label class="col-md-2">Customer Name <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<input type="text" name="customers_name" class="form-control input-sm" placeholder="Enter Customer Name" value="<?php echo set_value('customers_name');?>">
				    		<?php echo form_error('customers_name', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<label class="col-md-2">Address <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<textarea type="text" name="address" class="form-control input-sm" placeholder="Enter Customer Address" rows="4" style="resize:none;"><?php echo set_value('address');?></textarea>
				    		<?php echo form_error('address', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<label class="col-md-2">Contact Person <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<input type="text" name="contact_person" class="form-control input-sm" placeholder="Enter Contact Person" value="<?php echo set_value('contact_person');?>">
				    		<?php echo form_error('contact_person', '<span class="text-danger">', '</span>'); ?>
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
				    	<label class="col-md-2">Phone <span class="text-danger">*</span></label>
				    	<div class="col-md-4">
				    		<input type="text" name="phone" class="form-control input-sm" placeholder="Enter Phone Number" value="<?php echo set_value('phone');?>">
				    		<?php echo form_error('phone', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<label class="col-md-2">Website </label>
				    	<div class="col-md-4">
				    		<input type="text" name="website" class="form-control input-sm" placeholder="Enter URL Website" value="<?php echo set_value('website');?>">
				    		<?php echo form_error('website', '<span class="text-danger">', '</span>'); ?>
				    	</div>
				    </div>
				    <div class="form-group">
				    	<div class="col-md-3">
				    		<a class="btn btn-sm btn-default" href="<?php echo base_url('customers');?>">
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