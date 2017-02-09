<!-- Bootstrap modal -->
<div class="modal fade" id="tasks-modal" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<small class="modal-title tasks-title"></small>
			</div>
			<div class="modal-body tasks-body"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-off"></i> Close</button>
				<button type="button" class="btn btn-primary btn-sm btn-save" onclick="simpan_tasks()"><i class="glyphicon glyphicon-floppy-disk"></i> Save</button>
			</div>
		</div>
	</div>
</div>
<script type="application/javascript">
	var tasks_simpan;
	var id_milestones;

	function add_task(id){
		tasks_simpan = 'tambah';
		id_milestones = id;

		var loading = $('.loading-overlay').show();
		var id_projects = '<?php echo $detail['id_projects'];?>';

		$.ajax({
			url : "<?php echo base_url('tasks/form_add');?>",
			type: "POST",
			data: {id:id, id_projects:id_projects},
			success: function(data){
				$('.tasks-body').html(data);
				$('#tasks-modal').modal('show');
				$('.tasks-title').html('ADD TASKS');
				loading.hide();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				console.log("GAGAL MEMUAT FORM!");
			}
		});
	}

	function edit_task(id){
		tasks_simpan = 'ubah';
		id_milestones = id;
		var loading = $('.loading-overlay').show();
		$.ajax({
			url : "<?php echo base_url('tasks/form_edit');?>",
			type: "POST",
			data: {id:id},
			success: function(data){
				$('.tasks-body').html(data);
				$('#tasks-modal').modal('show');
				$('.tasks-title').html('EDIT TASKS');
				loading.hide();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				console.log("GAGAL MEMUAT FORM!");
			}
		});
	}

	function delete_tasks(id){
		if(confirm('ARE YOU WANT TO DELETE THIS DATA ?')){
			$.ajax({
				url : "<?php echo base_url('tasks/delete');?>",
				type: "POST",
				data: {id:id},
				success: function(data){
					load_tasks();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					console.log("GAGAL MEMUAT DATA!");
				}
			});
		}
	}

	function load_tasks(){
		var id = '<?php echo $detail['id_projects']?>';
		var id_milestones = id_milestones;

		$.ajax({
			url : "<?php echo base_url('tasks/load_tasks');?>",
			type: "POST",
			data: {id:id, id_milestones:id_milestones},
			success: function(data){
				$('#data-tasklists').html(data);
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				console.log("GAGAL MEMUAT DATA!");
			}
		});
	}

	function check_tasks(id) {
        $.ajax({
            url: "<?php echo base_url('tasks/mark_done');?>",
            type: "POST",
            data: {id_tasks: id},
            success: function (data) {
                load_tasks();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("GAGAL UPDATE TASK MENJADI DONE!");
            }
        });
//        console.log("Close task");
    }

	function simpan_tasks(){
		$('.btn-save').html('Saving...');
		$('.btn-save').attr('disabled',true);

		var url;
		var form;

		if(tasks_simpan == 'tambah') {
			form = $('#form_tambah').serialize();
		} else if(tasks_simpan == 'ubah') {
			form = $('#form_ubah').serialize();
		}
        console.log('Data to send: ' + JSON.stringify(form));
		$.ajax({
			url : "<?php echo base_url('tasks/save');?>",
			type: "POST",
			data: form,
			dataType: "JSON",
			success: function(data) {
				if(data.status) {
					alert('DATA SUCCESSFULLY SAVED!');
					$('#tasks-modal').modal('hide');
					load_tasks();
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$("#error_"+data.inputerror[i]).html(data.error_string[i]);
					}
				}
				$('.btn-save').html('<i class="glyphicon glyphicon-floppy-disk"></i> Save');
				$('.btn-save').attr('disabled',false);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log("GAGAL MENYIMPAN MILESTONE!");
			}
		});

	}
</script>