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