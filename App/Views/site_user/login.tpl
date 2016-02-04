<h1 class="text-center">Login</h2>
<br />
<?php echo $this->Form->create('User', array('action' => 'login')); ?>
<div class="text-center">
	<?php echo $this->Session->flash('auth'); ?>
	<?php echo $this->Session->flash(); ?>
</div>

<table>
	<tr>
		<td>Username: </td>
		<td><?php echo $this->Form->input('User.username', array('label' => false, 'size' => 35)); ?></td>
	</tr>
	<tr>
		<td>Password: </td>
		<td><?php echo $this->Form->input('User.password', array('label' => false, 'size' => 35)); ?></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: right;"><?php echo $this->Form->end('Login'); ?></td>
	</tr>
</table>
