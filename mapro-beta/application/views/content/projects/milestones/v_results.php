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