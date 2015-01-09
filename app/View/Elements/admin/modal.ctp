<div class="modal hide fade" id="adminModal<?php echo $model_name ?>">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<div class="clearfix"></div>
	</div>
	<div class="modal-body">
		<p>
			<?php
				switch ($modal_body) {
					case 'project_add'	:
						echo $this->Element('admin/project_add');
						break;
					case 'user_add'		:
						echo $this->Element('admin/user_add');
						break;
					case 'add_task'		:
						echo $this->Element('admin/projects/add_task');
						break;
					case 'add_sprint'	:
						echo $this->Element('admin/projects/add_sprint');
						break;
					case 'add_task_to_sprint'	:
						echo $this->Element('admin/projects/add_task_to_sprint');
						break;
					default				:
						echo 'Modal Body not defined';
						break;
				}
			?>
		</p>
	</div>
	<!--
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal">Close</button>
		<button data-dismiss="modal" class="btn btn-primary">Save</button>
	</div>
	-->
</div>
