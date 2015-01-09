<?php
	$project_statuses = Configure::read('project_statuses');
?>
<div class="projects form">
<?php echo $this->Form->create('Project', array( 'url' => '/admin/projects/add', 'class' => 'form_required')); ?>
	<fieldset>
		<legend>Add Project</legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('code');
		echo $this->Form->input('status', array('options' => $project_statuses));
	?>
	</fieldset>
	<?php
		echo $this->Form->button('Save', array('class' => 'btn btn-inverse'));
	?>
<?php echo $this->Form->end(); ?>
</div>
