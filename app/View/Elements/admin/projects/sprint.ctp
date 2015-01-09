<div class="row-fluid">
	<div class="span12">
		<?php
			echo $this->Element(
				'admin/modal',
				array(
					'model_name' => 'AddSprint',
					'modal_body' => 'add_sprint',
				)
			);
		?>
		<button data-toggle="modal" href="#adminModalAddSprint" class="btn btn-inverse"><i style="font-size: 10px;" class="iconic-plus"></i> Add Sprint </button>
		<?php
			echo $this->Element('admin/projects/sprint-list');
		?>
	</div>
</div>
