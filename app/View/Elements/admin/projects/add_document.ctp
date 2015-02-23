<div class="row-fluid">
	<div class="span12">
		<?php
		$disable_file_uploading = false;
		if (!is_writable(APP . DS . 'webroot' . DS . 'files' . DS . 'documents')) {
			echo '<span class="btn btn-danger">Documents folder is NOT writable. File may not be uploaded.</span>';
			$disable_file_uploading = true;
			echo '<br />';
		}
		echo $this->Form->create('Document', array('url' => '/admin/documents/add', 'class' => '', 'id' => 'add_document', 'type' => 'file'));
		echo $this->Form->input('project_id', array('type' => 'hidden', 'value' => $id));
		echo $this->Form->input('name', array('class' => 'validate[required]', 'Placeholder' => 'Document name'));
		echo $this->Form->input('file', array('class' => 'validate[required]', 'Placeholder' => 'Upload document', 'type' => 'file'));
		echo '<br />';
		echo $this->Form->button(
				'Save', array(
			'type' => 'submit',
			'class' => 'btn btn-inverse',
			'label' => false,
			'disabled' => $disable_file_uploading,
			'value' => 'Save',
			'id' => 'save_document'
				)
		);
		echo $this->Form->end();
		?>
	</div>
</div>
