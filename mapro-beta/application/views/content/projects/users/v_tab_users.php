<button class="btn btn-primary btn-xs" type="button" style="margin:5px 0px;" onClick="add_users(<?php echo $detail['id_projects'];?>)">
	<i class="glyphicon glyphicon-plus"></i> Add Users
</button>

<div class="clearfix"></div>

<div id="data-users">
	<table class="table table-bordered table-stripped table-hover" style="width:290px;">
		<thead>
			<tr style="background:#e6e6e6;">
				<th style="width:50px;text-align:center;">No</th>
				<th style="width:150px;text-align:center;">Username</th>
				<th style="width:80px;text-align:center;">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($users_projects)){
				$no = 1;
				foreach($users_projects as $data){
					echo '<tr>
						<td align="center">'.$no.'</td>
						<td>'.$data['username'].'</td>
						<td align="center">
							<a href="javascript:void(0)" class="text-danger" onClick="delete_users('.$data['id_users'].')" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
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
<div class="modal fade" id="users-modal" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<small class="modal-title users-title"></small>
			</div>
			<div class="modal-body users-body"></div>
			<div class="modal-footer">							
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-off"></i> Close</button>
				<button type="button" class="btn btn-primary btn-sm btn-save" onclick="simpan_users()"><i class="glyphicon glyphicon-floppy-disk"></i> Save</button>
			</div>
		</div>
	</div>
</div>
<script>
var users_simpan;

function add_users(id){
	users_simpan = 'tambah';
	var loading = $('.loading-overlay').show();
	$.ajax({
		url : "<?php echo base_url('users/form_add');?>",
		type: "POST",
		data: {id:id},
		success: function(data){
			$('.users-body').html(data);
			$('#users-modal').modal('show');
			$('.users-title').html('ADD USERS');
			loading.hide();
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			console.log("GAGAL MEMUAT FORM!");
		}
	});
}
function simpan_users(){
		$('.btn-save').html('Saving...');
		$('.btn-save').attr('disabled',true);

		var url;
		var form;

		if(users_simpan == 'tambah') {
			form = $('#form_tambah').serialize();
		}

		$.ajax({
			url : "<?php echo base_url('users/save');?>",
			type: "POST",
			data: form,
			dataType: "JSON",
			success: function(data) {
				if(data.status) {
					alert('DATA SUCCESSFULLY SAVED!');
					$('#users-modal').modal('hide');
					load_users();					
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
function load_users(){
	var id = '<?php echo $detail['id_projects']?>';
	$.ajax({
		url : "<?php echo base_url('users/load_users');?>",
		type: "POST",
		data: {id:id},
		success: function(data){
			$('#data-users').html(data);
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			console.log("GAGAL MEMUAT DATA!");
		}
	});
}

function delete_users(id){
	if(confirm('ARE YOU WANT  TO DELETE THIS DATA ?')){
		var id_projects = '<?php echo $detail['id_projects']?>';
		$.ajax({
			url : "<?php echo base_url('users/delete_users');?>",
			type: "POST",
			data: {id_users:id, id_projects:id_projects},
			success: function(data){
				load_users();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				console.log("GAGAL MEMUAT DATA!");
			}
		});
	}
}
</script>