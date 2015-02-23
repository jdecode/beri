<div class="row-fluid">
	<div class="span12">
		<?php
			echo $this->Element(
				'admin/modal',
				array(
					'model_name' => 'AddDocument',
					'modal_body' => 'add_document',
				)
			);
		?>
		<button data-toggle="modal" href="#adminModalAddDocument" class="btn btn-inverse"><i style="font-size: 10px;" class="iconic-plus"></i> Add Document </button>
		<?php
			echo $this->Element('admin/projects/documents-list');
		?>
	</div>
</div>
