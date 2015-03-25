<div class="row-fluid">
	<div class="span12">
		<?php
		
		echo $this->Form->create('Document', array('url' => '/admin/documents/note_add', 'class' => '', 'id' => 'add_document', 'type' => 'file'));
		echo $this->Form->input('project_id', array('type' => 'hidden', 'value' => $id));
		echo $this->Form->input('name', array('class' => 'validate[required]', 'Placeholder' => 'Document name'));
		echo '<br />';
		echo $this->Form->button(
				'Save', array(
			'type' => 'submit',
			'class' => 'btn btn-inverse',
			'label' => false,
			
			'value' => 'Save',
			'id' => 'save_document'
				)
		);
		echo $this->Form->end();
		?>
	</div>
</div>
