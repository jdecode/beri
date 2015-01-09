<div class="entries view">
<h2><?php  echo __('Entry'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($entry['Entry']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($entry['User']['id'], array('controller' => 'users', 'action' => 'view', $entry['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($entry['Entry']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Timestamp'); ?></dt>
		<dd>
			<?php echo h($entry['Entry']['timestamp']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($entry['Entry']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($entry['Entry']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Entry'), array('action' => 'edit', $entry['Entry']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Entry'), array('action' => 'delete', $entry['Entry']['id']), null, __('Are you sure you want to delete # %s?', $entry['Entry']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Entries'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Entry'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
