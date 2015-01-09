<div class="entries index">
	<h2><?php echo __('Entries'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('timestamp'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($entries as $entry): ?>
	<tr>
		<td><?php echo h($entry['Entry']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($entry['User']['id'], array('controller' => 'users', 'action' => 'view', $entry['User']['id'])); ?>
		</td>
		<td><?php echo h($entry['Entry']['type']); ?>&nbsp;</td>
		<td><?php echo h($entry['Entry']['timestamp']); ?>&nbsp;</td>
		<td><?php echo h($entry['Entry']['modified']); ?>&nbsp;</td>
		<td><?php echo h($entry['Entry']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $entry['Entry']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $entry['Entry']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $entry['Entry']['id']), null, __('Are you sure you want to delete # %s?', $entry['Entry']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Entry'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
