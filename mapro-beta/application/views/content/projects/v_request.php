<?php
if(!empty($this->session->userdata('key_projects'))){
	echo '<br><div class="text-info">TOTAL DATA <strong>"'.$total.'"</strong> FOR KEYWORD <strong>"'.$this->session->userdata('key_projects').'"</strong></div><br>';
}
?>

<table class="table table-bordered table-stripped table-hover" style="width:1100px;">
	<thead>
		<tr style="background:#e6e6e6;">
			<th style="width:50px;text-align:center;">No</th>
			<th style="width:180px;text-align:center;">Projects</th>
			<th style="width:300px;text-align:center;">Description</th>
			<th style="width:150px;text-align:center;">Start Projects</th>
			<th style="width:150px;text-align:center;">End Projects</th>
			<th style="width:120px;text-align:center;">Budget</th>
			<th style="width:120px;text-align:center;">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			if(!empty($projects)){
				foreach($projects as $data){
					$string = word_limiter($data['description'], 10);
					echo '<tr>
							<td align="center">'.$no.'</td>
							<td>'.$data['projects'].'</td>
							<td>'.$string.'</td>
							<td align="center">'.sys_date_format($data['start_projects']).'</td>
							<td align="center">'.sys_date_format($data['end_projects']).'</td>
							<td align="right">Rp '.number_format($data['budget'], 0, ', ', '.').'</td>
							<td align="center">
								<a href="'.base_url('projects/detail/'.$data['id_projects']).'" class="text-success" title="Detail"><i class="glyphicon glyphicon-zoom-in"></i></a>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="'.base_url('projects/edit/'.$data['id_projects']).'" class="text-warning"><i class="glyphicon glyphicon-edit"></i></a>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="'.base_url('projects/delete/'.$data['id_projects']).'" class="text-danger" onClick="return confirm(\'ARE YOU WANT  TO DELETE THIS DATA ?\');"><i class="glyphicon glyphicon-trash"></i></a>
							</td>
						</tr>';
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