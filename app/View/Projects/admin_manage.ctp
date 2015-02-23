<br>
<br>
<div class="row-fluid">
	<div class="span11 offset1">
		<div class="tabbable">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#sprints" data-toggle="tab">Sprints</a></li>
				<li class=""><a href="#tasks" data-toggle="tab">Tasks</a></li>
				<li class=""><a href="#documents" data-toggle="tab">Documents</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="sprints">
					<?php echo $this->Element('admin/projects/sprint'); ?>
				</div>
				<div class="tab-pane" id="tasks">
					<?php echo $this->Element('admin/projects/task'); ?>
				</div>
				<div class="tab-pane" id="documents">
					<?php echo $this->Element('admin/projects/documents'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
