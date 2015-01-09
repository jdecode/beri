<div class="sprints view">
<h2><?php  echo __('Sprint'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sprint['Sprint']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($sprint['Sprint']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Project'); ?></dt>
		<dd>
			<?php echo $this->Html->link($sprint['Project']['name'], array('controller' => 'projects', 'action' => 'view', $sprint['Project']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($sprint['Sprint']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($sprint['Sprint']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($sprint['Sprint']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sprint'), array('action' => 'edit', $sprint['Sprint']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sprint'), array('action' => 'delete', $sprint['Sprint']['id']), null, __('Are you sure you want to delete # %s?', $sprint['Sprint']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sprints'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sprint'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Modules'), array('controller' => 'modules', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Module'), array('controller' => 'modules', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Modules'); ?></h3>
	<?php if (!empty($sprint['Module'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Sprint Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($sprint['Module'] as $module): ?>
		<tr>
			<td><?php echo $module['id']; ?></td>
			<td><?php echo $module['name']; ?></td>
			<td><?php echo $module['sprint_id']; ?></td>
			<td><?php echo $module['status']; ?></td>
			<td><?php echo $module['created']; ?></td>
			<td><?php echo $module['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'modules', 'action' => 'view', $module['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'modules', 'action' => 'edit', $module['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'modules', 'action' => 'delete', $module['id']), null, __('Are you sure you want to delete # %s?', $module['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Module'), array('controller' => 'modules', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
