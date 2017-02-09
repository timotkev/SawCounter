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