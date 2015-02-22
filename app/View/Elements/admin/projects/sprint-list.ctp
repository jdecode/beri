<div class="clearfix"><br /></div>
<div class="row-fluid">
	<div class="span12">
		<?php
		echo $this->Element(
			'admin/modal', array(
			'model_name' => 'AddTaskToSprint',
			'modal_body' => 'add_task_to_sprint',
			)
		);
		?>
		<table class="table table-bordered table-striped">
			<tr>
				<th>Sprint</th>
			</tr>
			<?php
//pr($sprints);
			if (isset($sprints) && count($sprints)) {
				foreach ($sprints as $sprint) {
					?>
					<tr>
						<td>
							<div class="row-fluid">
								<div class="span4">
									<span class="pull-left">
										<?php
										echo $sprint['name'];
										?>
									</span>
									<span class="pull-right">
										<a href="#adminModalAddTaskToSprint" class="give_s_id" data-toggle="modal" data-val="<?php echo $sprint["id"] ?>">Add Tasks</a>
										<?php
										//echo $this->Html->link('Add Task(s) to Sprint', array('controller' => 'sprints', 'action' => 'manage', $sprint['id']), array('class' => ''));
										?>
									</span>
								</div>
							</div>
						</td>
					</tr>
					<?php
				}
			}
			?>
		</table>
	</div>
</div>


<script>

    $(document).ready(function () {
        $(".give_s_id").click(function () {
            $s_id = $(this).attr("data-val");
            $("#ren_sprint_id").attr("value", $s_id);
        });
    });
</script>