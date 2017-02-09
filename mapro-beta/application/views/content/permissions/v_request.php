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