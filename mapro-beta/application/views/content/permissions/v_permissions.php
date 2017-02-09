<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-th-large pull-right hidden-xs"></i>
		<h4 class="panel-title">Permissions</h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<div class="loading-overlay" style="display:none;"></div>
				<?php
				echo (!empty($this->session->flashdata('message')) ? $this->session->flashdata('message') : '');
				?>
				<form method="post" action="<?php echo base_url('permissions');?>" id="form">
					<a class="btn btn-sm btn-primary pull-left" style="margin:0px 10px 0px 0px;" href="<?php echo base_url('permissions/add');?>">
		      			<i class="glyphicon glyphicon-plus"></i> Tambah
		      		</a>	
		      		<select name="sort" class="form-control input-sm pull-left" style="width:160px; margin:0px 10px 0px 0px;" onChange="DataProses()">
		      			<option value="">- Sort By -</option>
		      			<option value="permissions_asc" <?php echo ($sort == 'permissions_asc' ? 'selected' : '');?>>Permissions [A..Z]</option>
		      			<option value="permissions_desc" <?php echo ($sort == 'permissions_desc' ? 'selected' : '');?>>Permissions[Z..A]</option>
		      			<option value="id_permissions_asc" <?php echo ($sort == 'id_permissions_asc' ? 'selected' : '');?>>New Permissions [A..Z]</option>
		      			<option value="id_permissions_desc" <?php echo ($sort == 'id_permissions_desc' ? 'selected' : '');?>>Old Permissions [Z..A]</option>
		      		</select>
		      		<div class="input-group pull-left" style="width:295px; margin:0px 10px 0px 0px;">
		      			<?php
		      			if(!empty($this->session->userdata('key_permissions'))){
		      				$keyword = $this->session->userdata('key_permissions');
		      			} else {
		      				$keyword = '';
		      			}
		      			?>
					    <input type="text" class="form-control input-sm" placeholder="Enter Keyword" name="keyword" value="<?php echo $keyword;?>">
				      	<span class="input-group-btn">	

				      		<?php
				      		if(!empty($this->session->userdata('key_permissions'))){
				      		?>
				      		
				      			<button class="btn btn-default btn-sm" type="button" onClick="window.location.href='<?php echo base_url('permissions');?>'" title="Delete Filter Search"><i class="glyphicon glyphicon-remove"></i></button>				      											        
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
					if(!empty($this->session->userdata('key_permissions'))){
						echo '<br><div class="text-info">TOTAL DATA <strong>"'.$total.'"</strong> FOR KEYWORD <strong>"'.$this->session->userdata('key_permissions').'"</strong></div><br>';
					}
					?>

					<table class="table table-bordered table-stripped table-hover" style="width:360px;">
						<thead>
							<tr style="background:#e6e6e6;">
								<th style="width:60px;text-align:center;">Code</th>
								<th style="text-align:center;">Permissions</th>								
								<th style="width:80px;text-align:center;">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($permissions)){
									$no = 1;
									foreach($permissions as $data){
										echo '<tr>
												<td class="active" align="center">'.$data['id_permissions'].'</td>
												<td>'.$data['permissions'].'</td>
												<td align="center">
													<a href="'.base_url('permissions/edit/'.$data['id_permissions']).'" class="text-warning" title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
													&nbsp;&nbsp;&nbsp;&nbsp;
													<a href="'.base_url('permissions/delete/'.$data['id_permissions']).'" class="text-danger" onClick="return confirm(\'ARE YOU WANT  TO DELETE THIS DATA ?\');" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
												</td>
											</tr>';
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

				<!-- Bootstrap modal -->
				<div class="modal fade" id="modal_detail" role="dialog" data-backdrop="static">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<small class="modal-title"></small>
							</div>
							<div class="modal-body form"></div>
							<div class="modal-footer">							
								<button type="button" class="btn btn-success btn-sm" data-dismiss="modal">
									<i class="glyphicon glyphicon-off"></i> Close
								</button>
							</div>
						</div>
					</div>
				</div>
				<!-- End Bootstrap modal -->

			</div>
		</div>
	</div>
</div>
<script>
	function DataProses() {
		$("form#form").submit();
	}
</script>