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
				?>
				<tr>
					<td><?php
						echo $task['Module']['name'];
						?></td>
					<td><?php echo $task['Task']['name'] ?></td>
					<td><?php echo $task['Task']['hours_allocated'] ?></td>
					<td><?php echo isset($task['TasksUser'][0]['hours']) ? $task['TasksUser'][0]['hours'] : 0 ?></td>
					<td>
						<?php 
						$option="<option>asd</option>";
						$content='<form action="admin/projects/manage/"><select>'.$option.'</select> <input type="submit" value="Align" class="btn btn-success"> </form>';
						?>
						<span title=''  data-html='true' data-content='<?php echo $content;?>' data-placement='left' data-toggle='popover' class='btn assign_to_user'  data-original-title=''><i class='icon-comment'></i></span></td>
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