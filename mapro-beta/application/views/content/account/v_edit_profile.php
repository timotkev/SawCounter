<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-th-large pull-right hidden-xs"></i>
		<h4 class="panel-title">Edit Profile</h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form method="post" action="<?php echo base_url('account/edit_profile');?>" enctype="multipart/form-data">
					<table class="table" style="width:600px;">
						<caption align="bottom" class="text-center">
							<a href="<?php echo base_url('account');?>" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-remove"></i> Cancel</a>
							<button type="submit" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon glyphicon-ok"></i> Update</button>
						</caption>
						<tbody>
							<tr>
								<td rowspan="5" style="width:150px;background:#e6e6e6;">
									<?php
									if(!empty($data['avatar'])){
										$file_name = './assets/uploads/avatar/' . $data['avatar'];
										if(file_exists($file_name)){
											echo '<img src="'.base_url('assets/uploads/avatar/'.$data['avatar']).'" style="width:150px;">';
										} else {
											echo '<img src="'.base_url('assets/img/default_user.png').'" style="width:150px;">';
										}
									} else {
										echo '<img src="'.base_url('assets/img/default_user.png').'" style="width:150px;">';
									}
									?>
									<input type="file" name="avatar" class="form-control input-sm">
									<input type="hidden" name="avatar_old" value="<?php echo $data['avatar'];?>">
									<?php echo form_error('avatar', '<span class="text-danger">', '</span>'); ?>
								</td>
								<td style="width:100px;"><strong>Fullname</strong></td>
								<td style="width:2px;">:</td>
								<td>
									<input type="text" class="form-control input-sm" value="<?php echo $data['fullname'];?>" name="fullname" autofocus>
									<?php echo form_error('fullname', '<span class="text-danger">', '</span>'); ?>
								</td>
							</tr>
							<tr>
								<td style="width:100px;"><strong>Username</strong></td>
								<td style="width:2px;">:</td>
								<td>
									<input type="text" class="form-control input-sm" value="<?php echo $data['username'];?>" readonly>
								</td>
							</tr>
							<tr>
								<td style="width:100px;"><strong>Email</strong></td>
								<td style="width:2px;">:</td>
								<td>
									<input type="email" class="form-control input-sm" value="<?php echo $data['email'];?>" name="email">
									<?php echo form_error('email', '<span class="text-danger">', '</span>'); ?>
								</td>
							</tr>
							<tr>
								<td style="width:100px;"><strong>Registered</strong></td>
								<td style="width:2px;">:</td>
								<td>
									<input type="text" class="form-control input-sm" value="<?php echo sys_date_format($data['registered']);?>" readonly>
								</td>
							</tr>
							<tr>
								<td style="width:100px;"><strong>Last Login</strong></td>
								<td style="width:2px;">:</td>
								<td>
									<input type="text" class="form-control input-sm" value="<?php echo sys_date_format($data['last_login']);?>" readonly>
								</td>
							</tr>
						</tbody>
					</table>
				</form>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>