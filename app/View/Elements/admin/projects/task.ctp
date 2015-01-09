<div class="row-fluid">
	<div class="span12">
		<?php
			echo $this->Element(
				'admin/modal',
				array(
					'model_name' => 'AddTask',
					'modal_body' => 'add_task',
				)
			);
		?>
		<button data-toggle="modal" href="#adminModalAddTask" class="btn btn-inverse"><i style="font-size: 10px;" class="iconic-plus"></i> Add Task </button>
		<?php
			echo $this->Element('admin/projects/task-list');
		?>
	</div>
</div>
