<?php
	$project_statuses = Configure::read('project_statuses');
?>
<div class="projects index">
	<h2>Projects</h2>
	<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('project details'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($projects as $project): ?>
	<tr>
		<td><?php echo h($project['Project']['id']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['name']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['code']); ?>&nbsp;</td>
		<td><?php echo $project_statuses[$project['Project']['status']]; ?>&nbsp;</td>
		<td><?php echo date('F d, Y', $project['Project']['created']); ?>&nbsp;</td>
		<td><?php echo $this->Html->link(__('Manage'), array('action' => 'manage', $project['Project']['id']), array('class' => 'btn')); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $project['Project']['id']), array('class' => 'btn')); ?>
			
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
		<?php echo $this->Element('paginate-links'); ?>
	</div>
</div>

