<table class="table table-hover">
	<tbody>
		<tr>
			<td style="width:110px;">Customer Name</td>
			<td style="width:2px;">:</td>
			<td><strong><?php echo $data['customers_name'];?></strong></td>
		</tr>
		<tr>
			<td style="width:110px;">Address</td>
			<td style="width:2px;">:</td>
			<td><?php echo $data['address'];?></td>
		</tr>
		<tr>
			<td style="width:110px;">Contact Person</td>
			<td style="width:2px;">:</td>
			<td><?php echo $data['contact_person'];?></td>
		</tr>
		<tr>
			<td style="width:110px;">Phone</td>
			<td style="width:2px;">:</td>
			<td><?php echo $data['phone'];?></td>
		</tr>
		<tr>
			<td style="width:110px;">Email</td>
			<td style="width:2px;">:</td>
			<td><?php echo $data['email'];?></td>
		</tr>
		<tr>
			<td style="width:110px;">Website</td>
			<td style="width:2px;">:</td>
			<td><?php echo $data['website'];?></td>
		</tr>
		<tr>
			<td style="width:110px;">Registered</td>
			<td style="width:2px;">:</td>
			<td><?php echo sys_date_format($data['registered']);?></td>
		</tr>
	</tbody>
</table>