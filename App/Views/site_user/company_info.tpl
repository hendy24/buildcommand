<?php echo $this->Form->create(); ?>

<table width="60%">
	<tr>
		<th colspan="2">Business Info</th>
	</tr>
	<tr>
		<td colspan="2"><strong>Business Name:</strong></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo $this->Form->input('Company.name', array('type' => 'text', 'label' => false, 'value' => $accountUser['Company']['name'], 'size' => 60)); ?></td>
	</tr>
	<tr>
		<td><strong>Address:</strong></td>	
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2"><?php echo $this->Form->input('Company.address', array('type' => 'text', 'label' => false, 'value' => $accountUser['Company']['address'], 'size' => 60)); ?></td>
	</tr>
	<tr>
		<td><strong>City</strong></td>
		<td><strong>State</strong></td>
	</tr>
	<tr>
		<td><?php echo $this->Form->input('Company.city', array('type' => 'text', 'label' => false, 'value' => $accountUser['Company']['city'])); ?></td>
		<td><?php echo $this->Form->input('Company.state', array('type' => 'select', 'label' => false, 'options' => $states, 'selected' => $accountUser['Company']['state'], 'empty' => 'Select state...')); ?></td>
	</tr>
	<tr>
		<td colspan="2"><strong>Zip</strong></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo $this->Form->input('Company.zip', array('type' => 'text', 'label' => false, 'value' => $accountUser['Company']['zip'])); ?></td>
	</tr>
	<tr>
		<td><strong>Phone:</strong></td>
		<td><strong>Fax:</strong></td>
	</tr>
	<tr>
		<td><?php echo $this->Form->input('Company.phone', array('type' => 'text', 'label' => false, 'value' => $accountUser['Company']['phone'], 'class' => 'phone')); ?></td>
		<td><?php echo $this->Form->input('Company.fax', array('type' => 'text', 'label' => false, 'value' => $accountUser['Company']['fax'], 'class' => 'phone')); ?></td>
	</tr>
	<tr>
		<td><strong>Email:</strong></td>
		<td><strong>License #:</strong></td>
	</tr>
	<tr>
		<td><?php echo $this->Form->input('Company.email', array('type' => 'text', 'label' => false, 'value' => $accountUser['Company']['email'], 'size' => 40)); ?></td>
		<td><?php echo $this->Form->input('Company.license_number', array('type' => 'text', 'label' => false, 'value' => $accountUser['Company']['license_number'])); ?></td>
	</tr>
	<tr>
		<td colspan="2" align="right"><?php echo $this->Form->submit('Save'); ?></td>
	</tr>
</table>
