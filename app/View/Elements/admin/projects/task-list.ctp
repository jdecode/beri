<div class="clearfix"><br /></div>
<div class="row-fluid">

	<div class="span12">
		<table class="table table-bordered table-striped">
			<tr>
				<th>Module</th>
				<th>Task</th>
				<th>Hours Allocated</th>
				<th>Hours Consumed</th>
				<th>Align resource</th>

			</tr>
			<?php
		

			foreach ($tasks as $k => $task) {
				
				$hours_total=0;
				foreach ($task["TasksUser"] as $v){
				$hours_total +=$v["hours"];	
				}
				
				?>
				<tr>
					<td><?php
						echo $task['Module']['name'];
						?></td>
					<td><?php echo $task['Task']['name'] ?></td>
					<td><?php echo $task['Task']['hours_allocated'] ?></td>
					<td><?php echo $hours_total;?></td>
					<td>
						<?php
						$sel_user = '';
						if (!empty($task["TasksUser"])) {
							foreach ($task["TasksUser"] as $v) {
								if (!empty($v["user_id"]) && $v["status"] == 1 && $v["task_id"] == $task['Task']['id'])
									$sel_user = array("u_id"=>$v["user_id"],"t_id"=>$v["task_id"]);
							}
						}
						

						$option = "<option value=0>Select employee</option>";
						if (!empty($users)) {
							foreach ($users as $k => $user) {
								if (!empty($sel_user) && $k == $sel_user['u_id'] && $sel_user['t_id']== $task['Task']['id']) {
									$do_sel = 'selected="selected"';
								}else{
									$do_sel = '';
								}
								$option .="<option value=" . $k . " $do_sel >" . $user . "</option>";
							}
							
						}
						//echo h($option);
						$taskid = $task['Task']['id'];
						$project_id = $this->params['pass'][0];
						$content = '<form action="' . $this->webroot . 'admin/projects/assgin_task_to/" method="post"><select name="data[assign_to]">' . $option . '</select> <input type="hidden" value="' . $taskid . '" name="taskid"><input type="hidden" value="' . $project_id . '" name="project_id"><input type="submit" value="Align" class="btn btn-success"> </form>';
						?>
						<span title=''  data-html='true' data-content='<?php echo $content; ?>' data-placement='left' data-toggle='popover' class='btn assign_to_user'  data-original-title=''><i class='icon-hand-left'></i></span></td>
				</tr>
				<?php
			}
			?>
		</table>
	</div>
</div>

<script>
    $(document).ready(function () {
        $('.assign_to_user').popover();
    });


</script>