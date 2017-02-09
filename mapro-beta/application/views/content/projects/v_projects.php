<?php
$session_roles = $this->session->userdata('mapro_login')['id_roles'];
?>
<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-th-large pull-right hidden-xs"></i>
		<h4 class="panel-title">Projects</h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<?php
				echo (!empty($this->session->flashdata('message')) ? $this->session->flashdata('message') : '');
				?>
				<form method="post" action="<?php echo base_url('projects');?>" id="form">
					<?php
					# ACCESS PERMISSION
					$array_permissions = access_roles();

					if(in_array('1', $array_permissions)){
					?>
					<a class="btn btn-sm btn-primary pull-left" style="margin:0px 10px 0px 0px;" href="<?php echo base_url('projects/add');?>">
		      			<i class="glyphicon glyphicon-plus"></i> Tambah
		      		</a>
		      		<?php } ?>	

		      		<select name="sort" class="form-control input-sm pull-left" style="width:160px; margin:0px 10px 0px 0px;" onChange="DataProses()">
		      			<option value="">- Sort By -</option>
		      			<option value="projects_asc" <?php echo ($sort == 'projects_asc' ? 'selected' : '');?>>Projects [A..Z]</option>
		      			<option value="projects_desc" <?php echo ($sort == 'projects_desc' ? 'selected' : '');?>>Projects [Z..A]</option>
		      			<option value="description_asc" <?php echo ($sort == 'description_asc' ? 'selected' : '');?>>Description [A..Z]</option>
		      			<option value="description_desc" <?php echo ($sort == 'description_desc' ? 'selected' : '');?>>Description [Z..A]</option>
		      			<option value="start_projects_asc" <?php echo ($sort == 'start_projects_asc' ? 'selected' : '');?>>Start Project [A..Z]</option>
		      			<option value="start_projects_desc" <?php echo ($sort == 'start_projects_desc' ? 'selected' : '');?>>Start Project [Z..A]</option>
		      			<option value="end_projects_asc" <?php echo ($sort == 'end_projects_asc' ? 'selected' : '');?>>End Project [A..Z]</option>
		      			<option value="end_projects_desc" <?php echo ($sort == 'end_projects_desc' ? 'selected' : '');?>>End Project [Z..A]</option>
		      		</select>
		      		<div class="input-group pull-left" style="width:295px; margin:0px 10px 0px 0px;">
		      			<?php
		      			if(!empty($this->session->userdata('key_projects'))){
		      				$keyword = $this->session->userdata('key_projects');
		      			} else {
		      				$keyword = '';
		      			}
		      			?>
					    <input type="text" class="form-control input-sm" placeholder="Enter Keyword" name="keyword" value="<?php echo $keyword;?>">
				      	<span class="input-group-btn">	

				      		<?php
				      		if(!empty($this->session->userdata('key_projects'))){
				      		?>
				      		
				      			<button class="btn btn-default btn-sm" type="button" onClick="window.location.href='<?php echo base_url('projects');?>'" title="Delete Filter Search"><i class="glyphicon glyphicon-remove"></i></button>				      											        
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
					if(!empty($this->session->userdata('key_projects'))){
						echo '<br><div class="text-info">TOTAL DATA <strong>"'.$total.'"</strong> FOR KEYWORD <strong>"'.$this->session->userdata('key_projects').'"</strong></div><br>';
					}
					?>

					<table class="table table-bordered table-stripped table-hover" style="width:1100px;">
						<thead>
							<tr style="background:#e6e6e6;">
								<th style="width:50px;text-align:center;">No</th>
								<th style="width:180px;text-align:center;">Projects</th>
								<th style="width:300px;text-align:center;">Description</th>
								<th style="width:150px;text-align:center;">Start Projects</th>
								<th style="width:150px;text-align:center;">End Projects</th>
								<th style="width:120px;text-align:center;">Budget</th>
								<th style="width:120px;text-align:center;">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($projects)){
									$no = 1;
									foreach($projects as $data){
										$string = word_limiter($data['description'], 10);
										echo '<tr>
												<td align="center">'.$no.'</td>
												<td>'.$data['projects'].'</td>
												<td>'.$string.'</td>
												<td align="center">'.sys_date_format($data['start_projects']).'</td>
												<td align="center">'.sys_date_format($data['end_projects']).'</td>
												<td align="right">Rp '.number_format($data['budget'], 0, ', ', '.').'</td>
												<td align="center">
													<a href="'.base_url('projects/detail/'.$data['id_projects']).'" class="text-success" title="Detail"><i class="glyphicon glyphicon-zoom-in"></i></a>';
													
													# ACCESS PERMISSION
													$array_permissions = access_roles();

													if(in_array('2', $array_permissions)){

														echo '&nbsp;&nbsp;&nbsp;&nbsp;
														<a href="'.base_url('projects/edit/'.$data['id_projects']).'" class="text-warning"><i class="glyphicon glyphicon-edit"></i></a>';
													
													}

													if(in_array('3', $array_permissions)){

														echo '&nbsp;&nbsp;&nbsp;&nbsp;
														<a href="'.base_url('projects/delete/'.$data['id_projects']).'" class="text-danger" onClick="return confirm(\'ARE YOU WANT  TO DELETE THIS DATA ?\');"><i class="glyphicon glyphicon-trash"></i></a>';
													
													}

											echo '</td>
											</tr>';
										$no++;
									}
								} else {
									echo '<tr>
											<td align="center" colspan="7">No results data</td>
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