<div class="projects form">
<?php echo $this->Form->create('Project'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Project'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('code');
		echo $this->Form->input('status');
		echo $this->Form->button('Submit', array('type' => 'submit', 'class' => 'btn btn-inverse', 'label' => FALSE, 'div' => FALSE));
	?>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
