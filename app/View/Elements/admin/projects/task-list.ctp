<div class="clearfix"><br /></div>
<div class="row-fluid">
	<div class="span12">
		<table class="table table-bordered table-striped">
			<tr>
				<th>Module</th>
				<th>Task</th>
				<th>Hours Allocated</th>
				<th>Hours Consumed</th>
			</tr>
			<?php
			foreach($tasks as $k => $task) {
			?>
			<tr>
				<td><?php
						echo $task['Module']['name'];
				?></td>
				<td><?php echo $task['Task']['name'] ?></td>
				<td><?php echo $task['Task']['hours_allocated'] ?></td>
				<td><?php echo isset($task['TasksUser'][0]['hours']) ? $task['TasksUser'][0]['hours'] : 0 ?></td>
			</tr>
			<?php
			}
			?>
		</table>
	</div>
</div>