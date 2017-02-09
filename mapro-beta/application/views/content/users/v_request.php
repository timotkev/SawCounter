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
			$array_permissions = $this->session->userdata('mapro_login')['id_roles_permissions'];

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
							$array_permissions = $this->session->userdata('mapro_login')['id_roles_permissions'];

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