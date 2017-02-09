
<div>
	<button class="btn btn-primary btn-xs pull-left" type="button" style="margin:0px 10px 0px 0px;" onClick="add_milestones(<?php echo $detail['id_projects'];?>)">
		<i class="glyphicon glyphicon-plus"></i> Add Milestones
	</button>
	<label class="pull-left" style="margin:10px 0px;margin-left:480px;width:60px;font-weight:700;">STATUS</label>
	<select name="status_milestones" id="status_milestones" class="form-control input-sm" style="margin:0px 10px 0px 0px;width:100px;" onChange="load_milestones()">
		<option value="0">Running</option>
		<option value="1">Finished</option>
	</select>
	<br>
</div>

<div class="clearfix"></div>
<div id="data-milestones">
	<table class="table table-bordered table-stripped table-hover" style="width:780px;">
		<thead>
			<tr style="background:#e6e6e6;">
				<th style="width:50px;text-align:center;">No</th>
				<th style="text-align:center;">Milestones Name</th>
				<th style="width:150px;text-align:center;">Start</th>
				<th style="width:150px;text-align:center;">End</th>
				<th style="width:100px;text-align:center;">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($milestones)){
				$no = 1;
				foreach($milestones as $data){
					echo '<tr>
						<td align="center">'.$no.'</td>
						<td>'.$data['milestones'].'</td>
						<td align="center">'.sys_date_format($data['start_milestones']).'</td>
						<td align="center">'.sys_date_format($data['end_milestones']).'</td>
						<td align="center">';

						if($data['status_milestones'] == 0){
							echo '<a href="javascript:void(0)" onClick="close_milestones('.$data['id_milestones'].')" class="text-success" title="Close"><i class="glyphicon glyphicon-check"></i></a>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="javascript:void(0)" onClick="edit_milestones('.$data['id_milestones'].')" class="text-warning" title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
								&nbsp;&nbsp;&nbsp;&nbsp;';
						}
						echo '<a href="javascript:void(0)" class="text-danger" onClick="delete_milestones('.$data['id_milestones'].')" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
						</td>
					</tr>';
					$no++;
				}
			} else {
				echo '<tr>
						<td align="center" colspan="5">No results data</td>
					</tr>';
			}
			?>
		</tbody>
	</table>
</div>
<!-- Bootstrap modal -->
<div class="modal fade" id="milestones-modal" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<small class="modal-title milestones-title"></small>
			</div>
			<div class="modal-body milestones-body"></div>
			<div class="modal-footer">							
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-off"></i> Close</button>
				<button type="button" class="btn btn-primary btn-sm btn-save" onclick="simpan_milestones()"><i class="glyphicon glyphicon-floppy-disk"></i> Save</button>
			</div>
		</div>
	</div>
</div>
<script>
	
	var milestones_simpan;

	function add_milestones(id){
		milestones_simpan = 'tambah';
		var loading = $('.loading-overlay').show();
		$.ajax({
			url : "<?php echo base_url('milestones/form_add');?>",
			type: "POST",
			data: {id:id},
			success: function(data){
				$('.milestones-body').html(data);
				$('#milestones-modal').modal('show');
				$('.milestones-title').html('ADD MILESTONES');
				loading.hide();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				console.log("GAGAL MEMUAT FORM!");
			}
		});
	}

	function edit_milestones(id){
		milestones_simpan = 'ubah';
		var loading = $('.loading-overlay').show();
		$.ajax({
			url : "<?php echo base_url('milestones/form_edit');?>",
			type: "POST",
			data: {id:id},
			success: function(data){
				$('.milestones-body').html(data);
				$('#milestones-modal').modal('show');
				$('.milestones-title').html('EDIT MILESTONES');
				loading.hide();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				console.log("GAGAL MEMUAT FORM!");
			}
		});
	}


	function load_milestones(){
		var id = '<?php echo $detail['id_projects']?>';
		var status = $('#status_milestones').val();
		$.ajax({
			url : "<?php echo base_url('milestones/load_milestones');?>",
			type: "POST",
			data: {id:id, status:status},
			success: function(data){
				$('#data-milestones').html(data);
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				console.log("GAGAL MEMUAT DATA!");
			}
		});
	}

	function delete_milestones(id){
		if(confirm('ARE YOU WANT TO DELETE THIS DATA ?')){
			$.ajax({
				url : "<?php echo base_url('milestones/delete');?>",
				type: "POST",
				data: {id:id},
				success: function(data){
					load_milestones();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					console.log("GAGAL MEMUAT DATA!");
				}
			});
		}
	}

	function close_milestones(id){
		if(confirm('ARE YOU WANT TO CLOSE THIS DATA ?')){
			$.ajax({
				url : "<?php echo base_url('milestones/close');?>",
				type: "POST",
				data: {id:id},
				success: function(data){
					load_milestones();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					console.log("GAGAL MEMUAT DATA!");
				}
			});
		}
	}

	function simpan_milestones(){
		$('.btn-save').html('Saving...');
		$('.btn-save').attr('disabled',true);

		var url;
		var form;

		if(milestones_simpan == 'tambah') {
			form = $('#form_tambah').serialize();
		} else if(milestones_simpan == 'ubah') {
			form = $('#form_ubah').serialize();
		}

		$.ajax({
			url : "<?php echo base_url('milestones/save');?>",
			type: "POST",
			data: form,
			dataType: "JSON",
			success: function(data) {
				if(data.status) {
					alert('DATA SUCCESSFULLY SAVED!');
					$('#milestones-modal').modal('hide');
					load_milestones();					
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$("#error_"+data.inputerror[i]).html(data.error_string[i]);
					}								
				}
				$('.btn-save').html('<i class="glyphicon glyphicon-floppy-disk"></i> Save');
				$('.btn-save').attr('disabled',false);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log("GAGAL MENYIMPAN DATA!");
			}
		});

	}
</script>