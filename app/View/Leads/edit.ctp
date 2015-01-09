<div class="leads form">
<?php echo $this->Form->create('Lead'); ?>
	<fieldset>
		<legend><?php echo __('Edit Lead'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('uid');
		echo $this->Form->input('link');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('source');
		echo $this->Form->input('status');
		echo $this->Form->input('reply');
		echo $this->Form->input('active');
		echo $this->Form->input('deleted');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Lead.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Lead.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Leads'), array('action' => 'index')); ?></li>
	</ul>
</div>
