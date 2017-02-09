<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-th-large pull-right hidden-xs"></i>
		<h4 class="panel-title">User Administration</h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<?php
				echo (!empty($this->session->flashdata('message')) ? $this->session->flashdata('message') : '');
				?>
				<form method="post" action="<?php echo base_url('users');?>" id="form">
					<?php
					# ACCESS PERMISSION
					$array_permissions = access_roles();

					if(in_array('46', $array_permissions)){
					?>
					<a class="btn btn-sm btn-primary pull-left" style="margin:0px 10px 0px 0px;" href="<?php echo base_url('users/add');?>">
		      			<i class="glyphicon glyphicon-plus"></i> Tambah
		      		</a>

		      		<?php } ?>

		      		<select name="id_roles" class="form-control input-sm pull-left" style="width:160px; margin:0px 10px 0px 0px;" onChange="DataProses()">
		      			<option value="">- Choose Roles -</option>
		      			<?php
		      			foreach($roles as $data){
		      				if($id_roles == $data['id_roles']){
		      					echo '<option value="'.$data['id_roles'].'" selected="selected">'.$data['roles'].'</option>';
		      				} else {
		      					echo '<option value="'.$data['id_roles'].'">'.$data['roles'].'</option>';
		      				}
		      			}
		      			?>
		      		</select>	
		      		<select name="sort" class="form-control input-sm pull-left" style="width:160px; margin:0px 10px 0px 0px;" onChange="DataProses()">
		      			<option value="">- Sort By -</option>
		      			<option value="username_asc" <?php echo ($sort == 'username_asc' ? 'selected' : '');?>>Username [A..Z]</option>
		      			<option value="username_desc" <?php echo ($sort == 'username_desc' ? 'selected' : '');?>>Username [Z..A]</option>
		      			<option value="email_asc" <?php echo ($sort == 'email_asc' ? 'selected' : '');?>>Email [A..Z]</option>
		      			<option value="email_desc" <?php echo ($sort == 'email_desc' ? 'selected' : '');?>>Email [Z..A]</option>		      			
		      			<option value="fullname_asc" <?php echo ($sort == 'fullname_asc' ? 'selected' : '');?>>Fullname [A..Z]</option>
		      			<option value="fullname_desc" <?php echo ($sort == 'fullname_desc' ? 'selected' : '');?>>Fullname [Z..A]</option>
		      		</select>
		      		<div class="input-group pull-left" style="width:295px; margin:0px 10px 0px 0px;">
		      			<?php
		      			if(!empty($this->session->userdata('key_users'))){
		      				$keyword = $this->session->userdata('key_users');
		      			} else {
		      				$keyword = '';
		      			}
		      			?>
					    <input type="text" class="form-control input-sm" placeholder="Enter Keyword" name="keyword" value="<?php echo $keyword;?>">
				      	<span class="input-group-btn">	

				      		<?php
				      		if(!empty($this->session->userdata('key_users'))){
				      		?>
				      		
				      			<button class="btn btn-default btn-sm" type="button" onClick="window.location.href='<?php echo base_url('users');?>'"><i class="glyphicon glyphicon-remove"></i></button>				      											        
				      			<button class="btn btn-primary btn-sm" type="submit"><i class="glyphicon glyphicon-search"></i></button>
				      		<?php } else { ?>
				      		
				      			<button class="btn btn-primary btn-sm" type="submit"><i class="glyphicon glyphicon-search"></i></button>

				      		<?php } ?>

				      	</span>
				    </div>
				    <input type="hidden" name="proses" value="proses"><br><br>
				</form>
				<div class="clearfix"></div>
				<div id="result_data">
					<?php
					if(!empty($this->session->userdata('key_users'))){
						echo '<br><div class="text-info">TOTAL DATA <strong>"'.$total.'"</strong> FOR KEYWORD <strong>"'.$this->session->userdata('key_users').'"</strong></div><br>';
					}
					?>
					<table class="table table-bordered table-stripped table-hover" style="width:800px;">
						<thead>
							<tr style="background:#e6e6e6;">
								<th style="width:50px;text-align:center;">No</th>
								<th style="width:200px;text-align:center;">Username</th>
								<th style="width:200px;text-align:center;">Email</th>
								<th style="width:200px;text-align:center;">Fullname</th>
								<th style="text-align:center;">Active</th>
								
								<?php
								# ACCESS PERMISSION
								$array_permissions = access_roles();

								if(in_array('47', $array_permissions) OR in_array('48', $array_permissions)){
								?>
								<th style="width:80px;text-align:center;">Action</th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($users)){
									$no = 1;
									foreach($users as $data){
										echo '<tr>
												<td align="center">'.$no.'</td>
												<td>'.$data['username'].'</td>
												<td>'.$data['email'].'</td>
												<td>'.$data['fullname'].'</td>
												<td align="center">
													'.($data['active'] == 1 ? 'No' : 'Yes').'
												</td>';

												# ACCESS PERMISSION
												$array_permissions = access_roles();

												if(in_array('47', $array_permissions) OR in_array('48', $array_permissions)){

													echo '<td align="center">';

														if(in_array('47', $array_permissions)){
															echo '<a href="'.base_url('users/edit/'.$data['id_users']).'" class="text-warning"><i class="glyphicon glyphicon-edit"></i></a>
															&nbsp;&nbsp;&nbsp;&nbsp;';
														}

														if(in_array('48', $array_permissions)){
															echo '<a href="'.base_url('users/delete/'.$data['id_users']).'" class="text-danger" onClick="return confirm(\'ARE YOU WANT  TO DELETE THIS DATA ?\');"><i class="glyphicon glyphicon-trash"></i></a>';
														}

													echo '</td>';
												}
										echo '</tr>';
										$no++;
									}
								} else {
									echo '<tr>
											<td align="center" colspan="6">No results data</td>
										</tr>';
								}
							?>
						</tbody>
					</table>
					<?php echo $pagination;?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function DataProses() {
		$("form#form").submit();
	}
</script>