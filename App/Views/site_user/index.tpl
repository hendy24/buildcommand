<h1 class="text-center">Manage Users</h1>
<table class="form">
	<tr>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('group_id'); ?></th>
			<th colspan="2">&nbsp;</th>
	</tr>
	<?php
	foreach ($users as $user): ?>
		<?php echo $this->Html->tableCells(
				array(
					array(
						
						$user['User']['last_name'],
						$user['User']['first_name'],
						$user['Group']['name'],
						$this->Html->link('Edit', 
							array(
								'action' => 'account_info',
								'public_id' => $user['User']['public_id']
							)
						),
						$this->Form->postLink('Delete',
							array(
								'action' => 'delete',
								$user['User']['id']
							),
							array('confirm' => 'Are you sure you want to remove this user?  This cannot be reversed.')
						)
								
					)
				),
				array('class' => 'alt-row')
			); 
		?>
	<?php endforeach; ?>
</table>
<br />
<br />
<div id="pagination">
	
	<?php echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled')); ?>&nbsp;
	<?php echo $this->Paginator->numbers(array('separator' => '')); ?>&nbsp;
	<?php echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled')); ?>
	
	
	<p><?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}')));?></p>
</div>
