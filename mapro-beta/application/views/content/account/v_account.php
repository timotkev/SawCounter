<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-th-large pull-right hidden-xs"></i>
		<h4 class="panel-title">User Profile</h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<?php
				echo (!empty($this->session->flashdata('message')) ? $this->session->flashdata('message') : '');
				?>
				<table class="table table-hover" style="width:600px;">
					<caption align="bottom" class="text-center">
						<a href="<?php echo base_url('account/edit_profile');?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit Profile</a>
						<a href="<?php echo base_url('account/change_password');?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-lock"></i> Change Password</a>
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
							</td>
							<td style="width:100px;"><strong>Fullname</strong></td>
							<td style="width:2px;">:</td>
							<td><?php echo $data['fullname'];?></td>
						</tr>
						<tr>
							<td style="width:100px;"><strong>Username</strong></td>
							<td style="width:2px;">:</td>
							<td><?php echo $data['username'];?></td>
						</tr>
						<tr>
							<td style="width:100px;"><strong>Email</strong></td>
							<td style="width:2px;">:</td>
							<td><?php echo $data['email'];?></td>
						</tr>
						<tr>
							<td style="width:100px;"><strong>Registered</strong></td>
							<td style="width:2px;">:</td>
							<td><?php echo fullTimeDateEN($data['registered']);?></td>
						</tr>
						<tr>
							<td style="width:100px;"><strong>Last Login</strong></td>
							<td style="width:2px;">:</td>
							<td><?php echo fullTimeDateEN($data['last_login']);?></td>
						</tr>
					</tbody>
				</table>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>