<div class="projects form">
<?php echo $this->Form->create('Project'); ?>
	<fieldset>
		<legend><?php echo __('Add Project'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('code');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Projects'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Sprints'), array('controller' => 'sprints', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sprint'), array('controller' => 'sprints', 'action' => 'add')); ?> </li>
	</ul>
</div>
