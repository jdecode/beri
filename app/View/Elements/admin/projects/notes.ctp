<div class="row-fluid">
	<div class="span12">
		<?php
			echo $this->Element(
				'admin/modal',
				array(
					'model_name' => 'AddNote',
					'modal_body' => 'add_note',
				)
			);
		?>
		<button data-toggle="modal" href="#adminModalAddNote" class="btn btn-inverse"><i style="font-size: 10px;" class="iconic-plus"></i> Add Note </button>
		<?php
			echo $this->Element('admin/projects/notes-list');
		?>
	</div>
</div>
