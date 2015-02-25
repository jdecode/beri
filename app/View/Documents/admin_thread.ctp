<?php
//pr($threads);
?>
<div>
	<a class="btn btn-primary" href="<?php echo $this->webroot . 'admin/projects/manage/' . $project_id ?>">Back to Project</a>
</div>
<div class="entries view">
	<h2><?php echo 'Document # ' . $document['Document']['id']; ?></h2>
	<table class="table table-bordered table-striped table-hover table-responsive">
		<tr>
			<td>ID</td>
			<td><?php echo h($document['Document']['id']); ?></td>
		</tr>
		<tr>
			<td>Name</td>
			<td><?php echo $document['Document']['name'] . '<br />' . $this->Html->link('Download', '/files/documents/' . $document['Document']['filename'], array('class' => 'btn btn-primary')); ?></td>
		</tr>
		<tr>
			<td>File type</td>
			<td><?php echo h($document['Document']['file_type']); ?></td>
		</tr>
		<tr>
			<td>Added</td>
			<td><?php echo date('F d, Y H:i', $document['Document']['created']); ?></td>
		</tr>
	</table>
	<br />
	<?php echo $this->Form->create('Comment'); ?>
	<table class="table table-bordered table-hover table-striped">
		<tr class="row">
			<td class="col-xs-12">
				<?php
				echo $this->Form->input(
						'comment', array(
					'label' => false,
					'div' => false,
					'placeholder' => 'Comment',
					'required' => true,
					'rows' => '6',
					'cols' => '50',
					'style' => 'border:1px solid gray; width: 70%; padding:10px;',
						)
				);
				?>
				<br />
				<br />
				<?php
				echo $this->Form->submit('Submit', array('label' => false, 'div' => false, 'value' => 'Submit', 'class' => 'btn btn-primary'));
				?>
			</td>
		</tr>
	</table>
	<?php echo $this->Form->end(); ?>

	<table class="table table-bordered table-hover table-striped">
		<?php
		if (count($threads)) {
			foreach ($threads as $thread) {
				?>
				<tr class="">
					<td class="span3">
						<?php echo $thread['User']['first_name'] . ' ' . $thread['User']['last_name']; ?>
						<br />
						<small><?php echo date('F d, Y H:i', $thread['Thread']['created']); ?></small>
					</td>
					<td class=""><?php echo nl2br($thread['Thread']['post']); ?></td>
				</tr>
				<?php
			}
		}
		?>
	</table>
</div>
