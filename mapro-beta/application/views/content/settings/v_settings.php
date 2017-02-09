<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-th-large pull-right hidden-xs"></i>
		<h4 class="panel-title">System Configuration</h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form method="post" action="<?php echo base_url('settings');?>" class="form-horizontal">
					<?php echo (!empty($this->session->flashdata('message')) ? $this->session->flashdata('message') : ''); echo validation_errors('<div class="text-danger text-center">', '</div>');?>
					<button type="submit" class="btn btn-sm btn-primary btn-save pull-right" data-loading-text="Saving Configuration..." onClick="$('.btn-save').button('loading');">
		      			<i class="glyphicon glyphicon-floppy-disk"></i> Save Configuration
		      		</button>
					<ul class="nav nav-tabs">
						<li class="active"><a href="<?php echo base_url('settings');?>#tab1" data-toggle="tab"><i class="glyphicon glyphicon-th"></i> General</a></li>
						<li class=""><a href="<?php echo base_url('settings');?>#tab2" data-toggle="tab"><i class="glyphicon glyphicon-screenshot"></i> Application</a></li>
					</ul>
					<div id="myTabContent" class="tab-content"><br>
						<div class="tab-pane fade active in" id="tab1">
							<div class="form-group">
								<label class="col-md-2">System Name</label>
								<div class="col-md-4">
									<input type="text" name="sys_name" class="form-control input-sm" value="<?php echo $sys_name;?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2">System Description</label>
								<div class="col-md-4">
									<textarea rows="5" name="sys_desc" class="form-control input-sm"><?php echo $sys_desc;?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2">System Keyword</label>
								<div class="col-md-4">
									<textarea rows="5" name="sys_keyword" class="form-control input-sm"><?php echo $sys_keyword;?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2">System Email</label>
								<div class="col-md-4">
									<input type="email" name="sys_email" class="form-control input-sm" value="<?php echo $sys_email;?>">
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="tab2">
							<div class="form-group">
								<label class="col-md-2">Pagination Per Page</label>
								<div class="col-md-4">
									<input type="text" name="sys_pagination" class="form-control input-sm" value="<?php echo $sys_pagination;?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2">System Format Date</label>
								<div class="col-md-4">
									<select name="sys_date" class="form-control input-sm" style="width:250px;">
										<option value="">- Choose Format Date -</option>
										<?php
										$array_format = array(
											'dd/mm/YYYY' => '20/01/2016', 
											'YYYY/mm/dd' => '2016/01/20',
											'dd-mm-YYYY' => '20-01-2016', 
											'YYYY-mm-dd' => '2016-01-20',
											'l, d m YYYY' => 'Friday, 20 January 2016',
											'd m YYYY' => 'January 20 2016'
										);
										foreach($array_format as $key => $value){
											if($key == $sys_date){
												echo '<option value="'.$key.'" selected="selected">'.$value.'</option>';
											} else {
												echo '<option value="'.$key.'">'.$value.'</option>';
											}
										}
										?>
									</select>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	function DataProses() {
		$("form#form").submit();
	}
</script>