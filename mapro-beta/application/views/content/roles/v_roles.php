<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-th-large pull-right hidden-xs"></i>
		<h4 class="panel-title">Roles</h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<?php
				echo (!empty($this->session->flashdata('message')) ? $this->session->flashdata('message') : '');
				?>
				<form method="post" action="<?php echo base_url('roles');?>" id="form">
					<?php
					# ACCESS PERMISSION
					$array_permissions = access_roles();

					if(in_array('51', $array_permissions)){
					?>
					<a class="btn btn-sm btn-primary pull-left" style="margin:0px 10px 0px 0px;" href="<?php echo base_url('roles/add');?>">
		      			<i class="glyphicon glyphicon-plus"></i> Tambah
		      		</a>	
		      		<?php 
		      		}
		      		?>
		      		<select name="sort" class="form-control input-sm pull-left" style="width:160px; margin:0px 10px 0px 0px;" onChange="DataProses()">
		      			<option value="">- Sort By -</option>
		      			<option value="roles_asc" <?php echo ($sort == 'roles_asc' ? 'selected' : '');?>>Roles [A..Z]</option>
		      			<option value="roles_desc" <?php echo ($sort == 'roles_desc' ? 'selected' : '');?>>Roles [Z..A]</option>
		      			<option value="description_asc" <?php echo ($sort == 'description_asc' ? 'selected' : '');?>>Description [A..Z]</option>
		      			<option value="description_desc" <?php echo ($sort == 'description_desc' ? 'selected' : '');?>>Description [Z..A]</option>
		      		</select>
		      		<div class="input-group pull-left" style="width:295px; margin:0px 10px 0px 0px;">
		      			<?php
		      			if(!empty($this->session->userdata('key_roles'))){
		      				$keyword = $this->session->userdata('key_roles');
		      			} else {
		      				$keyword = '';
		      			}
		      			?>
					    <input type="text" class="form-control input-sm" placeholder="Enter Keyword" name="keyword" value="<?php echo $keyword;?>">
				      	<span class="input-group-btn">	

				      		<?php
				      		if(!empty($this->session->userdata('key_roles'))){
				      		?>
				      		
				      			<button class="btn btn-default btn-sm" type="button" onClick="window.location.href='<?php echo base_url('roles');?>'" title="Delete Filter Search"><i class="glyphicon glyphicon-remove"></i></button>				      											        
				      			<button class="btn btn-primary btn-sm" type="submit" title="Search Now"><i class="glyphicon glyphicon-search"></i></button>
				      		<?php } else { ?>
				      		
				      			<button class="btn btn-primary btn-sm" type="submit" title="Search Now"><i class="glyphicon glyphicon-search"></i></button>

				      		<?php } ?>

				      	</span>
				    </div>
				    <input type="hidden" name="proses" value="proses"><br><br>
				</form>
				<div class="clearfix"></div>
				<div id="result_data">
					
					<?php
					if(!empty($this->session->userdata('key_roles'))){
						echo '<br><div class="text-info">TOTAL DATA <strong>"'.$total.'"</strong> FOR KEYWORD <strong>"'.$this->session->userdata('key_roles').'"</strong></div><br>';
					}
					?>

					<table class="table table-bordered table-stripped table-hover" style="width:640px;">
						<thead>
							<tr style="background:#e6e6e6;">
								<th style="width:50px;text-align:center;">No</th>
								<th style="width:180px;text-align:center;">Roles</th>
								<th style="width:300px;text-align:center;">Description</th>
								
								<?php
								# ACCESS PERMISSION
								$array_permissions = access_roles();

								if(in_array('52', $array_permissions) OR in_array('53', $array_permissions)){
								?>

								<th style="width:80px;text-align:center;">Action</th>

								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($roles)){
									$no = 1;
									foreach($roles as $data){
										echo '<tr>
												<td align="center">'.$no.'</td>
												<td>'.$data['roles'].'</td>
												<td>'.$data['description'].'</td>';

												# ACCESS PERMISSION
												$array_permissions = access_roles();

												if(in_array('52', $array_permissions) OR in_array('53', $array_permissions)){
													echo '<td align="center">';
														
														if(in_array('52', $array_permissions)){
															echo '<a href="'.base_url('roles/edit/'.$data['id_roles']).'" class="text-warning"><i class="glyphicon glyphicon-edit"></i></a>
															&nbsp;&nbsp;&nbsp;&nbsp;';
														}

														if(in_array('53', $array_permissions)){
															echo '<a href="'.base_url('roles/delete/'.$data['id_roles']).'" class="text-danger" onClick="return confirm(\'ARE YOU WANT  TO DELETE THIS DATA ?\');"><i class="glyphicon glyphicon-trash"></i></a>';
														}
														
													echo '</td>';
												}
											'</tr>';
										$no++;
									}
								} else {
									echo '<tr>
											<td align="center" colspan="4">No results data</td>
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