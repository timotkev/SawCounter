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