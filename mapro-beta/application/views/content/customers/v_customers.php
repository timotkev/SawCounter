<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-th-large pull-right hidden-xs"></i>
		<h4 class="panel-title">Customer Administration</h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<div class="loading-overlay" style="display:none;"></div>
				<?php
				echo (!empty($this->session->flashdata('message')) ? $this->session->flashdata('message') : '');
				?>
				<form method="post" action="<?php echo base_url('customers');?>" id="form">
					<?php
					# ACCESS PERMISSION
					$array_permissions = access_roles();

					if(in_array('41', $array_permissions)){
					
					?>
					<a class="btn btn-sm btn-primary pull-left" style="margin:0px 10px 0px 0px;" href="<?php echo base_url('customers/add');?>">
		      			<i class="glyphicon glyphicon-plus"></i> Tambah
		      		</a>	
		      		<?php } ?>

		      		<select name="sort" class="form-control input-sm pull-left" style="width:160px; margin:0px 10px 0px 0px;" onChange="DataProses()">
		      			<option value="">- Sort By -</option>
		      			<option value="customers_asc" <?php echo ($sort == 'customers_asc' ? 'selected' : '');?>>Customer Name [A..Z]</option>
		      			<option value="customers_desc" <?php echo ($sort == 'customers_desc' ? 'selected' : '');?>>Customer Name [Z..A]</option>
		      			<option value="registered_asc" <?php echo ($sort == 'description_asc' ? 'selected' : '');?>>Registered [A..Z]</option>
		      			<option value="registered_desc" <?php echo ($sort == 'description_desc' ? 'selected' : '');?>>Registered [Z..A]</option>
		      		</select>
		      		<div class="input-group pull-left" style="width:295px; margin:0px 10px 0px 0px;">
		      			<?php
		      			if(!empty($this->session->userdata('key_customers'))){
		      				$keyword = $this->session->userdata('key_customers');
		      			} else {
		      				$keyword = '';
		      			}
		      			?>
					    <input type="text" class="form-control input-sm" placeholder="Enter Keyword" name="keyword" value="<?php echo $keyword;?>">
				      	<span class="input-group-btn">	

				      		<?php
				      		if(!empty($this->session->userdata('key_customers'))){
				      		?>
				      		
				      			<button class="btn btn-default btn-sm" type="button" onClick="window.location.href='<?php echo base_url('customers');?>'" title="Delete Filter Search"><i class="glyphicon glyphicon-remove"></i></button>				      											        
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
					if(!empty($this->session->userdata('key_customers'))){
						echo '<br><div class="text-info">TOTAL DATA <strong>"'.$total.'"</strong> FOR KEYWORD <strong>"'.$this->session->userdata('key_customers').'"</strong></div><br>';
					}
					?>

					<table class="table table-bordered table-stripped table-hover" style="width:960px;">
						<thead>
							<tr style="background:#e6e6e6;">
								<th style="width:50px;text-align:center;">No</th>
								<th style="width:180px;text-align:center;">Customer Name</th>
								<th style="text-align:center;">Address</th>
								<th style="width:150px;text-align:center;">Contact Person</th>
								<th style="width:150px;text-align:center;">Registered</th>
								<th style="width:120px;text-align:center;">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(!empty($customers)){
									$no = 1;
									foreach($customers as $data){
										echo '<tr>
												<td align="center">'.$no.'</td>
												<td>'.$data['customers_name'].'</td>
												<td>'.$data['address'].'</td>
												<td>'.$data['contact_person'].'</td>
												<td align="center">'.sys_date_format($data['registered']).'</td>
												<td align="center">
													<a href="javascript:void(0)" onClick="DataDetail('.$data['id_customers'].')" class="text-success" title="Detail"><i class="glyphicon glyphicon-zoom-in"></i></a>
													&nbsp;&nbsp;&nbsp;&nbsp;';

													# ACCESS PERMISSION
													$array_permissions = access_roles();

													if(in_array('42', $array_permissions)){
														echo '<a href="'.base_url('customers/edit/'.$data['id_customers']).'" class="text-warning" title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
														&nbsp;&nbsp;&nbsp;&nbsp;';
													}

													# ACCESS PERMISSION
													$array_permissions = access_roles();

													if(in_array('43', $array_permissions)){
														echo '<a href="'.base_url('customers/delete/'.$data['id_customers']).'" class="text-danger" onClick="return confirm(\'ARE YOU WANT  TO DELETE THIS DATA ?\');" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>';
													}
											echo '</td>
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

	function DataDetail(id){
		var loading = $('.loading-overlay').show();
		$.ajax({
			url : "<?php echo base_url('customers/detail');?>",
			type: "POST",
			data: {id:id},
			success: function(data){
				$('.modal-body').html(data);
				$('#modal_detail').modal('show');
				$('.modal-title').html('DETAIL CUSTOMER');
				loading.hide();				
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				console.log("ERROR, PLEASE CALL ADMINISTRATOR!");
			}
		});
	}
</script>